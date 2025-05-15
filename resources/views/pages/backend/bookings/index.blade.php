@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mt-2">
    <h5 class="card-header">Daftar Booking Jadwal</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Jadwal </th>
            <th class="text-white">Nama Customer</th>
            <th class="text-white">Plat</th>
            <th class="text-white">No. Telepon</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $booking)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ \Carbon\Carbon::parse($booking->schedule->tanggal)->locale('id')->translatedFormat('l, d M Y  H:i') }}</td>
            <td>{{ $booking->user->name }}</td>
            <td>{{ $booking->plat }}</td>
            <td>{{ $booking->phone }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
