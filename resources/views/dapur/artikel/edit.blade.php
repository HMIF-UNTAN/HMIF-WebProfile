@extends('layouts.dapur')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Edit Artikel</h2>

    <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Artikel</label>
            <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
        </div>

        <div>
            <label for="konten" class="block text-sm font-medium text-gray-700">Konten</label>
            <textarea name="konten" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>{{ old('konten', $artikel->konten) }}</textarea>
        </div>

        <div>
            <label for="tanggal_kegiatan" class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $artikel->tanggal_kegiatan ? $artikel->tanggal_kegiatan->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
        </div>

        <div>
            <label for="kategori_kegiatan" class="block text-sm font-medium text-gray-700">Kategori Kegiatan</label>
            <select name="kategori_kegiatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                <option value="">Pilih Kategori</option>
                <option value="Fakultas" {{ old('kategori_kegiatan', $artikel->kategori_kegiatan) === 'Fakultas' ? 'selected' : '' }}>Fakultas</option>
                <option value="Himpunan" {{ old('kategori_kegiatan', $artikel->kategori_kegiatan) === 'Himpunan' ? 'selected' : '' }}>Himpunan</option>
                <option value="Eksternal" {{ old('kategori_kegiatan', $artikel->kategori_kegiatan) === 'Eksternal' ? 'selected' : '' }}>Eksternal</option>
            </select>
        </div>        

        <div>
            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
            @if ($artikel->thumbnail)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="Thumbnail" class="w-36 h-auto rounded-md shadow-md mb-4">
                </div>
            @endif
            <input type="file" name="thumbnail" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700
                hover:file:bg-blue-100">
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition">
                Update
            </button>
            <a href="{{ route('dapurartikel') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-md transition">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
