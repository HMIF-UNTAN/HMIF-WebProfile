<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->year('angkatan');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('pekerjaan')->nullable();
            $table->string('instansi')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->boolean('status_verifikasi')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
