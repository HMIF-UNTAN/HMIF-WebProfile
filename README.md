
# 🌐 Web Profile HMIF FT UNTAN

Website profil resmi **HMIF FT UNTAN** yang mencakup fitur galeri kegiatan (terintegrasi dengan Google Drive API), artikel kegiatan, daftar pengurus HMIF, dan informasi alumni IKA.

---

## ✨ Fitur Utama

- 🏠 **Beranda** — Tampilan halaman utama informasi HMIF
- 🖼️ **Galeri Kegiatan** — Terintegrasi langsung dengan Google Drive API
- 📝 **Artikel Kegiatan** — Dokumentasi artikel kegiatan dan berita terbaru
- 🧑‍💼 **Kepengurusan** — Informasi struktur dan daftar pengurus HMIF
- 🎓 **IKA Alumni** — Informasi alumni HMIF dari berbagai angkatan

---

## ⚙️ Teknologi yang Digunakan

| Komponen     | Teknologi                                          |
|--------------|-----------------------------------------------------|
| Backend      | Laravel 8.3, PHP                                    |
| Frontend     | Blade, Tailwind CSS, SwiperCSS, Swiper.js, **Vite** |
| API          | Google Drive API                                   |
| Database     | MySQL                                              |
| Deployment   | Docker                                              |

---

## 🚀 Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

### 1. Clone Repositori
```bash
git clone [REPO_URL]
cd [FOLDER_PROJECT]
```

### 2. Install Dependency PHP
```bash
composer install
```

### 3. Install Dependency Frontend (Vite)
```bash
npm install
```

### 4. Salin File .env dan Atur Konfigurasi Database
```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hmif_profile
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate App Key Laravel
```bash
php artisan key:generate
```

### 6. Migrasi dan Seeder Database
```bash
php artisan migrate --seed
composer dump-autoload
```

### 7. Jalankan Server Backend dan Frontend
#### Jalankan Laravel Backend:
```bash
php artisan serve
```

#### Jalankan Vite Dev Server:
```bash
npm run dev
```

Akses website di: [http://localhost:8000](http://localhost:8000)

---

## 🙌 Kontribusi

Proyek ini merupakan bagian dari sistem informasi internal HMIF FT UNTAN dan terus dikembangkan untuk mendukung kebutuhan dokumentasi dan organisasi.
