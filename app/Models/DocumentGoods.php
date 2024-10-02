<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentGoods extends Model
{
    use HasFactory;

    protected $table = 'tbl_document_goods';

    protected $fillable = [
        'Regno',
        'PicCustomerId',
        'PicRecipientId',
        'AlamatInvoiceId',
        'AlamatDeliveryId',
        'EstimasiTime',
        'EstimasiDate'
    ];

    public function PicCustomer()
    {
        return $this->hasOne(PicCustomer::class, 'id', 'PicCustomerId');
    }
    public function PicRecipient()
    {
        return $this->hasOne(PicCustomer::class, 'id', 'PicRecipientId');
    }
    public function AlamatInvoice()
    {
        return $this->hasOne(Alamat::class, 'id', 'AlamatInvoiceId');
    }
    public function AlamatDelivery()
    {
        return $this->hasOne(Alamat::class, 'id', 'AlamatDeliveryId');
    }
}
