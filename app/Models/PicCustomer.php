<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicCustomer extends Model
{
    use HasFactory;

    protected $table = 'tbl_pic_customers';

    protected $fillable = [
        'CodeId',
        'Nama',
        'NoTelepon'
    ];
}
