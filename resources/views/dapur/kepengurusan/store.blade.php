@extends('layouts.dapur')

@section('title', 'Tambah Pengurus')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Pengurus</h3>

    <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pengurus</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control">
        </div>

        <div class="mb-3">
            <label for="divisi_id" class="form-label">Divisi</label>
            <select name="divisi_id" id="divisi_id" class="form-select" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach ($divisiList as $divisi)
                    <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="jenis_jabatan" class="form-label">Jenis Jabatan</label>
            <select class="form-select" id="jenis_jabatan" name="jenis_jabatan" required>
                <option value="Inti">Inti</option>
                <option value="Anggota" selected>Anggota</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" name="periode" id="periode" class="form-control" required>
        </div>
        

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Pengurus</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dapurpengurus') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
