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

}
