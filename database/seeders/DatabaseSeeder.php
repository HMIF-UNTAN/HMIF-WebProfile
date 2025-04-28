<?php

namespace Database\Seeders;

use App\Models\Role as ModelsRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Database\Seeders\TentangKamiSeeder;
use Database\Seeders\GaleriSeeder;
use Database\Seeders\ArtikelSeeder;
use Database\Seeders\DivisiSeeder;
use Database\Seeders\PengurusSeeder;
use Database\Seeders\KontakSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset cache permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create permissions
        $permissions = [
            'manage_users',
            'manage_articles',
            'manage_galleries',
            'manage_settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        // 4. Assign permissions
        $superAdminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo(['manage_articles', 'manage_galleries']);

        // 5. Pertahankan akun HMIF yang sudah ada (update jika perlu)
        $hmifUser = User::updateOrCreate(
            ['email' => 'hmif@contoh.com'],
            [
                'name' => 'Admin HMIF',
                'password' => Hash::make('passwordhmif'), // Di-hash ulang
                'uuid' => Str::uuid(),
                'updated_at' => now()
            ]
        );
        $hmifUser->syncRoles('admin'); // Beri role admin

        // 6. Buat SUPER ADMIN BARU (akun terpisah)
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@contoh.com',
            'password' => Hash::make('superadminhmif'),
            'uuid' => Str::uuid(),
        ]);
        $superAdmin->syncRoles('superadmin');

        // 7. Seed lainnya
        $this->call([
            ArtikelSeeder::class,
            GaleriSeeder::class,
            DivisiSeeder::class,
            TentangKamiSeeder::class,
            PengurusSeeder::class,
            KontakSeeder::class,
        ]);
    }
}