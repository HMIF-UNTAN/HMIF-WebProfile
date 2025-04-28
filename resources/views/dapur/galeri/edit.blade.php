@extends('layouts.dapur')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-6">Edit Album: {{ $album->nama_album }}</h2>

    @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('galeri.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_album" class="block text-sm font-medium text-gray-700">Nama Album</label>
            <input type="text" id="nama_album" name="nama_album" value="{{ old('nama_album', $album->nama_album) }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail Album (opsional)</label>
            <input type="file" id="thumbnail" name="thumbnail"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @if ($album->thumbnail)
                <p class="text-sm text-gray-500 mt-2">Thumbnail saat ini:</p>
                <img src="{{ asset('storage/' . $album->thumbnail) }}" alt="Thumbnail Album" class="w-32 h-32 object-cover mt-1 rounded-md shadow">
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Simpan Perubahan</button>
            <a href="{{ route('dapurgaleri') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>
@endsection
