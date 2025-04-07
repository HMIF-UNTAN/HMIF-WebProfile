@extends('layouts.dapur')

@section('content')
<div class="container mt-4">
    <h2>Edit Data</h2>
    <form action="{{ route('tentangkami.update', $tentangkami->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Data</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $tentangkami->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" class="form-control" rows="6" required>{{ old('konten', $tentangkami->konten) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dapurtentangkami') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
