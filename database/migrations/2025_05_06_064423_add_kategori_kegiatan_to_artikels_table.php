<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->string('kategori_kegiatan')->nullable()->after('judul'); // atau letakkan setelah kolom lain
        });
    }

    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn('kategori_kegiatan');
        });
    }

};
