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
        Schema::table('pengurus', function (Blueprint $table) {
            $table->enum('jenis_jabatan', ['Inti', 'Anggota'])->default('Anggota');
        });
    }

    public function down()
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('jenis_jabatan');
        });
    }
};
