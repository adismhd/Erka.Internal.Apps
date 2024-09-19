<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;

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
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'role' => 'superadmin',
            'password' => 'admin'
        ]);
        
        Menu::create([
            'Nama' => 'Beranda',
            'Deskripsi' => 'Beranda',
            'Role' => 'superadmin',
            'Order' => 1,
            'Link' => '/HomeAdmin',
            'Icon' => 'fa-solid fa-house',
            'Module' => '1',
            'ParentId' => null,
            'IsActive' => '1',
        ]);
        
        Menu::create([
            'Nama' => 'Glosarium',
            'Deskripsi' => 'Glosarium',
            'Role' => 'superadmin',
            'Order' => 2,
            'Link' => '/HomeAdmin',
            'Icon' => 'fa-solid fa-table-list',
            'Module' => '1',
            'ParentId' => null,
            'IsActive' => '1',
        ]);
    }
}
