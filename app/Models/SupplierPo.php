<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ref\RefTop;

class SupplierPo extends Model
{
    use HasFactory;

    protected $table = 'tbl_supplier_po';

    protected $fillable = [
        'ItemGoodsId',
        'Supplier',
        'Pic',
        'NoTelepon',
        'Email',
        'Ppn',
        'TermOfPayment',
        'OngkosKirim',
        'Harga',
        'TotalHarga',
        'Keterangan',
        'Checked'
    ];
    
    public function Top()
    {
        return $this->hasone(RefTop::class, 'CodeId', 'TermOfPayment');
    }
}
