<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $table = 'tbl_aplikasis';

    protected $fillable = [
        'Regno',
        'CustomerId',
        'AuthorId'
    ];
}
