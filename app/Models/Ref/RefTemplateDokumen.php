<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefTemplateDokumen extends Model
{
    use HasFactory;

    protected $table = 'ref_template_dokumen';

    protected $fillable = [
        'DokumenCode',
        'KeyId',
        'Html'
    ];

}
