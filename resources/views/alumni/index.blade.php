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
                    Alumni Informatika FT Untan
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
        <svg class="w-full h-20 md:h-28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<div class="container mx-auto max-w-6xl p-6 my-10 bg-white shadow-lg rounded-2xl border border-[#E8D7CC]">
    <h2 class="text-3xl font-bold text-[#0C0221] mb-6 text-center">Daftar Alumni Informatika</h2>

    <!-- Tombol Tab Angkatan -->
    <div class="flex flex-wrap justify-center gap-3">
        @foreach ($angkatans as $index => $angkatan)
            <button
                class="angkatan-tab px-4 py-2 rounded-xl border border-[#0F4696] text-[#0F4696] font-semibold transition 
                    {{ $index === 0 ? 'bg-[#0F4696] text-white' : 'bg-white hover:bg-[#0F4696] hover:text-white' }}"
                onclick="showTab('{{ $angkatan }}', this)"
            >
                {{ $angkatan }}
            </button>
        @endforeach
    </div>

    <!-- Tab Konten Tabel Alumni -->
    @foreach ($alumniByAngkatan as $angkatan => $alumnis)
        <div id="tab-{{ $angkatan }}" class="tab-content mt-6 overflow-x-auto {{ $loop->first ? '' : 'hidden' }}">
            <table class="min-w-full text-sm text-left border border-[#E8D7CC] rounded-xl overflow-hidden">
                <thead class="bg-[#0F4696] text-white">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Lengkap</th>
                        <th class="px-4 py-3">NIM</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">No HP</th>
                        <th class="px-4 py-3">Pekerjaan</th>
                        <th class="px-4 py-3">Instansi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-[#1E1E1E] divide-y divide-[#E8D7CC]">
                    @foreach ($alumnis as $index => $alumni)
                        <tr>
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $alumni->nama_lengkap }}</td>
                            <td class="px-4 py-3">{{ $alumni->nim }}</td>
                            <td class="px-4 py-3">{{ $alumni->email }}</td>
                            <td class="px-4 py-3">{{ $alumni->no_hp }}</td>
                            <td class="px-4 py-3">{{ $alumni->pekerjaan ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $alumni->instansi ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
        <!-- Tombol Daftar Sebagai Alumni -->
    <div class="mt-10 flex justify-center">
        <a href="{{ route('alumni.daftar') }}" class="inline-flex items-center px-6 py-3 bg-[#0F4696] text-white font-semibold rounded-xl shadow-md hover:bg-[#0C3C82] transition duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
            </svg>
            Daftar Sebagai Alumni
        </a>
    </div>

</div>

<!-- Script untuk tab -->
<script>
    function showTab(angkatan, button) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        document.querySelector('#tab-' + angkatan).classList.remove('hidden');

        document.querySelectorAll('.angkatan-tab').forEach(btn => {
            btn.classList.remove('bg-[#0F4696]', 'text-white');
            btn.classList.add('bg-white', 'text-[#0F4696]');
        });

        button.classList.add('bg-[#0F4696]', 'text-white');
        button.classList.remove('bg-white', 'text-[#0F4696]');
    }
</script>
@endsection
