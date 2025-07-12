@extends('layouts.app')

@section('content')
<div class="relative text-white min-h-[90vh] md:min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <div class="absolute inset-0 bg-[rgba(15,70,150,0.6)] z-0"></div>

    <div class="relative z-10 container mx-auto px-4 py-12 md:py-0 h-full">
        <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto h-full min-h-[60vh] md:min-h-screen">
            <div class="flex flex-col-reverse md:flex-row items-center justify-between w-full space-y-10 md:space-y-0 md:gap-x-16 md:-translate-y-4">

                <div class="md:w-1/2 animate-fade-in-left text-center md:text-left flex flex-col gap-4 items-center md:items-start">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-shadow-lg text-white">
                        Kepengurusan HMIF FT UNTAN
                    </h1>
                    <p class="text-base md:text-lg text-shadow-lg leading-relaxed">
                        Susunan kepengurusan HMIF tahun 2025.
                    </p>
                </div>

                <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-6 md:mb-0">
                    <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF" class="w-2/3 md:w-full max-w-xs md:max-w-sm">
                </div>
            </div>
        </div>
    </div>

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

<div class="container mx-auto py-10">
    @foreach($daftarDivisi as $divisi)
        @php
            $judulDivisi = $divisi->judul;
            $gabungan = collect(); // Inisialisasi koleksi gabungan

            // Logika untuk Divisi 'Pengurus Harian'
            if ($judulDivisi === 'Pengurus Harian') {
                // Ambil semua pengurus dari setiap jabatan inti yang relevan
                $ketuaHimpunan = $pengurusPerDivisiNama['Ketua Himpunan'] ?? collect();
                $sekretaris = $pengurusPerDivisiNama['Sekretaris'] ?? collect();
                $bendahara = $pengurusPerDivisiNama['Bendahara'] ?? collect();

                // Gabungkan semua pengurus ini
                $gabungan = $ketuaHimpunan->merge($sekretaris)->merge($bendahara);

                // Urutkan mereka sesuai urutan yang diinginkan: Sekretaris, Ketua Himpunan, Bendahara
                $urutanJabatan = [
                    'Sekretaris',
                    'Ketua Himpunan',
                    'Bendahara',
                ];

                $gabungan = $gabungan->sortBy(function($item) use ($urutanJabatan) {
                    // Gunakan nama jabatan langsung dari relasi atau pengurus jika tersedia
                    $jabatanPengurus = $item->pengurus->jenis_jabatan_spesifik ?? $item->divisi->nama ?? null; // Sesuaikan properti yang menyimpan nama jabatan/divisi spesifik jika ada
                    
                    // Jika jabatan tidak ada di daftar urutan, letakkan di akhir
                    $index = array_search($jabatanPengurus, $urutanJabatan);
                    return $index === false ? PHP_INT_MAX : $index;
                })->values(); // Reset indeks setelah pengurutan

            } else {
                // Logika untuk Divisi Selain 'Pengurus Harian'
                // Ambil pengurus berdasarkan nama divisi
                $gabungan = $pengurusPerDivisiNama[$judulDivisi] ?? collect();
                // Urutkan berdasarkan jenis_jabatan 'Inti' (Ketua Divisi)
                $gabungan = $gabungan->sortByDesc(fn($item) => $item->pengurus->jenis_jabatan === 'Inti');
            }
        @endphp

        <section class="mb-16">
            <h2 class="text-2xl font-bold text-[#0F4696] mb-2 text-center" data-animate="fade-in-top">{{ $judulDivisi }}</h2>
            <div class="w-12 h-1 bg-[#0F4696] rounded mb-6 mx-auto" data-animate="fade-in-top"></div>

            <div class="relative">
                <div class="swiper pengurus-swiper px-4 h-[500px]" data-animate="fade-in-top">
                    <div class="swiper-wrapper flex items-stretch my-auto will-change-transform">
                        @forelse ($gabungan as $relasi)
                            @php
                                $anggota = $relasi->pengurus;
                                // Menentukan teks peran/jabatan yang akan ditampilkan
                                if ($judulDivisi === 'Pengurus Harian') {
                                    // Untuk Pengurus Harian, gunakan nama jabatan spesifik dari kunci $pengurusPerDivisiNama
                                    // Asumsi: $relasi yang tergabung memiliki informasi jabatannya
                                    // Atau, Anda bisa mencocokkan dengan $divisi->judul jika itu adalah nama jabatan
                                    $roleText = $anggota->jenis_jabatan; // default, akan disesuaikan
                                    
                                    // Jika $pengurusPerDivisiNama di-keying oleh jabatan spesifik (Ketua Himpunan, Sekretaris, Bendahara)
                                    // dan setiap $relasi hanya berisi pengurus untuk jabatan itu.
                                    // Maka $relasi->divisi->nama bisa jadi adalah nama jabatannya.
                                    if ($relasi->divisi->nama === 'Ketua Himpunan' || $relasi->divisi->nama === 'Sekretaris' || $relasi->divisi->nama === 'Bendahara') {
                                        $roleText = $relasi->divisi->nama;
                                    } else {
                                        // Fallback jika tidak sesuai, mungkin dari properti lain
                                        $roleText = $anggota->jenis_jabatan; // atau properti lain yang lebih spesifik
                                    }

                                } else {
                                    // Untuk divisi lain, gunakan logika yang sudah ada
                                    $roleText = $anggota->jenis_jabatan === 'Inti'
                                        ? 'Ketua Divisi ' . $divisi->judul
                                        : 'Anggota Divisi ' . $divisi->judul;
                                }
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