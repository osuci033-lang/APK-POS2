<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #ffffff !important;
        }
    </style>
</head>
<body>

{{-- Menggunakan container-fluid agar melebar full screen dan px-4 untuk jarak aman di sisi kiri-kanan --}}
<div class="container-fluid px-4 mt-3">
    {{-- Menangkap semua jenis pesan session sukses --}}
    @if(session('success'))
        <div class="alert alert-success auto-dismiss-alert shadow-sm border-0">
            {{ session('success') }}
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success auto-dismiss-alert shadow-sm border-0">
            {{ session('status') }}
        </div>
    @endif

    @yield('content')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.alert-success, .auto-dismiss-alert');

        alerts.forEach(function (alert) {
            setTimeout(function () {
                alert.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function () {
                    alert.remove();
                }, 600);
            }, 5000);
        });
    });
</script>

</body>
</html>