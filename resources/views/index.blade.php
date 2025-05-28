@extends('layouts.app')

@section('content')
<div class="relative text-white min-h-[90vh] md:min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-[rgba(15,70,150,0.6)] z-0"></div>

    <!-- Flex wrapper untuk vertical center -->
    <div class="relative z-10 container mx-auto px-4 py-12 md:py-0 h-full">
        <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto h-full min-h-[60vh] md:min-h-screen">
              <div class="flex flex-col-reverse md:flex-row items-center justify-between w-full space-y-10 md:space-y-0 md:gap-x-16 md:-translate-y-4">
                <!-- Text -->
                <div class="md:w-1/2 animate-fade-in-left text-center md:text-left">
                    <p class="text-base md:text-lg mb-4 text-shadow-lg leading-relaxed">
                        A place where dreams are shaped into visions,<br>
                        visions are moved by action,<br>
                        and actions grow into lasting change
                    </p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-shadow-lg text-white">
                        Within us and Around us
                    </h1>
                </div>

                <!-- Logo -->
                <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-6 md:mb-0">
                    <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="w-2/3 md:w-full max-w-xs md:max-w-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Shape Divider -->
    <div class="custom-shape-divider-bottom-1745286436">
        <svg class="w-full h-20 md:h-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,
                    82.39-16.72,168.19-17.73,250.45-.39C823.78,31,
                    906.67,72,985.66,92.83c70.05,18.48,
                    146.53,26.09,214.34,3V0H0V27.35A600.21,
                    600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
        </svg>
    </div>
</div>
<div class="bg-gradient-to-b from-white to-[#E0EDFF] py-5">
    <div class="container mx-auto px-4 text-center py-12">
        <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-8 opacity-0 transform transition-opacity duration-700 will-change-transform" data-animate="fade-in-top">
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
<div class="bg-[#E0EDFF] text-gray-800 py-10">
  <div class="max-w-6xl mx-auto px-6 flex flex-col gap-10 items-start">
    <!-- Full width: Tentang Kami -->
    <div class="w-full">
      <div class="opacity-0 transform transition-opacity duration-700 will-change-transform" data-animate="fade-in-top">
        <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-3 text-center">
          Tentang Kami
        </h2>
        <div class="w-12 h-1 bg-[#0F4696] rounded mb-6 mx-auto"></div>
      </div> 
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full py-6">
        @foreach ($dataTentangKami as $index => $item)
          <!-- Bungkus seluruh card dalam .group -->
          <div class="group relative w-full h-80 [perspective:1000px] opacity-0 transform transition-opacity duration-700 will-change-transform"
              data-animate="fade-in-top"
              style="transition-delay: {{ $index * 100 }}ms">

            <!-- Yang diputar: bagian dalam -->
            <div class="relative w-full h-full transition-transform duration-700 transform-style preserve-3d group-hover:rotate-y-180 rounded-xl shadow-md">
              
              <!-- Front -->
              <div class="absolute w-full h-full bg-white border border-[#0F4696] rounded-xl backface-hidden flex flex-col justify-center items-center text-center p-6">
                <h3 class="text-xl font-bold text-[#0F4696]">{{ $item['judul'] }}</h3>
              </div>

              <!-- Back -->
              <div class="absolute w-full h-full bg-[#0F4696] border border-[#0F4696] rounded-xl shadow-md backface-hidden transform rotate-y-180 flex items-center justify-center text-white text-center">
                @if (is_array($item['konten']))
                  @if (Str::contains(strtolower($item['judul']), 'misi'))
                    <ol class="list-decimal list-inside text-sm space-y-1 px-4">
                      @foreach ($item['konten'] as $poin)
                        <li>{{ $poin }}</li>
                      @endforeach
                    </ol>
                  @else
                    <p class="text-sm px-4">{{ $item['konten'][0] }}</p>
                  @endif
                @else
                  <p class="text-sm px-4">{{ $item['konten'] }}</p>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>  
</div>  
<div class="swiper swiper-galeri w-full max-w-full overflow-visible pt-[200px] text-center bg-gradient-to-b from-[#E0EDFF] to-white">
  <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-3 opacity-0 transform transition-opacity duration-700 will-change-transform"
      data-animate="fade-in-top">
      Galeri HMIF
  </h2>
  <div class="w-12 h-1 bg-[#0F4696] rounded mb-6 mx-auto opacity-0 transform transition-opacity duration-700 will-change-transform"
        data-animate="fade-in-top"></div>
        <div class="swiper-wrapper my-10 mx-0">
          @foreach ($albums as $album)
            <div class="swiper-slide w-[500px] flex items-center justify-center group">
              <a href="{{ route('galeri.show', $album->id) }}" class="block w-full h-full">
                <div class="relative w-full h-[450px] bg-white shadow-lg rounded-2xl overflow-hidden">
                  <div class="absolute inset-0">
                    <img src="{{ Storage::url($album->thumbnail) }}" alt="{{ $album->nama_album }}" class="w-full h-full object-cover" loading="lazy" decoding="async" />
                  </div>
      
                  {{-- Gradient Overlay --}}
                  <div class="absolute bottom-0 left-0 right-0 w-full h-1/2 group-hover:h-full transition-all duration-500 ease-in-out bg-gradient-to-t from-[#0F4696] to-transparent z-10"></div>
      
                  {{-- Text --}}
                  <div class="absolute top-1/2 left-1/2 z-20 text-white 
                              transform -translate-x-1/2 translate-y-[120px] 
                              group-hover:translate-y-[-50%] 
                              transition-transform duration-500 ease-in-out 
                              text-center">
                    <h4 class="text-lg font-bold text-white">{{ $album->nama_album }}</h4>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
      </div>              
