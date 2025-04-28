@extends('layouts.dapur')

@section('content')
<div class="p-5">
    <h2 class="text-2xl font-bold mb-6">Daftar Artikel</h2>

    <form method="GET" action="{{ route('dapurartikel') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input 
            type="text" 
            name="search" 
            class="border rounded-lg p-2 w-full" 
            placeholder="Cari judul..." 
            value="{{ request('search') }}"
        >
        
        <select name="status" class="border rounded-lg p-2 w-full">
            <option value="">Semua Kegiatan</option>
            <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
            <option value="past" {{ request('status') === 'past' ? 'selected' : '' }}>Sudah Terlaksana</option>
        </select>
    
        <select name="sort" class="border rounded-lg p-2 w-full">
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Terlama → Terbaru</option>
            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Terbaru → Terlama</option>
        </select>
    
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
            Filter
        </button>
    </form>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-800 text-white text-left">
                    <th class="p-3">#</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Slug</th>
                    <th class="p-3">Tanggal Kegiatan</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikels as $index => $artikel)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-3">{{ $index + 1 }}</td>
                        <td class="p-3">{{ $artikel->judul }}</td>
                        <td class="p-3">{{ $artikel->slug }}</td>
                        <td class="p-3">{{ $artikel->tanggal_kegiatan->format('d M Y') }}</td>
                        <td class="p-3 flex flex-wrap gap-2">
                            <a href="{{ route('artikel.edit', $artikel->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-5 text-gray-500">
                            Ga Ada Bray
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-6">
        {{ $artikels->appends(request()->query())->links('pagination::tailwind') }}
    </div>

    <div class="mt-6">
        <a href="{{ route('tambahArtikel') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Artikel Baru
        </a>
    </div>
</div>
@endsection
