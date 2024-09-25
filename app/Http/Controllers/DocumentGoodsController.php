<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\WorkflowApplication;

class DocumentGoodsController extends Controller
{
    public function GetListData()
    {
        $aplikasis = Aplikasi::whereHas('WorkflowApplication', function($query) {
            $query->where('WorkflowCurrentCodeId', 'DG');
        })
        ->with('WorkflowApplication')
        ->with('Author')
        ->with('Customers')
        ->get();

        return view('admin.documentGoods', [
            "title" => "DocumentGoods",
            "inboxList" => $aplikasis
        ]);
    }
}
