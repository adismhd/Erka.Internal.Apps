<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGood extends Model
{
    use HasFactory;

    protected $table = 'tbl_item_goods';

    protected $fillable = [
        'Regno',
        'Nama',
        'Spesifikasi',
        'Qty',
        'Satuan',
        'Keterangan'
    ];

    public function SupplierLink()
    {
        return $this->hasmany(SupplierLink::class, 'ItemGoodsId', 'id');
    }
    
    public function SupplierPo()
    {
        return $this->hasmany(SupplierPo::class, 'ItemGoodsId', 'id');
    }
}
