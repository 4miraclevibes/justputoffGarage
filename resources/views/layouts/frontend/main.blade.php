<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#ff8c00 ">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="AHM">
    <title>Menara Agung</title>
    <link rel="icon" href="https://menara-agung.com/mawp/wp-content/uploads/2024/04/cropped-cropped-logo-red-1-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      body {
          font-family: 'Poppins', sans-serif;
          min-height: 100vh;
          display: flex;
          flex-direction: column;
          padding-bottom: 60px;
      }
      .wrapper {
          flex: 1 0 auto;
          max-width: 480px;
          margin: 0 auto;
          width: 100%;
          background-color: white;
          position: relative;
      }
      .container {
          padding-left: 15px;
          padding-right: 15px;
      }
      h1 {
        font-size: 1.5rem;
      }
      h2 {
        font-size: 1.3rem;
      }
      h3 {
        font-size: 1.1rem;
      }
      .navbar-brand img {
        max-height: 40px;
      }
      .navbar-toggler {
        font-size: 0.8rem;
      }
      footer {
          position: fixed;
          bottom: 0;
          left: 50%;
          transform: translateX(-50%);
          width: 100%;
          max-width: 480px;
          background-color: white;
          z-index: 1000;
      }
      .loading {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(255, 255, 255, 0.7);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 9999;
      }

      .loading-spinner {
          width: 50px;
          height: 50px;
          border: 5px solid #f3f3f3;
          border-top: 5px solid #4caf50;
          border-radius: 50%;
          animation: spin 1s linear infinite;
      }

      @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }

      .disabled {
          opacity: 0.5;
          pointer-events: none;
      }

      .custom-alert {
          position: fixed;
          top: 20px;
          right: 20px;
          max-width: 300px;
          padding: 12px 15px;
          border-radius: 4px;
          font-weight: 500;
          z-index: 9999;
          opacity: 0;
          transform: translateY(-20px);
          transition: all 0.3s ease-in-out;
          display: flex;
          align-items: center;
          justify-content: space-between;
          box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }
      .custom-alert.show {
          opacity: 1;
          transform: translateY(0);
      }
      .custom-alert-success {
          background-color: #d4edda;
          color: #155724;
          border-left: 4px solid #28a745;
      }
      .custom-alert-error {
          background-color: #f8d7da;
          color: #721c24;
          border-left: 4px solid #dc3545;
      }
      .custom-alert-content {
          display: flex;
          align-items: center;
          flex-grow: 1;
          margin-right: 10px;
      }
      .custom-alert-icon {
          margin-right: 10px;
          font-size: 1.2em;
      }
      .custom-alert-message {
          line-height: 1.4;
          font-size: 14px;
      }
      .custom-alert-close {
          font-size: 1.2em;
          font-weight: 700;
          line-height: 1;
          color: #000;
          text-shadow: 0 1px 0 #fff;
          opacity: .5;
          cursor: pointer;
          padding-left: 10px;
      }
      .custom-alert-close:hover {
          opacity: .75;
      }
    </style>
    @yield('style')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div id="loading" class="loading" style="display: none;">
        <div class="loading-spinner"></div>
    </div>
    <div class="wrapper">
      @include('layouts.frontend.navbar')
      <div class="container mt-3">
        @if(Session::has('success') || Session::has('error'))
            <div id="customAlert" class="custom-alert {{ Session::has('success') ? 'custom-alert-success' : 'custom-alert-error' }}">
                <div class="custom-alert-content">
                    <span class="custom-alert-icon">
                        @if(Session::has('success'))
                            <i class="bi bi-check-circle-fill"></i>
                        @else
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        @endif
                    </span>
                    <span class="custom-alert-message">{{ Session::get('success') ?? Session::get('error') }}</span>
                </div>
                <span class="custom-alert-close" onclick="closeAlert()">&times;</span>
            </div>
        @endif

        @yield('content')
      </div>
      @include('layouts.frontend.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    @yield('scripts')
    <script>
      // Otomatis menghilangkan alert setelah 5 detik
      setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
          var bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        });
      }, 5000);
    </script>
    <script>
      (function() {
        let isLoading = false;
        const loadingElement = document.getElementById('loading');

        function showLoading() {
            if (loadingElement) {
                loadingElement.style.display = 'flex';
                document.body.classList.add('disabled');
                isLoading = true;
            }
        }

        function hideLoading() {
            if (loadingElement) {
                loadingElement.style.display = 'none';
                document.body.classList.remove('disabled');
                isLoading = false;
            }
        }

        function forceHideLoading() {
            hideLoading();
            setTimeout(hideLoading, 100);
            setTimeout(hideLoading, 500);
            setTimeout(hideLoading, 1000);
        }

        // Tangani navigasi kembali
        window.addEventListener('popstate', forceHideLoading);

        // Tangani semua form submit
        document.addEventListener('submit', function(e) {
            if (!isLoading) {
                showLoading();
            }
        });

        // Tangani klik pada tag <a>
        document.addEventListener('click', function(e) {
            const target = e.target.closest('a');
            if (target && target.href && !target.hasAttribute('data-no-loading')) {
                if (!isLoading) {
                    showLoading();
                }
            }
        });

        // Tangani penghentian loading setelah halaman dimuat
        window.addEventListener('load', forceHideLoading);

        // Tangani kasus ketika halaman di-refresh atau navigasi kembali
        if (performance.navigation.type === performance.navigation.TYPE_RELOAD ||
            performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD) {
            forceHideLoading();
        }

        // Tambahan: Coba hentikan loading setiap beberapa detik
        setInterval(forceHideLoading, 3000);

        // Ekspos fungsi ke objek window untuk debugging
        window.debugLoading = {
            show: showLoading,
            hide: hideLoading,
            forceHide: forceHideLoading
        };
      })();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('customAlert');
            if (alert) {
                setTimeout(function() {
                    alert.classList.add('show');
                }, 100);
                setTimeout(function() {
                    closeAlert();
                }, 5000);
            }
        });

        function closeAlert() {
            var alert = document.getElementById('customAlert');
            if (alert) {
                alert.classList.remove('show');
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }
        }
    </script>
    <script src="{{ asset('sw.js') }}"></script>
    @yield('script')
  </body>
</html>
