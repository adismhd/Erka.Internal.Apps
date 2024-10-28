<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSupplier extends Model
{
    use HasFactory;

    protected $table = 'ref_supplier';

    protected $fillable = [
        'CodeId',
        'Deskripsi'
    ];
}
