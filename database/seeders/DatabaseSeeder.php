<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Author;
use App\Models\Perusahaan;
use App\Models\InstructionNote;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Alamat::where('id', $request->Id)->delete();
        
        //User::where('email', 'admin@test.com')->delete();
        User::get()->each->delete();
        User::factory()->create(['name' => 'Admin User', 'email' => 'admin@test.com', 'role' => 'superadmin', 'password' => 'admin' ]);
        
        Menu::get()->each->delete();
        Menu::create(['Nama' => 'Beranda', 'Deskripsi' => 'Beranda', 'Role' => 'superadmin', 'Order' => 1, 'Link' => '/HomeAdmin', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Glosarium', 'Deskripsi' => 'Glosarium', 'Role' => 'superadmin', 'Order' => 2, 'Link' => '/Glosarium', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Parameter', 'Deskripsi' => 'Parameter', 'Role' => 'superadmin', 'Order' => 10, 'Link' => '/Parameter', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);

        Author::get()->each->delete();
        Author::create(['Nama' => 'Kevin Kunta Adji', 'NoTelepon' => '085930170540', 'Jabatan' => 'Project Manager']);
        
    }
}
