<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_plan_detail';

    protected $fillable = [
        'Regno',
        'DetailCode',
        'Deskripsi',
        'Nilai'
    ];
    
    // public function Top()
    // {
    //     return $this->hasone(RefTop::class, 'CodeId', 'TermOfPayment');
    // }
}
