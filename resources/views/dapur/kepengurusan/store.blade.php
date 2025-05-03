@extends('layouts.dapur')

@section('title', 'Tambah Pengurus')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h3 class="text-2xl font-semibold mb-6">Tambah Pengurus</h3>

    <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pengurus</label>
            <input type="text" name="nama" id="nama" class="w-full p-3 border border-gray-300 rounded-md focus:ring-[#0C0221] focus:border-[#0C0221]" required>
        </div>

        <div class="mb-4">
            <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
            <input type="text" name="nim" id="nim" class="w-full p-3 border border-gray-300 rounded-md focus:ring-[#0C0221] focus:border-[#0C0221]" required>
        </div>

        <div class="mb-4">
            <label for="divisi_id" class="block text-sm font-medium text-gray-700">Divisi</label>
            <select name="divisi_id" id="divisi_id" class="w-full p-3 border border-gray-300 rounded-md focus:ring-[#0C0221] focus:border-[#0C0221]" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach ($divisiList as $divisi)
                    <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="jenis_jabatan" class="block text-sm font-medium text-gray-700">Jenis Jabatan</label>
            <select class="w-full p-3 border border-gray-300 rounded-md focus:ring-[#0C0221] focus:border-[#0C0221]" id="jenis_jabatan" name="jenis_jabatan" required>
                <option value="Inti">Inti</option>
                <option value="Anggota" selected>Anggota</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="periode" class="block text-sm font-medium text-gray-700">Periode</label>
            <input type="text" name="periode" id="periode" class="w-full p-3 border border-gray-300 rounded-md focus:ring-[#0C0221] focus:border-[#0C0221]" required>
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Pengurus</label>
            <input type="file" name="foto" id="foto" class="w-full p-3 border border-gray-300 rounded-md focus:ring-[#0C0221] focus:border-[#0C0221]" accept="image/*" required>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="bg-[#0C0221] hover:bg-[#1E1E1E] text-white py-2 px-6 rounded-md">
                Simpan
            </button>
            <a href="{{ route('dapurpengurus') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-6 rounded-md">
                Kembali
            </a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection
