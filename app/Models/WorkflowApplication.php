<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowApplication extends Model
{
    use HasFactory;

    protected $table = 'tbl_workflow_applications';

    protected $fillable = [
        'Regno',
        'WorkflowCurrentCodeId',
        'WorkflowLastCodeId'
    ];
}