</div>
<section class="py-16 bg-white text-center mb-10">
  <h2 class="text-3xl md:text-4xl font-bold text-[#0F4696] mb-3 typewriter-text" data-text="Kepengurusan HMIF 2025">
  </h2> 
  <div class="w-12 h-1 bg-[#0F4696] rounded mx-auto"></div>
  <div class="container mx-auto px-4 mt-[50px]">
    <!-- WRAPPER TOMBOL -->
    <div class="flex justify-center mb-[80px]">
      <div class="bg-[#E0EDFF] rounded-2xl py-2 px-4 shadow-sm w-full max-w-7xl flex flex-wrap justify-center gap-1 min-h-[60px]">
        @foreach ($daftarDivisi as $divisi)
          <button
            class="divisi-button w-[200px] min-h-[40px] px-4 py-1 rounded-full text-sm font-medium transition text-center leading-tight whitespace-normal overflow-hidden line-clamp-2 shadow flex items-center justify-center bg-transparent text-gray-500 shadow-none typewriter-text"
            data-target="divisi-{{ $divisi->id }}"
            data-text="{{ $divisi->judul }}">
          </button>
        @endforeach
      </div>
    </div>
  
    <!-- WRAPPER CARD TEKS -->
    <div id="statistik-container" class="flex justify-center gap-[8%] items-center flex-wrap">
      {{-- Kartu Jumlah Divisi --}}
      <div class="flex flex-col items-center border border-transparent bg-transparent p-4 rounded-lg shadow w-36 text-[#0F4696] font-bold shadow-none"
          data-animate="fade-in-left">
          <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M4 20h5v-2a4 4 0 00-3-3.87M12 4a4 4 0 100 8 4 4 0 000-8z" />
          </svg>
          <div class="text-lg font-semibold">{{ count($daftarDivisi)-1 }}</div>
          <div class="text-sm">Divisi</div>
      </div>
  
      {{-- Area Konten Divisi --}}
      <div class="relative max-w-lg w-full rounded-lg shadow h-[250px] text-white overflow-hidden p-6 flex items-center justify-center text-center"
           style="background: linear-gradient(rgba(15, 70, 150, 0.6), rgba(15, 70, 150, 0.6)), url('{{ asset('storage/Background-Footer.jpg') }}'); background-size: cover; background-position: center;"
           data-animate="fade-in-bottom">
          @foreach ($daftarDivisi as $divisi)
              <div id="divisi-{{ $divisi->id }}"
                   class="divisi-section absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center transition-opacity duration-300 opacity-0 hidden">
                  <h3 class="text-xl font-bold mb-2 blur-in-out-text text-white" data-text="{{ $divisi->judul }}">
                  </h3>
                  <p class="px-4 blur-in-out-text" data-text="{{ $divisi->konten[0] ?? 'Deskripsi Divisi Belum Ditambahkan' }}">
                  </p>
              </div>
          @endforeach
      </div>
  
      <div class="flex flex-col items-center border border-transparent bg-transparent p-4 rounded-lg shadow w-36 text-[#0F4696] font-bold shadow-none"
          data-animate="fade-in-right">
          <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <div class="text-lg font-semibold">{{ count($pengurus) }}</div>
          <div class="text-sm">Pengurus</div>
      </div>
    </div>   
  </div>  
</section>
<section class="pt-12  bg-white">
  <div class="w-full px-4">
    <h2 class="text-3xl font-bold text-[#0F4696] mb-3 text-center transform transition-opacity duration-700 will-change-transform" 
        data-animate="fade-in-top">
        Artikel Terbaru
    </h2>
    <div class="w-12 h-1 bg-[#0F4696] rounded mx-auto opacity-0 transform transition-opacity duration-700 will-change-transform" 
        data-animate="fade-in-top"></div>
    
    <div class="swiper artikel-carousel mt-10">
      <div class="swiper-wrapper">
        @foreach ($newestArticles as $article)
          <div class="swiper-slide w-auto h-full mb-10">
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 hover:scale-[1.02] overflow-hidden max-w-xs sm:max-w-sm md:max-w-md flex flex-col min-h-[330px]">
              <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover">
              <div class="p-4 flex flex-col flex-grow">
                <h3 class="text-lg font-semibold text-[#0F4696] leading-tight line-clamp-2">{{ $article->judul }}</h3>
                <div class="mt-auto pt-4">
                  <a href="{{ route('artikel.show', $article->slug) }}" class="text-sm text-[#0F4696] font-semibold hover:underline">
                    Baca Selengkapnya →
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
