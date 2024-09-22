<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionNote extends Model
{
    use HasFactory;

    protected $table = 'tbl_intsruction_notes';

    protected $fillable = [
        'PerusahaanId',
        'Deskripsi'
    ];
}
