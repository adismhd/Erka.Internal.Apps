<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glosarium extends Model
{
    use HasFactory;

    protected $table = 'tbl_glosariums';

    protected $fillable = [
        'Code',
        'Perusahaan',
        'Pic',
        'NoTelepon'
    ];

}
