<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ref\RefTop;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'tbl_plan';

    protected $fillable = [
        'Regno',
        'ExpectedProfit',
        'Discount'
    ];
    
    // public function Top()
    // {
    //     return $this->hasone(RefTop::class, 'CodeId', 'TermOfPayment');
    // }
}
