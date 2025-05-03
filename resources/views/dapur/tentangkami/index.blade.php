@extends('layouts.dapur')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Data Tentang Kami</h2>

    <form method="GET" action="{{ route('dapurtentangkami') }}" class="flex flex-wrap gap-4 mb-6">
        <input type="text" name="search" class="flex-1 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2" placeholder="Cari judul..." value="{{ request('search') }}">
        
        <button type="submit" class="bg-[#0C0221] hover:bg-[#1E1E1E] text-white font-semibold px-6 py-2 rounded-md transition">
            Search
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Judul</th>
                    <th class="py-3 px-4 text-left">Deskripsi</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tentangkamis as $index => $tentangkami)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $tentangkami->judul }}</td>
                        <td class="py-3 px-4">
                            @php $konten = $tentangkami->konten; @endphp

                            @if(is_array($konten) && count($konten) > 1)
                                <ol class="list-decimal list-inside">
                                    @foreach($konten as $poin)
                                        <li>{{ $poin }}</li>
                                    @endforeach
                                </ol>
                            @else
                                <p>{{ is_array($konten) ? $konten[0] : $konten }}</p>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex gap-2">
                                <a href="{{ route('tentangkami.edit', $tentangkami->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded-md text-sm transition">
                                    Edit
                                </a>
                                <form action="{{ route('tentangkami.destroy', $tentangkami->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md text-sm transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">Ga Ada Bray</td>
                    </tr>    
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-center mt-6">
        {{ $tentangkamis->appends(request()->query())->links('pagination::tailwind') }}
    </div>

    <div class="mt-6">
        <a href="{{ route('tambahtentangkami') }}" class="inline-block bg-[#0C0221] hover:bg-[#1E1E1E] text-white font-semibold py-2 px-6 rounded-md transition">
            Tambah Data Baru
        </a>
    </div>
</div>
@endsection
