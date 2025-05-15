<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('pages.backend.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'estimasi' => 'required|integer',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'estimasi' => $request->estimasi,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Service berhasil ditambahkan.',
                'data' => $service
            ]);
        }

        return redirect()->route('services.index')->with('success', 'Service berhasil ditambahkan.');
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'estimasi' => 'required|integer',
        ]);

        // Update langsung instance $service
        $service->update([
            'name' => $request->name,
            'estimasi' => $request->estimasi,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Service berhasil diperbarui.',
                'data' => $service
            ]);
        }

        return redirect()->route('services.index')->with('success', 'Service berhasil diperbarui.');
    }


    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Service berhasil diperbarui.',
                'data' => $service
            ]);
        }
        return redirect()->route('services.index')->with('success', 'Service berhasil dihapus.');
    }

    // // Tidak digunakan untuk sekarang:
    // public function create() {}
    // public function show($id) {}
    // public function edit($id) {}
}
