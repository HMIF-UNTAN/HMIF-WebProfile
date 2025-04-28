@extends('layouts.dapur')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Galeri HMIF</h1>
        <div>
            <a href="{{ route('galeri.downloadSeeder') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 mr-2">Download Seeder</a>
            <a href="{{ route('tambahalbum') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">+ Tambah Album</a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        @foreach ($galeri as $album)
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h5 class="text-xl font-semibold">{{ $album->nama_album }}</h5>
                <p class="text-sm text-gray-500"><small>ID Folder: {{ $album->google_drive_folder_id }}</small></p>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('galeri.edit', $album->id) }}" class="bg-gray-300 text-gray-700 px-3 py-1 rounded-md text-sm hover:bg-gray-400">Edit Album</a>
                    
                    <form action="{{ route('galeri.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
