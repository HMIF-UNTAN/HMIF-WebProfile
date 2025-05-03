@extends('layouts.dapur')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Edit Data</h2>

    <form action="{{ route('tentangkami.update', $tentangkami->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Data</label>
            <input type="text" name="judul" value="{{ old('judul', $tentangkami->judul) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
        </div>

        <div>
            @php
                $konten = $tentangkami->konten;
            @endphp

            <label for="konten" class="block text-sm font-medium text-gray-700">Konten</label>

            @if(is_array($konten) && count($konten) > 1)
                <textarea name="konten" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>{{ implode("\n", $konten) }}</textarea>
            @else
                <textarea name="konten" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>{{ is_array($konten) ? $konten[0] : $konten }}</textarea>
            @endif
        </div>

        <div>
            <label for="tipe_informasi" class="block text-sm font-medium text-gray-700">Tipe Informasi</label>
            <select name="tipe_informasi" id="tipe_informasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                <option value="Umum" {{ old('tipe_informasi', $tentangkami->tipe_informasi) == 'Umum' ? 'selected' : '' }}>Umum</option>
                <option value="Divisi" {{ old('tipe_informasi', $tentangkami->tipe_informasi) == 'Divisi' ? 'selected' : '' }}>Divisi</option>
            </select>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition">
                Update
            </button>
            <a href="{{ route('dapurtentangkami') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-md transition">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
