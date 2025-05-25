@extends('layouts.dapur') {{-- sesuaikan layoutnya --}}

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-[#0F4696] mb-6">Daftar Alumni Belum Terverifikasi</h2>

    <div class="overflow-x-auto rounded-xl shadow-md">
        <table class="min-w-full bg-white text-sm">
            <thead>
                <tr class="bg-[#0F4696] text-white text-left">
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">NIM</th>
                    <th class="py-3 px-4">Angkatan</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">No. HP</th>
                    <th class="py-3 px-4">Tanggal Daftar</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alumniBelumVerifikasi as $alumni)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="py-2 px-4 font-medium">{{ $alumni->nama_lengkap }}</td>
                        <td class="py-2 px-4">{{ $alumni->nim }}</td>
                        <td class="py-2 px-4">{{ $alumni->angkatan }}</td>
                        <td class="py-2 px-4">{{ $alumni->email }}</td>
                        <td class="py-2 px-4">{{ $alumni->no_hp }}</td>
                        <td class="py-2 px-4">{{ $alumni->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('dapur.alumni.verifikasi', $alumni->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memverifikasi alumni ini?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Verifikasi
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">Tidak ada alumni yang menunggu verifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
