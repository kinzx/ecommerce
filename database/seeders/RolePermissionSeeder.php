<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache permission
        // Ini penting agar aplikasi tidak membaca cache permission yang lama
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Permission untuk Produk
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        // 2. Buat Permission untuk Kategori
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);

        // 3. Buat Role Admin & Berikan SEMUA Permission
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // 4. Buat Role User & Berikan Permission TERBATAS (Cuma bisa lihat)
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'view products',
            'view categories'
        ]);
    }
}
