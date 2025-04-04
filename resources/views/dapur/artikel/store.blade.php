@extends('layouts.dapur')

@section('content')
<div class="container mt-4">
    <h2>Tambah Artikel</h2>
    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Artikel</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Gambar</label>
            <input type="file" name="thumbnail" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
