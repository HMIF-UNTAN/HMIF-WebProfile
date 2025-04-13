@extends('layouts.dapur')

@section('content')
<div class="container">
    <h1 class="mb-3">Selamat datang di Dapur HMIF, {{ $user->name }}</h1>
    <p>Ini halaman admin dashboard.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-secondary-subtle text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">📄 Jumlah Artikel</h5>
                    <p class="card-text fs-4">{{ $jumlahArtikel }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary-subtle text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">👤 Jumlah Pengurus</h5>
                    <p class="card-text fs-4">{{ $jumlahPengurus }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary-subtle text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">🖼️ Jumlah Album Galeri</h5>
                    <p class="card-text fs-4">{{ $jumlahAlbum }}</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-5 mb-3">📌 Jumlah Pengurus per Divisi</h4>
    <ul class="list-group">
        @foreach ($pengurusPerDivisi as $divisi)
            <li class="list-group-item d-flex justify-content-between align-items-center ">
                <span><strong>{{ $divisi->nama }}</strong></span>
                <span class="badge bg-secondary rounded-pill">
                    {{ $divisi->kepengurusan_count }} Pengurus
                </span>
            </li>
        @endforeach
    </ul>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card bg-light mb-3">
                <div class="card-header fw-bold">📌 Aktivitas Terakhir</div>
                <div class="card-body">
                    <p>📰 Artikel terbaru: <strong>{{ $latestArtikel->judul ?? 'Belum ada artikel' }}</strong></p>
                    <p>🖼️ Album terbaru: <strong>{{ $latestAlbum->nama_album ?? 'Belum ada album' }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
