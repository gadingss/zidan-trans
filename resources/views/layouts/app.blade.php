<!DOCTYPE html>
<html>
<head>
    <title>Booking Mobil / ELF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('scripts') {{-- Tambahkan ini agar JavaScript dari halaman bisa dijalankan --}}
</body>
</html>
