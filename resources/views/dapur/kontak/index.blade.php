@extends('layouts.dapur')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-6">Kontak HMIF</h2>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg p-6 mb-4">
        <p><strong>Alamat:</strong> {{ $kontak->alamat }}</p>
        <p><strong>Nama Narahubung:</strong> {{ $kontak->narahubung_nama }}</p>
        <p><strong>Kontak Narahubung:</strong> {{ $kontak->narahubung_kontak }}</p>
        <p><strong>Email:</strong> {{ $kontak->email }}</p>

        <button id="toggleButton" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4 hover:bg-blue-600">
            Edit Kontak
        </button>
        
        <div id="editForm" class="hidden mt-4">
            <form action="{{ route('kontak.update', $kontak->id) }}" method="POST">
                @csrf
                @method('PUT')
        
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="alamat" value="{{ old('alamat', $kontak->alamat) }}" required>
                </div>
        
                <div class="mb-4">
                    <label for="narahubung_nama" class="block text-sm font-medium text-gray-700">Nama Narahubung</label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="narahubung_nama" value="{{ old('narahubung_nama', $kontak->narahubung_nama) }}" required>
                </div>
        
                <div class="mb-4">
                    <label for="narahubung_kontak" class="block text-sm font-medium text-gray-700">Kontak Narahubung</label>
                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="narahubung_kontak" value="{{ old('narahubung_kontak', $kontak->narahubung_kontak) }}" required>
                </div>
        
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email HMIF</label>
                    <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="email" value="{{ old('email', $kontak->email) }}" required>
                </div>
        
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">Simpan Perubahan</button>
            </form>
        </div>        
    </div>
</div>
@endsection
