<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    use HasFactory;

    protected $table = 'tbl_item_plan';

    protected $fillable = [
        'Regno',
        'ItemGoodsId',
        'SupplierCode',
        'SupplierId',
        'Harga',
        'TotalHarga',
        'Profit',
        'TotalProfit',
        'Discount',
        'HargaDiscount',
        'TotalHargaDiscount',
        'OngkosKirim',
        'Ppn',
        'Qty',
        'CustomCaseVat',
        'Vat',
        'TotalVatItem'
    ];
    
    public function IG()
    {
        return $this->hasone(ItemGood::class, 'id', 'ItemGoodsId');
    }
}
