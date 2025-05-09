@extends('layouts.app')

@section('content')
<div class="relative text-white py-20 min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <div class="absolute inset-0" style="background-color: rgba(15, 70, 150, 0.6); z-index: 0;"></div>

    <div class="relative z-10 container py-12">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between max-w-6xl mx-auto space-y-10 md:space-y-0 md:gap-x-16 px-4">
            <div class="w-full md:w-1/2 animate-fade-in-left gap-4 flex flex-col items-center md:items-start text-center md:text-left">
                <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-bold text-shadow-lg">
                    Artikel HMIF
                </h1>
                <p class="text-lg mb-4 text-shadow-lg">
                    Kegiatan-kegiatan HMIF yang sudah maupun akan terlaksana.
                </p>
            </div>
            <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-6 md:mb-0">
                <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="w-2/3 md:w-full max-w-xs md:max-w-sm">
            </div>
        </div>        
    </div>

    <div class="custom-shape-divider-bottom-1745286436">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<div class="container mx-auto px-[8%] py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Kolom Kiri: Artikel --}}
        <div class="w-full lg:w-2/3">
            @if($artikels->isEmpty())
                <p class="text-center text-gray-500">Belum ada artikel yang tersedia.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($artikels as $artikel)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                            @if($artikel->thumbnail)
                                <img src="{{ Storage::url($artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover rounded-lg">
                            @endif
                            <div class="p-5 flex flex-col flex-grow">
                                {{-- Label kategori & tanggal --}}
                                @php
                                    $isUpcoming = \Carbon\Carbon::parse($artikel->tanggal_kegiatan)->isFuture();
                                @endphp

                                <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                                    <!-- Tag kategori -->
                                    <span class="flex items-center gap-1 bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full">
                                        <!-- icon tag -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M3 11.586V7a2 2 0 012-2h4.586a2 2 0 011.414.586l7.414 7.414a2 2 0 010 2.828l-4.586 4.586a2 2 0 01-2.828 0L3.586 13a2 2 0 01-.586-1.414z"/>
                                        </svg>
                                        {{ $artikel->kategori_kegiatan }}
                                    </span>

                                    <!-- Tanggal kegiatan -->
                                    <span class="flex items-center gap-1 px-2 py-0.5 rounded-full
                                        {{ $isUpcoming ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        <!-- icon calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($artikel->tanggal_kegiatan)->format('d M Y') }}
                                    </span>
                                </div>                               
                                <h3 class="text-xl font-bold text-[#0F4696] mb-2 truncate">{{ $artikel->judul }}</h3>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $artikel->konten }}</p>
                                <div class="mt-auto pt-2">
                                    <a href="{{ route('artikel.show', ['slug_id' => \Illuminate\Support\Str::slug($artikel->judul) . '-' . $artikel->id]) }}"
                                        class="inline-block text-sm font-semibold text-[#0F4696] hover:underline">
                                         Baca Selengkapnya →
                                     </a>                                                                                                            
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-8">
                {{ $artikels->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar --}}
        <div class="w-full lg:w-1/3 space-y-6">
            {{-- Form Gabungan: Search + Kategori + Status --}}
            <form action="{{ route('artikel.index') }}" method="GET" class="space-y-6">

                {{-- Search Box --}}
                <input type="text" name="search" placeholder="Cari artikel..."
                    value="{{ request('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                {{-- Filter Kategori --}}
                <div>
                    <h4 class="text-lg font-semibold mb-2">Filter Kategori</h4>
                    @foreach($daftarKategori as $kategori)
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="kategori[]" value="{{ $kategori }}"
                                    {{ collect(request('kategori'))->contains($kategori) ? 'checked' : '' }}
                                    class="form-checkbox text-blue-600">
                                <span class="ml-2 text-sm text-gray-700">{{ $kategori }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Filter Status Kegiatan --}}
                <div>
                    <h4 class="text-lg font-semibold mb-2">Status Kegiatan</h4>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status_kegiatan" value="belum"
                                {{ request('status_kegiatan') == 'belum' ? 'checked' : '' }}
                                class="form-radio text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Kegiatan Mendatang</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status_kegiatan" value="terlaksana"
                                {{ request('status_kegiatan') == 'terlaksana' ? 'checked' : '' }}
                                class="form-radio text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Sudah Terlaksana</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status_kegiatan" value=""
                                {{ is_null(request('status_kegiatan')) || request('status_kegiatan') === '' ? 'checked' : '' }}
                                class="form-radio text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Semua</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="mt-2 px-3 py-1 bg-[#0F4696] text-white text-sm rounded hover:bg-blue-700">
                        Terapkan
                    </button>

                    {{-- Tombol Reset Filter --}}
                    <a href="{{ route('artikel.index') }}"
                    class="mt-2 px-3 py-1 bg-gray-200 text-sm rounded hover:bg-gray-300">
                        Reset
                    </a>
                </div>
            </form>

            {{-- Artikel Terkini --}}
            <div>
                <h4 class="text-lg font-semibold mb-3">Artikel Terkini</h4>
                <div class="space-y-3">
                    @foreach($artikelTerkini as $recent)
                        <div class="flex items-center gap-3">
                            @if($recent->thumbnail)
                                <img src="{{ Storage::url($recent->thumbnail) }}" alt="{{ $recent->judul }}"
                                    class="w-14 h-14 object-cover rounded-md">
                            @else
                                <div class="w-14 h-14 bg-gray-200 rounded-md"></div>
                            @endif

                            <div class="flex-1">
                                <a href="{{ route('artikel.show', $recent->id) }}"
                                class="block text-sm font-semibold text-[#0F4696] hover:underline">
                                    {{ Str::limit($recent->judul, 50) }}
                                </a>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($recent->tanggal_kegiatan)->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
