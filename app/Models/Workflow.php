<?php

namespace App\Models;

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
