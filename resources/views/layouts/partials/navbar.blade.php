<nav id="mainNavbar" class="fixed top-0 w-full z-50 transition-all duration-300 bg-transparent text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">

    <a href="{{ route('home') }}" class="flex items-center space-x-3 transition-colors duration-300 font-semibold text-white scroll-text">
      <img src="{{ asset('storage/LogoHMIF.png') }}" alt="Logo" class="w-10 h-10 rounded-full border border-white" />
      <span class="hidden sm:inline">HIMPUNAN MAHASISWA <br> INFORMATIKA FT UNTAN</span>
    </a>

    <!-- Toggle Button for Mobile -->
    <div class="lg:hidden">
      <button id="menuToggle" class="text-white focus:outline-none scroll-text">
        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <!-- Desktop Menu -->
    <div id="navbarNav" class="hidden lg:flex space-x-6 font-medium">
      <a href="{{ route('home') }}" class="text-white scroll-text hover:text-blue-300 transition {{ request()->routeIs('home') ? 'font-bold' : '' }}">Beranda</a>
      <a href="{{ route('pengurus.index') }}" class="text-white scroll-text hover:text-blue-300 transition {{ Route::is('pengurus.index') ? 'font-bold' : '' }}">Pengurus</a>
      <a href="{{ route('galeri.index') }}" class="text-white scroll-text hover:text-blue-300 transition {{ Request::is('galeri*') ? 'font-bold' : '' }}">Galeri</a>
      <a href="{{ route('artikel.index') }}" class="text-white scroll-text hover:text-blue-300 transition {{ Request::is('artikel*') ? 'font-bold' : '' }}">Artikel</a>
      <a href="{{ route('alumni.index') }}" class="text-white scroll-text hover:text-blue-300 transition {{ Request::is('alumni*') ? 'font-bold' : '' }}">Ikatan Alumni</a>
    </div>
  </div>

  <!-- Mobile Menu (dropdown with transition) -->
  <div id="mobileMenu" class="lg:hidden max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-[#E0EDFF] bg-opacity-90 text-[#0F4696] px-4 py-0">
    <a href="{{ route('home') }}" class="block py-2">Home</a>
    <a href="{{ route('pengurus.index') }}" class="block py-2">Pengurus</a>
    <a href="{{ route('galeri.index') }}" class="block py-2">Galeri</a>
    <a href="{{ route('artikel.index') }}" class="block py-2">Artikel</a>
    <a href="{{ route('alumni.index') }}" class="block py-2">Ikatan Alumni</a>
  </div>
</nav>