<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Alumni Baru</title>
</head>
<body>
    <h2>Notifikasi Alumni Baru</h2>
    <p>
        Telah ada alumni yang mendaftar melalui form alumni dan menunggu proses verifikasi.
    </p>
    <ul>
        <li><strong>Nama:</strong> {{ $alumni->nama_lengkap }}</li>
        <li><strong>NIM:</strong> {{ $alumni->nim }}</li>
        <li><strong>Email:</strong> {{ $alumni->email }}</li>
        <li><strong>Angkatan:</strong> {{ $alumni->angkatan }}</li>
    </ul>
    <p>Silakan login ke Dapur HMIF untuk melakukan verifikasi.</p>
</body>
</html>
