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
            "title" => "Document Goods",
            "inboxList" => $aplikasis,
            "authorList" => $authorList,
            "perusahaanList" => $perusahaanList
        ]);
    }
    
    public function InsertDocumentGoods(Request $request)
    {
        $todayCount = Aplikasi::whereDate('created_at', Carbon::today())->count();
        $prefix = $request->Perusahaan;
        $month = date('m');
        $year = date('Y');
        $number = str_pad($todayCount, 5, '0', STR_PAD_LEFT);
        $regno = "{$prefix}-{$month}-{$year}-{$number}";

        Aplikasi::create([
            'Regno' => $regno,
            'CustomerId' => $request->Perusahaan,
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
        

        return redirect('/DetailDocumentGoods/'.$request->Code);
    }
    
    public function DetailDocumentGoods($id)
    {
        $glosarium = Customers::where('Code', $id)->first();
        $alamat = Alamat::where('CodeId', $glosarium->Code)->get();
        $pic = PicCustomer::where('CodeId', $glosarium->Code)->get();

        return view('admin.glosariumDetail', [
            "title" => "Glosarium",
            "glosariumData" => $glosarium,
            "picData" => $pic,
            "alamatData" => $alamat
        ]);
    }

}
