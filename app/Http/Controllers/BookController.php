<?php

namespace App\Http\Controllers;

use App\Models\Booking;  // pastikan model Booking sudah dibuat
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();  // ambil semua data booking
        return view('pages.backend.bookings.index', compact('bookings'));
    }
}
