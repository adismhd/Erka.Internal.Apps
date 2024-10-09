<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    use HasFactory;

    protected $table = 'tbl_rfq';

    protected $fillable = [
        'Regno',
        'PerusahaanId'
    ];
}
