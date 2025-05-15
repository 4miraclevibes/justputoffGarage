<footer class="border-top">
    <div class="container">
        <div class="row py-1">
            <div class="col-6 text-center">
                <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door{{ Route::is('home') ? '-fill' : '' }} fs-2"></i>
                    <p class="mb-0 small" style="font-size: 10px !important;">Home</p>
                </a>
            </div>
            <div class="col-6 text-center">
                <a href="{{ route('book.create') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-pencil{{ Route::is('book.create') ? '-fill' : '' }} fs-2"></i>
                    <p class="mb-0 small" style="font-size: 10px !important;">Booking</p>
                </a>
            </div>
            {{-- <div class="col-4 text-center">
                <a href="#" class="text-decoration-none text-secondary">
                    <i class="bi bi-wallet{{ Route::is('payment') ? '-fill' : '' }} fs-2"></i>
                    <p class="mb-0 small" style="font-size: 10px !important;">Jadwal</p>
                </a>
            </div> --}}
        </div>
    </div>
</footer>
