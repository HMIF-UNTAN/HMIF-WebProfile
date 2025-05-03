@extends('layouts.dapur')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-4">Edit Pengurus</h2>

    @if (session('success'))
        <div class="alert alert-success bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pengurus</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $pengurus->nama }}" required>
        </div>

        <div class="mb-4">
            <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
            <input type="text" name="nim" id="nim" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $pengurus->nim }}" required>
        </div>

        <div class="mb-4">
            <label for="divisi_id" class="block text-sm font-medium text-gray-700">Divisi</label>
            <select name="divisi_id" id="divisi_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach ($divisiList as $divisi)
                    <option value="{{ $divisi->id }}" {{ $pengurus->kepengurusan->divisi_id == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="jenis_jabatan" class="block text-sm font-medium text-gray-700">Jenis Jabatan</label>
            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="jenis_jabatan" name="jenis_jabatan" required>
                <option value="Inti" {{ $pengurus->jenis_jabatan == 'Inti' ? 'selected' : '' }}>Inti</option>
                <option value="Anggota" {{ $pengurus->jenis_jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="periode" class="block text-sm font-medium text-gray-700">Periode</label>
            <input type="text" name="periode" id="periode" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $pengurus->kepengurusan->periode }}" required>
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Pengurus (Kosongkan jika tidak diubah)</label>
            <input type="file" name="foto" id="foto" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" accept="image/*">
            @if ($pengurus->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="Foto Pengurus" width="120" class="rounded-lg shadow-md">
                </div>
            @endif
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan Perubahan</button>
            <a href="{{ route('dapurpengurus') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Kembali</a>
        </div>
    </form>
</div>
@endsection
