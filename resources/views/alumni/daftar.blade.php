@extends('layouts.app')

@section('content')
<div class="relative text-white min-h-[90vh] md:min-h-screen bg-cover bg-center mb-20" style="background-image: url('{{ asset('storage/mainBG.JPG') }}');">
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
<div class="container mx-auto max-w-3xl px-6 py-12 bg-white shadow-xl rounded-3xl border border-[#E8D7CC] mt-[-3rem] z-20 relative">
    <h2 class="text-3xl font-bold text-[#0C0221] mb-8 text-center">Form Pendaftaran Alumni</h2>

    @if(session('success'))
        <div id="successPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 px-4">
            <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full text-center animate-fade-in-top">
                <h3 class="text-lg sm:text-xl font-bold text-[#0C0221] mb-4">Pendaftaran Berhasil!</h3>
                <p class="text-gray-700 text-sm leading-relaxed">Data Anda akan diverifikasi oleh admin. Silakan tunggu konfirmasi melalui email.</p>
                <button onclick="closePopup()" class="mt-4 px-4 py-2 bg-[#0F4696] text-white rounded-md hover:bg-[#0c3a7a] transition">Tutup</button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-400 text-red-800">
            <strong>Oops! Ada beberapa masalah:</strong>
            <ul class="mt-2 list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $label = 'block text-sm font-semibold text-[#0C0221]';
        $input = 'mt-1 block w-full border border-[#E8D7CC] rounded-xl p-3 shadow-sm bg-[#FAFAFA] focus:ring-[#0F4696] focus:border-[#0F4696] text-sm sm:text-base text-[#1E1E1E]';
    @endphp

    <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <h3 class="text-lg font-bold text-[#0C0221] mt-8">A. Data Pribadi</h3>

        <div>
            <label class="{{ $label }}">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="{{ $input }}" value="{{ old('nama_lengkap') }}" required>
        </div>

        <div>
            <label class="{{ $label }}">Nama Panggilan</label>
            <input type="text" name="nama_panggilan" class="{{ $input }}" value="{{ old('nama_panggilan') }}">
        </div>

        <div>
            <label class="{{ $label }}">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="{{ $input }}" required>
                <option value="" disabled selected>Pilih jenis kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div>
            <label class="{{ $label }}">No. HP</label>
            <input type="text" name="no_hp" class="{{ $input }}" value="{{ old('no_hp') }}" required>
        </div>

        <div>
            <label class="{{ $label }}">Email</label>
            <input type="email" name="email" class="{{ $input }}" value="{{ old('email') }}" required>
        </div>

        <div>
            <label class="{{ $label }}">Website Pribadi</label>
            <input type="url" name="website_pribadi" class="{{ $input }}" value="{{ old('website_pribadi') }}">
        </div>

        <h3 class="text-lg font-bold text-[#0C0221] mt-10">B. Data Akademik</h3>

        <div>
            <label class="{{ $label }}">NIM</label>
            <input type="text" name="nim" class="{{ $input }}" value="{{ old('nim') }}" required>
        </div>

        <div>
            <label class="{{ $label }}">Angkatan</label>
            <input type="number" name="angkatan" class="{{ $input }}" value="{{ old('angkatan') }}" required>
        </div>

        <div>
            <label class="{{ $label }}">Judul Tugas Akhir</label>
            <input type="text" name="judul_tugas_akhir" class="{{ $input }}" value="{{ old('judul_tugas_akhir') }}">
        </div>

        <h3 class="text-lg font-bold text-[#0C0221] mt-10">C. Pekerjaan</h3>

        <div>
            <label class="{{ $label }}">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="{{ $input }}" value="{{ old('pekerjaan') }}">
        </div>

        <div>
            <label class="{{ $label }}">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="{{ $input }}" value="{{ old('nama_perusahaan') }}">
        </div>

        <div>
            <label class="{{ $label }}">Website Perusahaan</label>
            <input type="url" name="website_perusahaan" class="{{ $input }}" value="{{ old('website_perusahaan') }}">
        </div>

        <h3 class="text-lg font-bold text-[#0C0221] mt-10">D. Lain-lain</h3>

        <div>
            <label class="{{ $label }}">Facebook</label>
            <input type="url" name="facebook" class="{{ $input }}" value="{{ old('facebook') }}">
        </div>

        <div>
            <label class="{{ $label }}">LinkedIn</label>
            <input type="url" name="linkedin" class="{{ $input }}" value="{{ old('linkedin') }}">
        </div>

        <div>
            <label class="{{ $label }}">Instagram</label>
            <input type="url" name="instagram" class="{{ $input }}" value="{{ old('instagram') }}">
        </div>

        <div>
            <label class="{{ $label }}">Twitter</label>
            <input type="url" name="twitter" class="{{ $input }}" value="{{ old('twitter') }}">
        </div>

        <div>
            <label class="{{ $label }}">Minat / Motto</label>
            <textarea name="minat_motto" rows="3" class="{{ $input }}">{{ old('minat_motto') }}</textarea>
        </div>

        <div>
            <label class="{{ $label }}">Upload Foto</label>
            <input type="file" name="foto" class="{{ $input }}">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-[#0F4696] text-white font-semibold py-3 px-4 rounded-xl hover:bg-[#0c3a7a] transition duration-300 text-sm sm:text-base">
                Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const scrollY = sessionStorage.getItem('scrollPosition');
        if (scrollY !== null) {
            window.scrollTo(0, parseInt(scrollY));
            sessionStorage.removeItem('scrollPosition');
        }

        const form = document.querySelector('form[action="{{ route('alumni.store') }}"]');
        if (form) {
            form.addEventListener('submit', function () {
                sessionStorage.setItem('scrollPosition', window.scrollY);
            });
        }
    });

    function closePopup() {
        const popup = document.getElementById('successPopup');
        if (popup) popup.remove();
    }
</script>
@endsection
