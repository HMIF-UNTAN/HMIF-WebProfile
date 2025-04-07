@extends('layouts.dapur')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data Tentang Kami</h2>
    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('tentangkami.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Data</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="konten" class="form-label">Deskripsi (satu poin per baris)</label>
            <textarea name="konten" class="form-control" rows="6" required>{{ old('Konten') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
