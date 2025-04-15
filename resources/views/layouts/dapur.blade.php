<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur HMIF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #0F4696;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .pagination .page-link {
            color: #0F4696;
            margin-left: 10px;
        }
        .pagination .page-item.active .page-link {
            background-color: #0F4696;
            border-color: #0F4696;
            color: white;
        }
        .embed-responsive-custom {
            position: relative;
            width: 100%;
            padding-bottom: 75%; /* 4:3 ratio, bisa ganti jadi 56.25% untuk 16:9 */
            height: 0;
            overflow: hidden;
            border-radius: 6px;
        }

        .embed-responsive-custom iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Dapur HMIF</h3>
        <a href="{{ route('viewdapur') }}">Dashboard</a>
        <a href="{{ route('dapurartikel') }}">Artikel</a>
        <a href="{{ route('dapurtentangkami') }}">Data Tentang Kami</a>
        <a href="{{ route('dapurgaleri') }}">Galeri</a>
        <a href="{{ route('dapurpengurus') }}">Kepengurusan</a>
        <a href="{{ route('dapurkontak') }}">Kontak Kami</a>
    </div>
    <div class="content">
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
