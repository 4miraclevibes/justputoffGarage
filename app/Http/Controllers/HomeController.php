<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function home()
    {
        $bookings = Booking::with(['schedule', 'service'])->latest()->get();
        return view('pages.frontend.home', compact('bookings'));
    }


    public function create()
    {
        $today = Carbon::now();


        $schedules = Schedule::where('status', true)
        ->where('is_libur', false)
        ->whereMonth('tanggal', $today->month)
        ->whereYear('tanggal', $today->year)
        ->where('tanggal', '>=', $today)
        ->orderBy('tanggal', 'asc')
        ->get();

        $services = Service::orderBy('name')->get();

        return view('pages.frontend.booking', compact('schedules', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'service_id' => 'required|exists:services,id',
            'plat' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
        ]);

        $validated['user_id'] = Auth::id();

        $schedule = Schedule::findOrFail($validated['schedule_id']);
        $tanggal = \Carbon\Carbon::parse($schedule->tanggal)->toDateString();

        $alreadyBooked = Booking::where('plat', $validated['plat'])
            ->whereHas('schedule', function ($query) use ($tanggal) {
                $query->whereDate('tanggal', $tanggal);
            })
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Nomor plat ini sudah melakukan booking di tanggal tersebut!');
        }

        $book = Booking::create($validated);

        $schedule->update(['status' => 0]);
        $this->sendWhatsappNotification($book);

        return redirect()->route('home')->with('success', 'Booking berhasil dibuat!');
    }


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        Schedule::where('id', $booking->schedule->id)->update([
            'status' => true,
        ]);
        $booking->delete();
        return redirect()->route('home')->with('success', 'Booking Berhasil Di batalkan!');
    }

    private function sendWhatsappNotification($book)
    {
        $message = "🔔 *Booking Service Baru*\n\n"
            . "📅 *Jadwal*: " . \Carbon\Carbon::parse($book->schedule->tanggal)->format('d M Y H:i') . " WIB\n"
            . "🔧 *Layanan*: " . $book->service->name . "\n"
            . "🚗 *Plat Nomor*: " . $book->plat . "\n"
            . "📱 *No HP*: " . $book->phone . "\n"
            . "👤 *Nama User*: " . $book->user->name . "\n\n"
            . "💡 Silakan cek dashboard admin untuk detail lebih lanjut.";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $book->phone,
                'message' => $message
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: gsRuqgbVqLAd6zpnWG9U'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


}
