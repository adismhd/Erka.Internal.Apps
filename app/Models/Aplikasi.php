<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $table = 'tbl_aplikasis';

    protected $fillable = [
        'Regno',
        'CustomerId',
        'AuthorId'
    ];
    public function WorkflowApplication()
    {
        return $this->hasOne(WorkflowApplication::class, 'Regno', 'Regno');
    }
    public function WorkflowHistory()
    {
        return $this->hasOne(WorkflowHistory::class, 'Regno', 'Regno');
    }
    public function DocumentGood()
    {
        return $this->hasOne(DocumentGoods::class, 'Regno', 'Regno');
    }
    public function Author()
    {
        return $this->hasOne(Author::class, 'id', 'AuthorId');
    }
    public function Customers()
    {
        return $this->hasOne(Customers::class, 'Code', 'CustomerId');
    }
    public function ItemGood()
    {
        return $this->hasmany(ItemGood::class, 'Regno', 'Regno');
    }
    public function Supplier()
    {
        return $this->hasOne(Supplier::class, 'Regno', 'Regno');
    }
}
