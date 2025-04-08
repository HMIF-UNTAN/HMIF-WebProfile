@extends('layouts.dapur')

@section('content')
    <h1>Tambah Album Baru</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('galeri.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_album" class="form-label">Nama Album</label>
            <input type="text" class="form-control" id="nama_album" name="nama_album" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dapurgaleri') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
