@extends('layouts.app')

@section('content')
<div class="relative text-white py-20 min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <div class="absolute inset-0" style="background-color: rgba(15, 70, 150, 0.6); z-index: 0;"></div>

    <div class="relative z-10 container py-12">
        <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto space-y-10 md:space-y-0 md:gap-x-16 px-0">
            <div class="md:w-1/2 animate-fade-in-left">
                <p class="text-lg mb-4 text-shadow-lg">
                    A place where dreams are shaped into visions,<br>
                    visions are moved by action,<br>
                    and actions grow into lasting change
                </p>
                <h1 class="text-white text-4xl md:text-4xl font-bold text-shadow-lg">
                    Within us and Around us
                </h1>
            </div>
            
        
            <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right">
                <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="max-w-xs md:max-w-sm">
            </div>
        </div>        
    </div>

    <div class="custom-shape-divider-bottom-1745286436">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<div class="bg-white py-5 py-5">
    <div class="container mx-auto px-4 text-center py-12">
        <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-8 opacity-0 transition-opacity duration-700 will-change-transform" data-animate="fade-in-top">
            Profil Video HMIF FT UNTAN
        </h2>
    
        <div class="w-full max-w-5xl mx-auto aspect-video rounded-lg shadow-lg overflow-hidden opacity-0 transition-opacity duration-700 will-change-transform" data-animate="fade-in-top">
            <iframe class="w-full h-full"
                src="https://www.youtube.com/embed/PZUHAFrWt7M?si=72fYBTBBsHf-yQpX" {{-- Ganti Link Video Profil Disini --> --}}
                title="Profil HMIF FT UNTAN"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>       
</div>
<section class="bg-[#0F4696]">
    <div class="container p-3">
        <p>&nbsp;</p>
    </div>
</section>
<div class="bg-white text-gray-800 py-10">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row gap-10 items-start">
      
      <!-- Kiri: Tentang Kami -->
      <div class="md:w-1/2 w-full">
        <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-8 text-center opacity-0 transition-opacity duration-700 will-change-transform" data-animate="fade-in-top">
          Tentang Kami
        </h2>
  
        <div class="swiper swiper-tentangkami w-full py-6 h-[650px] opacity-0 transition-opacity duration-700 will-change-transform" data-animate="fade-in-top">
          <div class="swiper-wrapper h-full">
            @foreach ($dataTentangKami as $item)
              <div class="swiper-slide h-full">
                <div class="bg-gray-50 rounded-xl shadow-md p-6 h-full flex flex-col justify-center items-center text-center">
                  <h3 class="text-xl font-bold text-[#0F4696] mb-4">
                    {{ $item['judul'] }}
                  </h3>
                  @if (is_array($item['konten']))
                    @if (Str::contains(strtolower($item['judul']), 'misi'))
                      <ol class="list-decimal list-inside text-sm space-y-1 text-dynamic transition-all duration-300">
                        @foreach ($item['konten'] as $poin)
                          <li>{{ $poin }}</li>
                        @endforeach
                      </ol>
                    @else
                      <p class="text-sm text-dynamic transition-all duration-300">{{ $item['konten'][0] }}</p>
                    @endif
                  @else
                    <p class="text-sm">{{ $item['konten'] }}</p>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>        
      </div>
  
      <!-- Kanan: Newest Article -->
      <div class="md:w-1/2 w-full will-change-transform text-center" data-animate="fade-in-top">
        <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-8 will-change-transform">Newest Articles</h2>
        
        <div class="flex flex-col gap-4 h-[650px]">
            @foreach ($newestArticles as $article)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition h-1/2 flex flex-col">
                    <div class="h-2/3">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="h-1/3 flex items-center justify-center px-4">
                        <a href="#" class="text-center text-xl font-bold text-[#0F4696]">{{ $article->judul }}</a>
                    </div>
                </div>
            @endforeach
        </div>          
      </div>
    </div>
</div>  
<section class="bg-[#0F4696]">
    <div class="container p-3">
        <p>&nbsp;</p>
    </div>
</section>
<div class="swiper swiper-galeri w-full py-8">
  <div class="swiper-wrapper">
    @foreach ($albums as $album)
      <div class="swiper-slide flex items-center justify-center h-full">
        <div class="w-[90%] max-w-3xl mx-auto bg-white shadow rounded-lg overflow-hidden flex flex-col h-[450px]">
          <img src="{{ $album->thumbnail }}" alt="{{ $album->nama_album }}" class="w-full h-2/3 object-cover">
          <div class="p-3 text-center bg-white">
            <h4 class="text-base font-semibold text-[#0F4696] leading-snug">
              {{ $album->nama_album }}
            </h4>
          </div>
        </div>
      </div>    
    @endforeach
  </div>

  <div class="swiper-pagination mt-4"></div>
</div>
@endsection
