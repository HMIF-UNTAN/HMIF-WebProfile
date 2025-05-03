<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('no_hp');
        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->string('no_hp')->nullable(); // atau atur sesuai definisi aslinya
        });
    }
};
