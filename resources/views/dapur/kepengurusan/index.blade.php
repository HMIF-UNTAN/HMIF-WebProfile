@extends('layouts.dapur')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-3xl font-semibold mb-6">Data Pengurus</h1>
    
    <a href="{{ route('tambahpengurus') }}" class="bg-[#0C0221] hover:bg-[#1E1E1E] text-white font-semibold py-2 px-6 rounded-md mb-4 inline-block">
        Tambah Pengurus
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-[#0C0221] text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NIM</th>
                    <th class="py-3 px-6 text-left">Divisi</th>
                    <th class="py-3 px-6 text-left">Jabatan</th>
                    <th class="py-3 px-6 text-left">Periode</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengurus as $p)
                    <tr class="border-t border-gray-200">
                        <td class="py-3 px-6">{{ $p->nama }}</td>
                        <td class="py-3 px-6">{{ $p->nim }}</td>
                        <td class="py-3 px-6">{{ $p->kepengurusan->divisi->nama }}</td>
                        <td class="py-3 px-6">{{ $p->kepengurusan->jabatan }}</td>
                        <td class="py-3 px-6">{{ $p->kepengurusan->periode }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('pengurus.edit', $p->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-4 rounded-md text-sm">
                                Edit
                            </a>
                            
                            <form action="{{ route('pengurus.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded-md text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection