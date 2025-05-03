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
        Schema::table('tentang_kamis', function (Blueprint $table) {
            $table->enum('tipe_informasi', ['Umum', 'Divisi'])->default('Umum')->after('konten');
        });
    }

    public function down()
    {
        Schema::table('tentang_kamis', function (Blueprint $table) {
            $table->dropColumn('tipe_informasi');
        });
    }
};
