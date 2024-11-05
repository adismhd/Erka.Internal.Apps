<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierLink extends Model
{
    use HasFactory;

    protected $table = 'tbl_supplier_link';

    protected $fillable = [
        'ItemGoodsId',
        'Supplier',
        'Alamat',
        'Pic',
        'NoTelepon',
        'Link',
        'Harga',
        'TotalHarga',
        'TotalHargaPpn',
        'Ppn',
        'Keterangan',
        'OngkosKirim',
        'Checked'
    ];
}
