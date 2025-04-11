@extends('layouts.dapur')

@section('content')
<div class="container">
    <h2>Edit Pengurus</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pengurus</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $pengurus->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" value="{{ $pengurus->nim }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $pengurus->no_hp }}">
        </div>

        <div class="mb-3">
            <label for="divisi_id" class="form-label">Divisi</label>
            <select name="divisi_id" id="divisi_id" class="form-select" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach ($divisiList as $divisi)
                    <option value="{{ $divisi->id }}" {{ $pengurus->kepengurusan->divisi_id == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenis_jabatan" class="form-label">Jenis Jabatan</label>
            <select class="form-select" id="jenis_jabatan" name="jenis_jabatan" required>
                <option value="Inti" {{ $pengurus->jenis_jabatan == 'Inti' ? 'selected' : '' }}>Inti</option>
                <option value="Anggota" {{ $pengurus->jenis_jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" name="periode" id="periode" class="form-control"
                value="{{ $pengurus->kepengurusan->periode }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Pengurus (Kosongkan jika tidak diubah)</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
            @if ($pengurus->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="Foto Pengurus" width="120">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('dapurpengurus') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
