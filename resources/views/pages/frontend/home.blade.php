@extends('layouts.frontend.main')

@section('style')
<style>
    .booking-card {
        border-radius: 12px;
        border: 1px solid #dee2e6;
        padding: 15px;
        margin-bottom: 15px;
        background: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .booking-title {
        font-weight: 600;
        font-size: 16px;
    }
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }
    .install-button {
        position: fixed;
        bottom: 80px;
        right: 20px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        color: #333;
        border: none;
        border-radius: 16px;
        padding: 12px 20px;
        display: none;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        z-index: 999;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Daftar Booking Saya</h4>
        <div class="text-muted">{{ now()->format('d F Y') }}</div>
    </div>

    @forelse($bookings as $booking)
        <div class="booking-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="booking-title">{{ $booking->user->name }} ({{ $booking->plat }})</div>
                    <div class="text-muted small mb-1">{{ $booking->phone }}</div>
                    <div class="text-muted small">Tanggal Booking: {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}</div>
                    <div class="text-muted small">Service: {{ $booking->service->name ?? '-' }} - {{ $booking->service->estimasi ?? '-' }} Menit</div>
                    <div class="text-muted small">Jadwal: {{ $booking->schedule ? \Carbon\Carbon::parse($booking->schedule->tanggal)->format('d M Y H:i') : '-' }}</div>
                </div>
                @if (\Carbon\Carbon::parse($booking->created_at)->addMinutes(5)->greaterThan(\Carbon\Carbon::now()))
                <form action="{{ route('book.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')" class="ms-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Batalkan</button>
                </form>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center text-muted">Belum ada data booking.</div>
    @endforelse
</div>

<button id="installButton" class="install-button">
    <i class="bi bi-google-play"></i>
    <i class="bi bi-apple"></i>
    Install App
</button>
@endsection

@section('script')
<script>
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        document.getElementById('installButton').style.display = 'flex';
    });

    document.getElementById('installButton').addEventListener('click', async () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            deferredPrompt = null;
            document.getElementById('installButton').style.display = 'none';
        }
    });

    window.addEventListener('appinstalled', () => {
        document.getElementById('installButton').style.display = 'none';
    });
</script>
@endsection
