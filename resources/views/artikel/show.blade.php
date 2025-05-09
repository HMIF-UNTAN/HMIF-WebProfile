@extends('layouts.app')

@section('content')
<div class="relative text-white py-20 min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <div class="absolute inset-0 bg-[#0F469699] z-0"></div>

    <div class="relative z-10 container px-4 sm:px-6 md:px-8 py-12">
        <!-- Bagian utama, teks dan logo -->
        <div class="flex flex-col-reverse md:flex-row items-center justify-between max-w-6xl mx-auto space-y-10 md:space-y-0 md:gap-x-16">

            <!-- Bagian teks -->
            <div class="md:w-1/2 animate-fade-in-left gap-4 flex flex-col items-center md:items-start text-center md:text-left">
                <h1 class="text-white text-3xl sm:text-4xl md:text-5xl font-bold text-shadow-lg break-words">
                    {{ $artikel->judul }}
                </h1>
            </div>

            <!-- Bagian logo -->
            <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-6 md:mb-0">
                <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="w-2/3 md:w-full max-w-xs md:max-w-sm">
            </div>
        </div>        
    </div>

    <!-- Divider di bawah -->
    <div class="custom-shape-divider-bottom-1745286436">
        <svg class="w-full h-auto" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-current text-white"></path>
        </svg>
    </div>
</div>
<div class="container mx-auto py-10 px-4 sm:px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Gambar Artikel -->
        <div class="mb-6">
            <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full rounded-lg shadow-lg object-cover">
        </div>

        <!-- Judul Artikel -->
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-[#0F4696] mb-3 break-words">
            {{ $artikel->judul }}
        </h1>

        <!-- Metadata -->
        <div class="mb-6 flex flex-wrap gap-4 text-sm text-gray-500">
            @php
                $isUpcoming = \Carbon\Carbon::parse($artikel->tanggal_kegiatan)->isFuture();
            @endphp

            <span class="flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M7 7h.01M3 11.586V7a2 2 0 012-2h4.586a2 2 0 011.414.586l7.414 7.414a2 2 0 010 2.828l-4.586 4.586a2 2 0 01-2.828 0L3.586 13a2 2 0 01-.586-1.414z"/>
                </svg>
                {{ $artikel->kategori_kegiatan }}
            </span>

            <span class="flex items-center gap-2 px-3 py-1 rounded-full 
                {{ $isUpcoming ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::parse($artikel->tanggal_kegiatan)->format('d M Y') }}
            </span>
        </div>

        <!-- Konten -->
        <div class="prose prose-sm sm:prose lg:prose-lg xl:prose-xl mb-6 max-w-none text-justify">
            {!! $artikel->konten !!}
        </div>

        <!-- Share -->
        <div class="my-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Bagikan Artikel:</h3>
            <div class="flex gap-4 flex-wrap">
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 10-11.5 9.87v-6.99h-2.17v-2.88h2.17v-2.19c0-2.14 1.27-3.33 3.22-3.33.93 0 1.9.17 1.9.17v2.08h-1.07c-1.06 0-1.39.66-1.39 1.34v1.93h2.36l-.38 2.88h-1.98v6.99A10 10 0 0022 12z"/>
                    </svg>
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->judul) }}" target="_blank" class="text-blue-400 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                    </svg>
                </a>
                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' ' . request()->fullUrl()) }}" target="_blank" class="text-green-500 hover:text-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16.72 13.06c-.29-.15-1.7-.84-1.96-.94s-.46-.15-.66.15-.76.94-.94 1.13-.35.22-.64.07a7.36 7.36 0 01-2.2-1.36 8.31 8.31 0 01-1.54-1.93c-.16-.28-.02-.43.12-.57.13-.14.29-.34.44-.51a1.93 1.93 0 00.3-.51.51.51 0 00-.02-.53c-.07-.15-.66-1.59-.9-2.17s-.46-.5-.64-.51-.36 0-.56 0a1.08 1.08 0 00-.77.36 3.21 3.21 0 00-1 2.37 5.56 5.56 0 001.18 3.12c.16.22 2.2 3.43 5.3 4.8.74.32 1.31.5 1.76.64a4.23 4.23 0 002 .12 3.36 3.36 0 002.14-1.53 2.76 2.76 0 00.2-1.53c-.08-.15-.26-.24-.55-.38z"/>
                        <path d="M12.04 2A10 10 0 002.7 14.73L2 17.77l3.16-.82A10 10 0 1012.04 2zm0 18.31a8.34 8.34 0 01-4.19-1.14l-.3-.18-2.35.61.63-2.29-.2-.35a8.34 8.34 0 1115.87-4.48 8.33 8.33 0 01-9.46 8.83z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-10">
            <a href="{{ route('artikel.index') }}" class="inline-block bg-[#0F4696] text-white font-semibold py-2 px-4 rounded-md hover:bg-[#0C3A6B] transition">
                Kembali ke Daftar Artikel
            </a>
        </div>
    </div>
</div>
@endsection