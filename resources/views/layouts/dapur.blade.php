<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur HMIF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
</head>
<body class="flex min-h-screen">

    <div class="w-64 h-screen bg-[#0F4696] text-white p-5 flex flex-col space-y-3">
        <h3 class="text-2xl font-bold mb-6 text-white">Dapur HMIF</h3>
        <a href="{{ route('viewdapur') }}" class="block px-4 py-2 rounded hover:bg-white/20">Dashboard</a>
        <a href="{{ route('dapurartikel') }}" class="block px-4 py-2 rounded hover:bg-white/20">Artikel</a>
        <a href="{{ route('dapurtentangkami') }}" class="block px-4 py-2 rounded hover:bg-white/20">Data Tentang Kami</a>
        <a href="{{ route('dapurgaleri') }}" class="block px-4 py-2 rounded hover:bg-white/20">Galeri</a>
        <a href="{{ route('dapurpengurus') }}" class="block px-4 py-2 rounded hover:bg-white/20">Kepengurusan</a>
        <a href="{{ route('dapurkontak') }}" class="block px-4 py-2 rounded hover:bg-white/20">Kontak Kami</a>
    </div>

    <div class="flex-1 p-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
