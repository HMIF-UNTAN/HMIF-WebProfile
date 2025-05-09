@extends('layouts.app')

@section('content')
<div class="relative text-white min-h-[90vh] md:min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0" style="background-color: rgba(15, 70, 150, 0.6); z-index: 0;"></div>

    <!-- Wrapper -->
    <div class="relative z-10 container mx-auto px-4 py-12 md:py-0 h-full">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between max-w-6xl mx-auto space-y-10 md:space-y-0 md:gap-x-16 md:min-h-screen">
            <!-- Text Section -->
            <div class="md:w-1/2 animate-fade-in-left gap-4 flex flex-col items-center md:items-start text-center md:text-left mt-6 md:mt-0">
                <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-bold text-shadow-lg">
                    Dokumentasi Kegiatan<br>
                    {{ $album->nama_album }}
                </h1>
            </div>
            
            <!-- Logo Section -->
            <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-6 md:mb-0">
                <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="w-2/3 md:w-full max-w-xs md:max-w-sm">
            </div>
        </div>        
    </div>

    <!-- Shape Divider -->
    <div class="custom-shape-divider-bottom-1745286436">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<div class="container mx-auto py-10 px-[16%]">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#0F4696]">Preview Foto</h2>
        <a href="https://drive.google.com/drive/folders/{{ $album->google_drive_folder_id }}" target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2 bg-[#0F4696] text-white text-sm font-medium rounded-lg shadow hover:bg-[#0c3b7c] transition mr-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 256 256" fill="currentColor">
                <path d="M234.1,177.1,161.5,52.5A15.9,15.9,0,0,0,147.7,44H108.3a15.9,15.9,0,0,0-13.8,8.5L22.1,177.1A16.1,16.1,0,0,0,36.2,200H219.8A16.1,16.1,0,0,0,234.1,177.1ZM128,144l-22.6,39.1a4,4,0,0,1-3.5,2H68a4,4,0,0,1-3.5-6L116.4,68.9a4,4,0,0,1,7.2,0l51.9,110.2a4,4,0,0,1-3.5,6H153.1a4,4,0,0,1-3.5-2Z"/>
            </svg>
            Open in Drive
        </a>
    </div>

    <div class="max-h-[600px] overflow-y-auto pr-2">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
            @forelse ($files as $file)
                <div class="aspect-square rounded-2xl overflow-hidden shadow-lg">
                    <iframe 
                        src="{{ $file['previewUrl'] }}" 
                        frameborder="0" 
                        allowfullscreen 
                        class="w-full h-full">
                    </iframe>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">Tidak ada foto tersedia di album ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
