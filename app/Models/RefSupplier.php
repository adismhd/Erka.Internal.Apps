<?php

namespace App\Models;

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
