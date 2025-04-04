@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>{{ $himpunanInfo?->judul ?? 'Himpunan Mahasiswa Informatika' }}</h1>
        <p class="lead">{{ $himpunanInfo?->konten ?? 'Deskripsi belum tersedia.' }}</p>
    </div>
</div>

@endsection
