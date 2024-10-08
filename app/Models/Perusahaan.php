<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_perusahaans';

    protected $fillable = [
        'Nama',
        'Code',
        'Logo',
        'Deskripsi',
        'Alamat'
    ];
        
    public function instructionNotes()
    {
        return $this->hasMany(InstructionNote::class, 'PerusahaanId', 'Code');
    }
}

