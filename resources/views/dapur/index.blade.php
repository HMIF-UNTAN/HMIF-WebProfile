@extends('layouts.dapur')

@section('content')
<div class="p-5">
    <h1 class="text-2xl font-bold mb-3">Selamat datang di Dapur HMIF, {{ $user->name }}</h1>
    <p class="text-gray-600">Ini halaman admin dashboard.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-gray-100 text-gray-800 rounded-lg shadow p-6">
            <h5 class="text-lg font-semibold mb-2">📄 Jumlah Artikel</h5>
            <p class="text-3xl font-bold">{{ $jumlahArtikel }}</p>
        </div>
        <div class="bg-gray-100 text-gray-800 rounded-lg shadow p-6">
            <h5 class="text-lg font-semibold mb-2">👤 Jumlah Pengurus</h5>
            <p class="text-3xl font-bold">{{ $jumlahPengurus }}</p>
        </div>
        <div class="bg-gray-100 text-gray-800 rounded-lg shadow p-6">
            <h5 class="text-lg font-semibold mb-2">🖼️ Jumlah Album Galeri</h5>
            <p class="text-3xl font-bold">{{ $jumlahAlbum }}</p>
        </div>
    </div>

    <h4 class="text-xl font-semibold mt-10 mb-4">📌 Jumlah Pengurus per Divisi</h4>
    <ul class="space-y-3">
        @foreach ($pengurusPerDivisi as $divisi)
            <li class="flex justify-between items-center bg-white p-4 rounded-lg shadow">
                <span class="font-semibold">{{ $divisi->nama }}</span>
                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                    {{ $divisi->kepengurusan_count }} Pengurus
                </span>
            </li>
        @endforeach
    </ul>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        <div class="bg-gray-100 rounded-lg shadow">
            <div class="bg-gray-200 font-bold p-4 rounded-t-lg">📌 Aktivitas Terakhir</div>
            <div class="p-6">
                <p class="mb-3">📰 Artikel terbaru: <strong>{{ $latestArtikel->judul ?? 'Belum ada artikel' }}</strong></p>
                <p>🖼️ Album terbaru: <strong>{{ $latestAlbum->nama_album ?? 'Belum ada album' }}</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
