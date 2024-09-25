<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowHistory extends Model
{
    use HasFactory;

    protected $table = 'tbl_workflow_historys';

    protected $fillable = [
        'Regno',
        'WorkflowCodeId'
    ];

}
