<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->dropColumn(['nama', 'tipe', 'isi']); // hanya jika yakin tidak dipakai
            $table->text('alamat')->nullable();
            $table->string('narahubung_nama')->nullable();
            $table->string('narahubung_kontak')->nullable();
            $table->string('email')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontaks', function (Blueprint $table) {
            //
        });
    }
};
