<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'ref_menus';
    
    protected $fillable = [
        'Nama',
        'Deskripsi',
        'Role',
        'Order',
        'Link',
        'Icon',
        'Module',
        'ParentId',
        'IsActive'
    ];

}
