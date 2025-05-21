@extends('layouts.app') 

@section('content')
<div class="relative text-white min-h-[90vh] md:min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
    <div class="absolute inset-0" style="background-color: rgba(15, 70, 150, 0.6); z-index: 0;"></div>

    <div class="relative z-10 container mx-auto px-4 py-8 md:py-0 h-full">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between max-w-6xl mx-auto h-full min-h-[60vh] md:min-h-screen">
            <!-- Text Section -->
            <div class="md:w-1/2 animate-fade-in-left gap-3 flex flex-col items-center md:items-start text-center md:text-left mt-1 md:mt-10">
                <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-bold text-shadow-lg">
                    Ikatan Alumni Informatika FT Untan
                </h1>
                <p class="text-lg text-shadow-lg">
                    Selamat datang kakak/abang alumni Imformatika FT Untan <br>
                    Silahkan isi form di bawah ini untuk bergabung
                    dengan ikatan alumni Informatika FT Untan.
                </p>
            </div>

            <!-- Logo Section -->
            <div class="md:w-1/2 flex justify-center md:justify-end animate-fade-in-right mb-1 md:mb-0">
                <img src="{{ asset('storage/LogoHMIFmidWhite.png') }}" alt="Logo HMIF"
                    class="w-2/3 md:w-full max-w-xs md:max-w-sm">
            </div>
        </div>
    </div>


    <div class="custom-shape-divider-bottom-1745286436">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<!-- Form Section -->
<div class="container mx-auto max-w-3xl px-4 sm:px-6 py-10 bg-white shadow-lg rounded-2xl border border-[#E8D7CC] my-10">
    <h2 class="text-2xl sm:text-3xl font-bold text-[#0C0221] mb-6 text-center">Form Pendaftaran Alumni</h2>

    @if(session('success'))
        <div id="successPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 px-4">
            <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full text-center animate-fade-in-top">
                <h3 class="text-lg sm:text-xl font-bold text-[#0C0221] mb-4 leading-relaxed">
                    Pendaftaran Berhasil!<br>
                    Terima kasih telah mendaftar sebagai alumni Informatika FT Untan.<br>
                    Data kakak/abang akan diverifikasi oleh admin.<br>
                    Silakan tunggu konfirmasi melalui email yang didaftarkan.
                </h3>
                <p class="text-gray-700 text-sm">{{ session('success') }}</p>
                <button onclick="closePopup()" class="mt-4 px-4 py-2 bg-[#0F4696] text-white rounded-md hover:bg-[#0c3a7a] transition">
                    Tutup
                </button>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-400 text-red-800">
            <strong>Oops! Ada beberapa masalah:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('alumni.store') }}" method="POST" class="space-y-5">
        @csrf

        @php
            $labelStyle = 'block text-sm font-semibold text-[#0C0221]';
            $inputStyle = 'mt-1 block w-full border border-[#E8D7CC] rounded-xl shadow-sm p-3 focus:ring-[#0F4696] focus:border-[#0F4696] bg-[#FAFAFA] text-[#1E1E1E] text-sm sm:text-base';
        @endphp

        <div>
            <label for="nama_lengkap" class="{{ $labelStyle }}">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="{{ $inputStyle }}" value="{{ old('nama_lengkap') }}" required>
        </div>

        <div>
            <label for="nim" class="{{ $labelStyle }}">NIM</label>
            <input type="text" name="nim" id="nim" class="{{ $inputStyle }}" value="{{ old('nim') }}" required>
        </div>

        <div>
            <label for="angkatan" class="{{ $labelStyle }}">Angkatan</label>
            <input type="number" name="angkatan" id="angkatan" class="{{ $inputStyle }}" value="{{ old('angkatan') }}" required>
        </div>

        <div>
            <label for="email" class="{{ $labelStyle }}">Email Aktif</label>
            <input type="email" name="email" id="email" class="{{ $inputStyle }}" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="no_hp" class="{{ $labelStyle }}">No. HP / WhatsApp</label>
            <input type="text" name="no_hp" id="no_hp" class="{{ $inputStyle }}" value="{{ old('no_hp') }}" required>
        </div>

        <div>
            <label for="pekerjaan" class="{{ $labelStyle }}">Pekerjaan <span class="text-gray-400">(Opsional)</span></label>
            <input type="text" name="pekerjaan" id="pekerjaan" class="{{ $inputStyle }}" value="{{ old('pekerjaan') }}">
        </div>

        <div>
            <label for="instansi" class="{{ $labelStyle }}">Instansi / Tempat Kerja <span class="text-gray-400">(Opsional)</span></label>
            <input type="text" name="instansi" id="instansi" class="{{ $inputStyle }}" value="{{ old('instansi') }}">
        </div>

        <div>
            <label for="alamat_domisili" class="{{ $labelStyle }}">Alamat Domisili <span class="text-gray-400">(Opsional)</span></label>
            <textarea name="alamat_domisili" id="alamat_domisili" rows="3" class="{{ $inputStyle }}">{{ old('alamat_domisili') }}</textarea>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-[#0F4696] text-white font-semibold py-3 px-4 rounded-xl hover:bg-[#0c3a7a] transition duration-300 text-sm sm:text-base">
                Daftar
            </button>
        </div>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Restore scroll position if available in sessionStorage
    const scrollY = sessionStorage.getItem('scrollPosition');
    if (scrollY !== null) {
        window.scrollTo(0, parseInt(scrollY));
        sessionStorage.removeItem('scrollPosition');
    }

    // Saat submit form, simpan posisi scroll
    const form = document.querySelector('form[action="{{ route('alumni.store') }}"]');
    if (form) {
        form.addEventListener('submit', function () {
        sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    }
    });
</script>
@endsection
