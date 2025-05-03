@extends('layouts.dapur')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Tambah Data Tentang Kami</h2>

    @if (session('success'))
        <div class="bg-green-500 text-white py-2 px-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tentangkami.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Data</label>
            <input type="text" name="judul" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="konten" class="block text-sm font-medium text-gray-700">Deskripsi (satu poin per baris)</label>
            <textarea name="konten" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" required>{{ old('konten') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="tipe_informasi" class="form-label">Tipe Informasi</label>
            <select name="tipe_informasi" id="tipe_informasi" class="form-select bg-white border border-gray-300 rounded-md" required>
                <option value="Umum" {{ old('tipe_informasi') == 'Umum' ? 'selected' : '' }}>Umum</option>
                <option value="Divisi" {{ old('tipe_informasi') == 'Divisi' ? 'selected' : '' }}>Divisi</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="w-[10%] bg-[#0C0221] hover:bg-[#1E1E1E] text-white font-semibold py-2 px-6 rounded-md transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
