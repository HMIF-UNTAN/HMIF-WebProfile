<nav id="mainNavbar" class="fixed top-0 w-full z-50 transition-all duration-300 bg-transparent text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">

    <a href="{{ route('home') }}" class="flex items-center space-x-3 transition-colors duration-300 font-semibold text-white scroll-text">
      <img src="{{ asset('storage/LogoHMIF.png') }}" alt="Logo" class="w-10 h-10 rounded-full border border-white" />
      <span class="hidden sm:inline">HIMPUNAN MAHASISWA <br> INFORMATIKA FT UNTAN</span>
    </a>

    <div class="lg:hidden">
      <button id="menuToggle" class="text-white focus:outline-none scroll-text">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <div id="navbarNav" class="hidden lg:flex space-x-6 font-medium">
      <a href="{{ route('home') }}" class="text-white scroll-text hover:text-blue-300 transition">Home</a>
      <a href="{{ route('pengurus.index') }}" class="text-white scroll-text hover:text-blue-300 transition">Pengurus</a>
      <a href="#galeri" class="text-white scroll-text hover:text-blue-300 transition">Galeri</a>
      <a href="#artikel" class="text-white scroll-text hover:text-blue-300 transition">Artikel</a>
      <a href="#kontak" class="text-white scroll-text hover:text-blue-300 transition">Ikatan Alumni</a>
    </div>
  </div>

  <div id="mobileMenu" class="lg:hidden hidden bg-black bg-opacity-90 text-white px-4 py-4">
    <a href="#home" class="block py-2">Home</a>
    <a href="#tentang" class="block py-2">Tentang Kami</a>
    <a href="#galeri" class="block py-2">Galeri</a>
    <a href="#artikel" class="block py-2">Artikel</a>
    <a href="#kontak" class="block py-2">Kontak</a>
  </div>
</nav>
