@extends('layouts.app')

@section('content')
<div class="relative text-white py-20 min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <div class="absolute inset-0" style="background-color: rgba(15, 70, 150, 0.6); z-index: 0;"></div>

    <div class="relative z-10 container py-12">
        <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto space-y-10 md:space-y-0 md:gap-x-16 px-0">
            <div class="md:w-1/2 animate-fade-in-left gap-4 flex flex-col items-start">
                <h1 class="text-white text-4xl md:text-4xl font-bold text-shadow-lg">
                    Kepengurusan HMIF FT UNTAN
                </h1>
                <p class="text-lg mb-4 text-shadow-lg">
                    Susunan kepengurusan HMIF tahun 2025.
                </p>
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
<div class="container mx-auto py-10">
    @foreach($daftarDivisi as $divisi)
        @php
            $judulDivisi = $divisi->judul;

            if ($judulDivisi === 'Pengurus Harian') {
                $gabungan = collect();
                $gabungan = $gabungan
                    ->merge($pengurusPerDivisiNama['Ketua Himpunan'] ?? collect())
                    ->merge($pengurusPerDivisiNama['Sekretaris'] ?? collect())
                    ->merge($pengurusPerDivisiNama['Bendahara'] ?? collect());
            } else {
                $gabungan = $pengurusPerDivisiNama[$judulDivisi] ?? collect();
            }

            if($judulDivisi === 'Pengurus Harian'){
                $gabungan = collect([
                    $pengurusPerDivisiNama['Sekretaris']->first() ?? null,
                    $pengurusPerDivisiNama['Ketua Himpunan']->first() ?? null,
                    $pengurusPerDivisiNama['Bendahara']->first() ?? null,
                ])->filter();
            } else {
                $gabungan = $gabungan->sortByDesc(fn($item) => $item->pengurus->jenis_jabatan === 'Inti');
            }
            
        @endphp

        <section class="mb-16">
            <h2 class="text-2xl font-bold text-[#0F4696] mb-2 text-center" data-animate="fade-in-top">{{ $judulDivisi }}</h2>            
            <div class="w-12 h-1 bg-[#0F4696] rounded mb-6 mx-auto" data-animate="fade-in-top"></div>

            <div class="relative">
                <!-- Swiper Pengurus -->
                <div class="swiper pengurus-swiper px-4 h-[500px]" data-animate="fade-in-top">
                    <div class="swiper-wrapper flex items-stretch my-auto will-change-transform">
                        @forelse ($gabungan as $relasi)
                            @php
                                $anggota = $relasi->pengurus;
                                $roleText = $judulDivisi === 'Pengurus Inti'
                                    ? $relasi->divisi->nama
                                    : ($anggota->jenis_jabatan === 'Inti'
                                        ? 'Ketua Divisi ' . $divisi->judul
                                        : 'Anggota Divisi ' . $divisi->judul);
                            @endphp

                            <div class="swiper-slide !w-[250px] md:!w-[280px] lg:!w-[300px] flex-shrink-0 will-change-transform">
                                <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-[400px] flex flex-col transition-transform duration-300 hover:scale-[1.02]">
                                    <div class="h-[300px] w-full">
                                        @if ($anggota->foto)
                                            <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-full h-full object-cover" />
                                        @else
                                            <img src="{{ asset('default-user.png') }}" alt="default" class="w-full h-full object-cover" />
                                        @endif
                                    </div>
                                    <div class="flex-1 px-3 py-2 flex flex-col items-center justify-center text-center">
                                        <h3 class="text-sm font-semibold text-[#0F4696] leading-tight">{{ $anggota->nama }}</h3>
                                        <p class="text-xs text-[#0F4696] italic mt-1">{{ $roleText }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada pengurus untuk divisi ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    @endforeach
</div>
@endsection
