@extends('layouts.dapur')

@section('content')
<div class="container">
    <h2 class="mb-4">Kontak HMIF</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <p><strong>Alamat:</strong> {{ $kontak->alamat }}</p>
            <p><strong>Nama Narahubung:</strong> {{ $kontak->narahubung_nama }}</p>
            <p><strong>Kontak Narahubung:</strong> {{ $kontak->narahubung_kontak }}</p>
            <p><strong>Email:</strong> {{ $kontak->email }}</p>

            <button class="btn btn-primary mt-2" data-bs-toggle="collapse" data-bs-target="#editForm">
                Edit Kontak
            </button>

            <div class="collapse mt-4" id="editForm">
                <form action="{{ route('kontak.update', $kontak->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $kontak->alamat) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="narahubung_nama" class="form-label">Nama Narahubung</label>
                        <input type="text" class="form-control" name="narahubung_nama" value="{{ old('narahubung_nama', $kontak->narahubung_nama) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="narahubung_kontak" class="form-label">Kontak Narahubung</label>
                        <input type="text" class="form-control" name="narahubung_kontak" value="{{ old('narahubung_kontak', $kontak->narahubung_kontak) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email HMIF</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $kontak->email) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
