@extends('layouts.dapur') {{-- sesuaikan layoutnya --}}

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Alumni Belum Terverifikasi</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-xl">
            <thead>
                <tr class="bg-[#0F4696] text-white">
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">NIM</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alumniBelumVerifikasi as $alumni)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $alumni->nama_lengkap }}</td>
                        <td class="py-2 px-4">{{ $alumni->nim }}</td>
                        <td class="py-2 px-4">{{ $alumni->email }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('dapur.alumni.verifikasi', $alumni->id) }}" method="POST">
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
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">Tidak ada data alumni yang menunggu verifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
