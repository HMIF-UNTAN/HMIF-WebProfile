@extends('layouts.app')

@section('content')
<div class="relative text-white min-h-[90vh] md:min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-[rgba(15,70,150,0.6)] z-0"></div>

    <!-- Wrapper -->
    <div class="relative z-10 container mx-auto px-4 py-12 md:py-0 h-full">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between max-w-6xl mx-auto space-y-10 md:space-y-0 md:gap-x-16 md:min-h-screen">
            <!-- Text Section -->
            <div class="md:w-1/2 animate-fade-in-left gap-4 flex flex-col items-center md:items-start text-center md:text-left mt-6 md:mt-10">
                <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-bold text-shadow-lg">
                    Album HMIF
                </h1>
                <p class="text-lg mb-4 text-shadow-lg">
                    Dokumentasi kegiatan HMIF yang telah terlaksana.
                </p>
            </div>
            
            <!-- Logo Section -->
            <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-6 md:mb-0">
                <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="w-2/3 md:w-full max-w-xs md:max-w-sm">
            </div>
        </div>        
    </div>

    <!-- Shape Divider -->
    <div class="custom-shape-divider-bottom-1745286436">
        <svg class="w-full h-20 md:h-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<div class="container mx-auto py-10 px-[16%]">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        @forelse($galeri as $album)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-[1.02] p-[10%]">
                <!-- Pembungkus gambar dengan rasio 1:1 -->
                <div class="w-full aspect-square bg-white">
                    <img src="{{ Storage::url($album->thumbnail) }}" alt="{{ $album->nama_album }}" class="w-full h-full object-cover rounded-2xl"/>
                </div>
                <div class="px-4 pt-4 text-center">
                    <a href="{{ route('galeri.show', $album->id) }}" class="text-base font-semibold text-[#0F4696] leading-tight hover:underline">
                        {{ $album->nama_album }}
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center">Belum ada album tersedia.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $galeri->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
