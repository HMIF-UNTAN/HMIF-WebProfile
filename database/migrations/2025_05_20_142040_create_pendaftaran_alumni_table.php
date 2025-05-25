<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Migration (Laravel-style)
    Schema::create('alumni', function (Blueprint $table) {
        $table->id();
        // A. Data Pribadi
        $table->string('nama_lengkap');
        $table->string('nama_panggilan')->nullable();
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->string('no_hp');
        $table->string('email');
        $table->string('website_pribadi')->nullable();
        $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak']);

        // B. Data Akademik
        $table->string('nim')->unique();
        $table->year('angkatan');
        $table->string('judul_tugas_akhir')->nullable();

        // C. Pekerjaan
        $table->string('pekerjaan')->nullable();
        $table->string('nama_perusahaan')->nullable();
        $table->string('website_perusahaan')->nullable();

        // D. Lain-lain
        $table->string('facebook')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('instagram')->nullable();
        $table->string('twitter')->nullable();
        $table->text('minat_motto')->nullable();
        $table->string('foto')->nullable();

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
