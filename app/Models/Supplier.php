<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'tbl_supplier';

    protected $fillable = [
        'Regno',
        'SupplierCode'
    ];

    public function KetSupplier()
    {
        return $this->hasOne(RefSupplier::class, 'CodeId', 'SupplierCode');
    }
}
