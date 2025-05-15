<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\IsAdminUser;

// Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Semua user login bisa akses ini
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/book', [HomeController::class, 'create'])->name('book.create');
    Route::delete('/booking/{id}', [HomeController::class, 'destroy'])->name('book.destroy');
    Route::post('/store', [HomeController::class, 'store'])->name('book.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Semua fitur admin dibuka untuk semua user (sementara)
    Route::get('/dashboard', function () {
        if(Auth::user()->name !== 'Admin'){
            return redirect()->route('home')->with('error', 'Anda tidak bisa mengakses halaman ini');
        }
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('bookings', BookController::class);
});

require __DIR__.'/auth.php';
