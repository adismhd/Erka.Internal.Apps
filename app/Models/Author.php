<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'tbl_authors';

    protected $fillable = [
        'Nama',
        'NoTelepon',
        'Jabatan'
    ];
}
