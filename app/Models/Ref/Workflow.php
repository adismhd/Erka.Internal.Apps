<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $table = 'ref_workflows';

    protected $fillable = [
        'CodeId',
        'Deskripsi'
    ];

}
