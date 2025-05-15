@extends('layouts.frontend.main')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4">Form Booking</h4>

    <form action="{{ route('book.store') }}" method="POST">
        @csrf

        <!-- Schedule -->
        <div class="mb-3">
            <label for="schedule_id" class="form-label">Pilih Jadwal</label>
            <select class="form-select" name="schedule_id" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach ($schedules as $schedule)
                <option value="{{ $schedule->id }}">
                    {{ \Carbon\Carbon::parse($schedule->tanggal)->format('d M Y H:i') }}
                    @if($schedule->is_libur)
                        (Libur)
                    @endif
                </option>
                @endforeach
            </select>
        </div>

        <!-- Service -->
        <div class="mb-3">
            <label for="service_id" class="form-label">Pilih Service</label>
            <select class="form-select" name="service_id" required>
                <option value="">-- Pilih Service --</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->estimasi }} menit)</option>
                @endforeach
            </select>
        </div>

        <!-- Plat -->
        <div class="mb-3">
            <label for="plat" class="form-label">Nomor Plat</label>
            <input type="text" class="form-control" name="plat" required placeholder="Contoh: B 1234 XYZ">
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" name="phone" required placeholder="Mulai dengan 628">
        </div>


        <!-- Submit -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100">Kirim Booking</button>
        </div>
    </form>
</div>
@endsection
