<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Author;
use App\Models\Perusahaan;
use App\Models\InstructionNote;
use App\Models\Workflow;
use App\Models\RefSupplier;

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
        Menu::create(['Nama' => 'Supplier', 'Deskripsi' => 'Supplier', 'Role' => 'superadmin', 'Order' => 5, 'Link' => '/Supplier', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Parameter', 'Deskripsi' => 'Parameter', 'Role' => 'superadmin', 'Order' => 10, 'Link' => '/Parameter', 'Icon' => 'fa-solid fa-house', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);

        Author::get()->each->delete();
        Author::create(['Nama' => 'Kevin Kunta Adji', 'NoTelepon' => '085930170540', 'Jabatan' => 'Project Manager']);
        
        Perusahaan::get()->each->delete();
        Perusahaan::create(['Nama' => 'PT. RIA KUSUMAH BERSAMA', 'Code' => 'RKB-PAK-',  'Deskripsi' => 'Telekomunikasi-IT Support Solution ', 'Alamat' => 'Jl. Saturnus Utara V No.1, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286']);
        Perusahaan::create(['Nama' => 'PT. REKAN KREATIF SOLUSINDO', 'Code' => 'RKS-HAK-',  'Deskripsi' => 'Telekomunikasi ', 'Alamat' => 'Ruko Bukit Gading Mediterania Blok A/01, Kel. Kelapa Gading Barat, Kec. Kelapa Gading, Kota Adm. Jakarta Utara, Prov. DKI Jakarta, 14240']);
        Perusahaan::create(['Nama' => 'PT. GAMA SUKMA BERSAMA', 'Code' => 'GSB-GPK-',  'Deskripsi' => 'DIGITAL PRINTING & ATK', 'Alamat' => 'Jl. Cemara B No.1, Rancabolang, Kec. Gedebage, Kota Bandung, Jawa Barat 40295']);
        
        InstructionNote::get()->each->delete();
        InstructionNote::create(['PerusahaanId' => 'RKB-PAK-', 'Deskripsi' => 'The goods that are informed must meet the requested specifications, if conditions occur that allow the goods not to meet the specifications, then please provide a replacement item along with the reason']);
        InstructionNote::create(['PerusahaanId' => 'RKB-PAK-', 'Deskripsi' => 'The price listed is the price with VAT 11%']);
        InstructionNote::create(['PerusahaanId' => 'RKB-PAK-', 'Deskripsi' => 'If there is a shipping fee, it will be listed on the Offering Letter submission']);
        InstructionNote::create(['PerusahaanId' => 'RKB-PAK-', 'Deskripsi' => 'The offering letter is accompanied by a product image, specifications and warranty status of the product']);
        
        InstructionNote::create(['PerusahaanId' => 'RKS-HAK-', 'Deskripsi' => 'The goods that are informed must meet the requested specifications, if conditions occur that allow the goods not to meet the specifications, then please provide a replacement item along with the reason']);
        InstructionNote::create(['PerusahaanId' => 'RKS-HAK-', 'Deskripsi' => 'The price listed is the price with VAT 11%']);
        InstructionNote::create(['PerusahaanId' => 'RKS-HAK-', 'Deskripsi' => 'If there is a shipping fee, it will be listed on the Offering Letter submission']);
        InstructionNote::create(['PerusahaanId' => 'RKS-HAK-', 'Deskripsi' => 'The offering letter is accompanied by a product image, specifications and warranty status of the product']);
        
        InstructionNote::create(['PerusahaanId' => 'GSB-GPK-', 'Deskripsi' => 'The goods that are informed must meet the requested specifications, if conditions occur that allow the goods not to meet the specifications, then please provide a replacement item along with the reason']);
        InstructionNote::create(['PerusahaanId' => 'GSB-GPK-', 'Deskripsi' => 'The price listed is the price with VAT 11%']);
        InstructionNote::create(['PerusahaanId' => 'GSB-GPK-', 'Deskripsi' => 'If there is a shipping fee, it will be listed on the Offering Letter submission']);
        InstructionNote::create(['PerusahaanId' => 'GSB-GPK-', 'Deskripsi' => 'The offering letter is accompanied by a product image, specifications and warranty status of the product']);

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

        RefSupplier::get()->each->delete();
        RefSupplier::create(['CodeId' => '101', 'Deskripsi' => 'Supplier PO']);
        RefSupplier::create(['CodeId' => '102', 'Deskripsi' => 'Supplier With Link']);
    }
}
