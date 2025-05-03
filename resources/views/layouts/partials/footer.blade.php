<footer class="text-white py-10 bg-[#0F4696] bg-cover bg-center relative" style="background-image: url('{{ asset('storage/Background-Footer.jpg') }}'); background-color: rgba(0, 123, 255, 0.6);">
  <div class="absolute inset-0 bg-[#0F4696]/80"></div> <!-- Dark overlay -->
  
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-6 md:space-y-0">
      
      <!-- Kolom Kiri: Info HMIF -->
      <div class="md:w-2/3">
        <div class="flex items-center mb-4">
          <img src="{{ asset('storage/LogoHMIF.png') }}" alt="Logo HMIF" class="w-12 h-12 rounded-full border border-white mr-3">
          <h5 class="text-white font-semibold">HMIF FT UNTAN</h5>
        </div>
        <p class="flex items-start md:items-center mb-2">
          <i class="bi bi-geo-alt-fill mr-2 mt-1"></i>
          {{ $kontak->alamat ?? "Alamat Belum Di isi" }}
        </p>
        <p class="flex items-start md:items-center mb-2">
          <i class="bi bi-envelope-fill mr-2 mt-1"></i>
          <a href="mailto:hmif@informatika.untan.ac.id" class="hover:underline">{{ $kontak->email }}</a>
        </p>
        <p class="flex items-start md:items-center">
          <i class="bi bi-telephone-fill mr-2 mt-1"></i>
          {{ $kontak->narahubung_kontak }} ({{ $kontak->narahubung_nama }})
        </p>

        <div class="flex mt-4 space-x-4 text-xl">
          <a href="https://www.linkedin.com/company/hmif-ft-untan/" target="_blank" rel="noopener noreferrer" class="hover:text-blue-400">
            <i class="bi bi-linkedin"></i>
          </a>
          <a href="https://www.instagram.com/hmif_ftuntan?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="hover:text-blue-400">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>

      <!-- Kolom Kanan: Maps -->
      <div class="md:w-1/3 flex justify-center md:justify-end">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7979.632872861722!2d109.348547!3d-0.055679000000000006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d5994281990c5%3A0x4173a0daccd110e!2sLaboratorium%20Informatika%20Universitas%20Tanjungpura!5e0!3m2!1sen!2sid!4v1745298064454!5m2!1sen!2sid"
          width="250"
          height="180"
          style="border:0; border-radius:8px;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

    <hr class="border-white my-6">

    <p class="text-center text-sm relative z-10">&copy; HMIF {{ date('Y') }}. All rights reserved.</p>
  </div>
</footer>
