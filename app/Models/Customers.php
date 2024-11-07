<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'tbl_customers';

    protected $fillable = [
        'Code',
        'Perusahaan'
    ];

}
