@extends('layouts.dapur')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Album Baru</h1>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="nama_album" class="block text-sm font-medium text-gray-700">Nama Album</label>
            <input type="text" id="nama_album" name="nama_album" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        <div>
            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail Album</label>
            <input type="file" id="thumbnail" name="thumbnail"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0 file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-600">Simpan</button>
            <a href="{{ route('dapurgaleri') }}"
                class="bg-gray-500 text-white px-5 py-2 rounded-md hover:bg-gray-600">Kembali</a>
        </div>
    </form>
@endsection
