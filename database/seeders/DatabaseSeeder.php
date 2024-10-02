<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Author;
use App\Models\Perusahaan;
use App\Models\InstructionNote;
use App\Models\Workflow;

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
        Menu::create(['Nama' => 'DG', 'Deskripsi' => 'Document Goods', 'Role' => 'superadmin', 'Order' => 3, 'Link' => '/DocumentGoods', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'RFQ', 'Deskripsi' => 'Request For Quotation', 'Role' => 'superadmin', 'Order' => 4, 'Link' => '/RFQ', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Parameter', 'Deskripsi' => 'Parameter', 'Role' => 'superadmin', 'Order' => 10, 'Link' => '/Parameter', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);

        Author::get()->each->delete();
        Author::create(['Nama' => 'Kevin Kunta Adji', 'NoTelepon' => '085930170540', 'Jabatan' => 'Project Manager']);
        
        Perusahaan::get()->each->delete();
        Perusahaan::create(['Nama' => 'PT. RIA KUSUMAH BERSAMA', 'Code' => 'RKB-PAK-',  'Deskripsi' => 'Telekomunikasi-IT Support Solution ', 'Alamat' => 'Jl. Saturnus Utara V No.1, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286']);
        
        InstructionNote::get()->each->delete();
        InstructionNote::create(['PerusahaanId' => 'RKB-PAK-', 'Deskripsi' => 'The goods that are informed must meet the requested specifications, if conditions occur that allow the goods not to meet the specifications, then please provide a replacement item along with the reason']);
        InstructionNote::create(['PerusahaanId' => 'RKB-PAK-', 'Deskripsi' => 'The price listed is the price with VAT 11%']);
        
        Workflow::get()->each->delete();
        Workflow::create(['CodeId' => 'ST', 'Deskripsi' => 'Start']);
        Workflow::create(['CodeId' => 'DG', 'Deskripsi' => 'Document Goods']);
        Workflow::create(['CodeId' => 'RFQ', 'Deskripsi' => 'Request For Quotation']);
        Workflow::create(['CodeId' => 'SW', 'Deskripsi' => 'Supplier With']);
        Workflow::create(['CodeId' => 'PL', 'Deskripsi' => 'Plan']);
        Workflow::create(['CodeId' => 'OL', 'Deskripsi' => 'Offering Letter']);
        Workflow::create(['CodeId' => 'PO', 'Deskripsi' => 'Purchase Order']);
        Workflow::create(['CodeId' => 'PL', 'Deskripsi' => 'Packing List']);
        Workflow::create(['CodeId' => 'DO', 'Deskripsi' => 'Delivery Order']);
        Workflow::create(['CodeId' => 'IN', 'Deskripsi' => 'Invoice']);
        Workflow::create(['CodeId' => 'FN', 'Deskripsi' => 'Final']);
    }
}
