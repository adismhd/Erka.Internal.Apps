<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Customers;
use App\Models\Author;
use App\Models\DocumentGoods;
use App\Models\WorkflowApplication;
use App\Models\WorkflowHistory;
use Carbon\Carbon;

class DocumentGoodsController extends Controller
{
    public function GetListData()
    {
        $aplikasis = Aplikasi::whereHas('WorkflowHistory', function($query) {
                $query->where('WorkflowCodeId', 'DG');
            })
            ->with('WorkflowHistory')
            ->with('Author')
            ->with('Customers')
            ->get();

        $perusahaanList = Customers::get();
        $authorList = Author::get();
            
        return view('admin.documentGoods', [
            "title" => "DocumentGoods",
            "inboxList" => $aplikasis,
            "authorList" => $authorList,
            "perusahaanList" => $perusahaanList
        ]);
    }
    
    public function InsertDocumentGoods(Request $request)
    {
        //dd($request->PerusahaanData);

        $todayCount = Aplikasi::whereDate('created_at', Carbon::today())->count() + 1;
        $prefix = $request->PerusahaanData;
        $month = date('m');
        $year = date('Y');
        $number = str_pad($todayCount, 5, '0', STR_PAD_LEFT);
        $regno = "{$prefix}-{$month}-{$year}-{$number}";

        Aplikasi::create([
            'Regno' => $regno,
            'CustomerId' => $request->PerusahaanData,
            'AuthorId' => $request->Author
        ]);

        WorkflowHistory::create([
            'Regno' => $regno,
            'WorkflowCodeId' => 'ST'
        ]);

        WorkflowHistory::create([
            'Regno' => $regno,
            'WorkflowCodeId' => 'DG'
        ]);

        WorkflowApplication::create([
            'Regno' => $regno,
            'WorkflowCurrentCodeId' => 'DG',
            'WorkflowLastCodeId' => 'ST'
        ]);

        DocumentGoods::create([
            'Regno' => $regno
        ]);
        

        return redirect('/DetailDocumentGoods/'.$regno);
    }
    
    public function DetailDocumentGoods($id)
    {
        $aplikasi = Aplikasi::where('Regno', $id)->first();
        $dg = DocumentGoods::where('Regno', $id)->first();
        $authorList = Author::get();

        return view('admin.documentGoodsDetail', [
            "title" => "DocumentGoods",
            "aplikasiData" => $aplikasi,
            "dgData" => $dg,
            "authorList" => $authorList
        ]);
    }

}
