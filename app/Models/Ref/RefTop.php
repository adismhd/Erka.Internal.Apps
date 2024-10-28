<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefTop extends Model
{
    use HasFactory;

    protected $table = 'ref_term_of_payment';

    protected $fillable = [
        'CodeId',
        'Deskripsi'
    ];
}
