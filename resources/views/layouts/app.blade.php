<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil HMIF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            color: #1E1E1E;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #0C0221;
        }

        .table thead {
            background-color: #E8D7CC;
        }

        .btn-primary-custom {
            background-color: #0F4696;
            color: #fff;
            border: none;
        }

        .btn-danger-custom {
            background-color: #8B0000;
            color: #fff;
            border: none;
        }

        .badge-superadmin {
            background-color: #8B0000;
        }

        .badge-admin {
            background-color: #0F4696;
        }

        .badge-default {
            background-color: #1E1E1E;
        }

        .card-custom {
            background-color: #F7F7F7;
            border: 1px solid #E8D7CC;
        }
    </style>
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
