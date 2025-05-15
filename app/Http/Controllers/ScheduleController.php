<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        if(Auth::user()->name !== 'Admin'){
            return redirect()->route('home')->with('error', 'Anda tidak bisa mengakses halaman ini');
        }
        $schedules = Schedule::orderBy('tanggal')->get();
        return view('pages.backend.schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($validated['start_date'])->startOfDay();
        $endDate = Carbon::parse($validated['end_date'])->endOfDay();
        $now = now();

        // Validasi: jangan generate jika ada jadwal yang lebih kecil dari sekarang
        $tempDate = $startDate->copy();
        while ($tempDate->lte($endDate)) {
            for ($hour = 9; $hour <= 15; $hour++) {
                $tanggal = $tempDate->copy()->setHour($hour)->setMinute(0)->setSecond(0);
                if ($tanggal->lt($now)) {
                    return redirect()->back()->with('error', 'Tidak bisa membuat jadwal di masa lalu.');
                }
            }
            $tempDate->addDay();
        }

        $countCreated = 0;
        while ($startDate->lte($endDate)) {
            for ($hour = 9; $hour <= 15; $hour++) {
                $tanggal = $startDate->copy()->setHour($hour)->setMinute(0)->setSecond(0);

                $alreadyExists = Schedule::where('tanggal', $tanggal)->exists();
                if ($alreadyExists) continue;

                Schedule::create([
                    'tanggal' => $tanggal,
                    // status & is_libur biarkan default false
                ]);

                $countCreated++;
            }

            $startDate->addDay();
        }

        return redirect()->back()->with('success', "{$countCreated} jadwal berhasil ditambahkan.");
    }


    public function update(Request $request, Schedule $schedule)
    {
        // $validated = $request->validate([
        //     'tanggal' => 'required|date',
        // ]);

        $schedule->update([
            // 'tanggal' => $validated['tanggal'],
            'status' => $request->has('status'),
            'is_libur' => $request->has('is_libur'),
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
