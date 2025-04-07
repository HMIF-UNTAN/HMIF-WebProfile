@extends('layouts.dapur')

@section('content')
<div class="container mt-4">
    <h2>Edit Artikel</h2>
    <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Artikel</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $artikel->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="6" required>{{ old('konten', $artikel->konten) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label><br>
            @if ($artikel->thumbnail)
                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" width="150" class="mb-2"><br>
            @endif
            <input type="file" name="thumbnail" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dapurartikel') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
