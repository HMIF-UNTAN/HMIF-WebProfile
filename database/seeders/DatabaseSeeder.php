<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        DB::table('users')->insert([
            [
                'name' => 'Admin HMIF',
                'email' => 'hmiif@contoh.com',
                'password' => 'passwordhmif',
                'uuid' => 'e8af43f2-046d-41e8-b1e5-916c412fbee5',
                'created_at' => '2025-04-05 10:41:35',
                'updated_at' => '2025-04-05 10:41:35',
            ],
        ]);

        $this->call(ArtikelSeeder::class);
    }
}
