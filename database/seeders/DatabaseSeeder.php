<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Perusahaan;
use App\Models\InstructionNote;
use App\Models\Ref\Workflow;
use App\Models\Ref\RefSupplier;
use App\Models\Ref\RefTop;
use App\Models\Ref\Menu;

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
        Menu::create(['Nama' => 'Glosarium', 'Deskripsi' => 'Glosarium', 'Role' => 'superadmin', 'Order' => 3, 'Link' => '/Glosarium', 'Icon' => 'fa-solid fa-rectangle-list', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'DG', 'Deskripsi' => 'Document Goods', 'Role' => 'superadmin', 'Order' => 4, 'Link' => '/DocumentGoods', 'Icon' => 'fa-solid fa-truck-ramp-box', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'RFQ', 'Deskripsi' => 'Request For Quotation', 'Role' => 'superadmin', 'Order' => 5, 'Link' => '/RFQ', 'Icon' => 'fa-solid fa-circle-plus', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Supplier', 'Deskripsi' => 'Supplier', 'Role' => 'superadmin', 'Order' => 6, 'Link' => '/Supplier', 'Icon' => 'fa-solid fa-box', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Plan', 'Deskripsi' => 'Plan', 'Role' => 'superadmin', 'Order' => 7, 'Link' => '/Plan', 'Icon' => 'fa-solid fa-chart-simple', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);
        Menu::create(['Nama' => 'Parameter', 'Deskripsi' => 'Parameter', 'Role' => 'superadmin', 'Order' => 2, 'Link' => '/Parameter', 'Icon' => 'fa-solid fa-list', 'Module' => '1', 'ParentId' => null,'IsActive' => '1']);

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

        RefTop::get()->each->delete();
        RefTop::create(['CodeId' => '101', 'Deskripsi' => '30 Days']);
        RefTop::create(['CodeId' => '102', 'Deskripsi' => 'Immediately']);
        RefTop::create(['CodeId' => '103', 'Deskripsi' => '60% DP']);
        RefTop::create(['CodeId' => '104', 'Deskripsi' => '25% DP, balance 75% After Receive Goods.']);
        RefTop::create(['CodeId' => '105', 'Deskripsi' => '50% DP, 50% before delivery']);
        RefTop::create(['CodeId' => '106', 'Deskripsi' => '20% DP']);
        RefTop::create(['CodeId' => '107', 'Deskripsi' => '25% DP,  75% Leasing']);
        RefTop::create(['CodeId' => '108', 'Deskripsi' => '40% DP, 60% Before Delivery']);
        RefTop::create(['CodeId' => '109', 'Deskripsi' => 'DP 30%, 40% Before delivery, 30% after installation']);
        RefTop::create(['CodeId' => '110', 'Deskripsi' => '30% DP, 70% after BAST']);
        RefTop::create(['CodeId' => '111', 'Deskripsi' => 'DP 30%, Pelunasan 3 Tahun']);
        RefTop::create(['CodeId' => '112', 'Deskripsi' => '15% DP, 85% after BAST']);
        RefTop::create(['CodeId' => '113', 'Deskripsi' => '40% after approval, 60% after Live']);
        RefTop::create(['CodeId' => '114', 'Deskripsi' => '50% DP, 50% max 7 days after BAST']);
        RefTop::create(['CodeId' => '115', 'Deskripsi' => '75% DP']);
        RefTop::create(['CodeId' => '116', 'Deskripsi' => '100% after BAST']);
        RefTop::create(['CodeId' => '117', 'Deskripsi' => '50% (DP 1), 30% (DP 2), dan 20% (Before Delivery)']);
        RefTop::create(['CodeId' => '118', 'Deskripsi' => '30% DP, Balance after invoice received']);
        RefTop::create(['CodeId' => '119', 'Deskripsi' => 'Works equivalent to 50% & 50% after BAST']);
        RefTop::create(['CodeId' => '120', 'Deskripsi' => '45 Days']);
        RefTop::create(['CodeId' => '121', 'Deskripsi' => '40% DP, 40% after work finished, 20% after report received']);
        RefTop::create(['CodeId' => '122', 'Deskripsi' => 'Works equivalent to 35%, 35% & 30% after BAST']);
        RefTop::create(['CodeId' => '123', 'Deskripsi' => '30% DP, 50% after fieldwork complete, 20% after approved']);
        RefTop::create(['CodeId' => '124', 'Deskripsi' => 'Refer to Contract']);
        RefTop::create(['CodeId' => '125', 'Deskripsi' => 'DP 30%, MOS 35%, After Testcom 30%, 5% 120 days after BAST 1']);
        RefTop::create(['CodeId' => '126', 'Deskripsi' => '50% DP, 35% after progress 80%, 10% after progress 100% & BAST 1, 5% Retensi 360 days after BAST 1']);
        RefTop::create(['CodeId' => '127', 'Deskripsi' => '50% DP, 50% max 14 days after BAST']);
        RefTop::create(['CodeId' => '128', 'Deskripsi' => '50% DP, 50% max 30 days after BAST']);
        RefTop::create(['CodeId' => '129', 'Deskripsi' => '20% DP, 80% LEASING']);
        RefTop::create(['CodeId' => '130', 'Deskripsi' => 'DP 30% + 25% Before Shipment + 25% After Receive + 20%']);
        RefTop::create(['CodeId' => '131', 'Deskripsi' => '70% Upon Authorization']);
        RefTop::create(['CodeId' => '132', 'Deskripsi' => '20% upon completion of experimental part']);
        RefTop::create(['CodeId' => '133', 'Deskripsi' => '10% upon issuance of report']);
        RefTop::create(['CodeId' => '134', 'Deskripsi' => '40% DP, 95% after progress 100% & BAST 1, 5% Retention 360 days after BAST1']);
        RefTop::create(['CodeId' => '135', 'Deskripsi' => '80% DP,  balance 20% after goods received']);
        RefTop::create(['CodeId' => '136', 'Deskripsi' => '25% DP, Balance after BAST']);
        RefTop::create(['CodeId' => '137', 'Deskripsi' => '7 Days']);
        RefTop::create(['CodeId' => '138', 'Deskripsi' => 'Cash before Delivery']);
        RefTop::create(['CodeId' => '139', 'Deskripsi' => '14 Days']);
        RefTop::create(['CodeId' => '140', 'Deskripsi' => '50% DP, Balance after goods receipt']);
        RefTop::create(['CodeId' => '141', 'Deskripsi' => '50% DP, Balance after invoice receipt']);
        RefTop::create(['CodeId' => '142', 'Deskripsi' => '50% DP']);
        RefTop::create(['CodeId' => '143', 'Deskripsi' => '21 Days']);
        RefTop::create(['CodeId' => '144', 'Deskripsi' => '30 Days']);
        RefTop::create(['CodeId' => '145', 'Deskripsi' => '2 Months']);
        RefTop::create(['CodeId' => '146', 'Deskripsi' => 'End of Following Month']);
        RefTop::create(['CodeId' => '147', 'Deskripsi' => '30% Now, Balance 60 Days']);
        RefTop::create(['CodeId' => '148', 'Deskripsi' => '15 Hari']);
        RefTop::create(['CodeId' => '149', 'Deskripsi' => '14 Days']);
    }
}
