        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('home') }}" class="app-brand-link m-auto">
                    <span class="app-brand-logo demo">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://menara-agung.com/mawp/wp-content/uploads/2024/04/cropped-cropped-logo-red-1-1.png" alt="Donor Darah Logo" style="height: 40px; width: auto;">
                        </div>
                    </span>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1 mt-3 border-top">
                <!-- Dashboard -->
                <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-home"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <!-- Users -->
                <li class="menu-item {{ Route::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Users">Pengguna</div>
                    </a>
                </li>
                <!-- Schedules -->
                <li class="menu-item {{ Route::is('schedules*') ? 'active' : '' }}">
                    <a href="{{ route('schedules.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-calendar-check"></i>
                        <div data-i18n="Schedules">Master Jadwal</div>
                    </a>
                </li>
                <!-- Services -->
                <li class="menu-item {{ Route::is('services*') ? 'active' : '' }}">
                    <a href="{{ route('services.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-cog"></i>
                        <div data-i18n="Services">Services</div>
                    </a>
                </li>
                <!-- Booking -->
                <li class="menu-item {{ Route::is('bookings*') ? 'active' : '' }}">
                    <a href="{{ route('bookings.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-book"></i>
                        <div data-i18n="Bookings">Booking</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->
