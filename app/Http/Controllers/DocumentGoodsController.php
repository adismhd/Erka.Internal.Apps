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
use App\Models\Alamat;
use App\Models\PicCustomer;
use App\Models\ItemGood;
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
        $picList = PicCustomer::where('CodeId', $aplikasi->CustomerId)->get();
        $alamatList = Alamat::where('CodeId', $aplikasi->CustomerId)->get();
        $itemGoodList = ItemGood::where('Regno', $id)->get();
        
        return view('admin.documentGoodsDetail', [
            "title" => "DocumentGoods",
            "aplikasiDt" => $aplikasi,
            "dgDt" => $dg,
            "picList" => $picList,
            "alamatList" => $alamatList,
            "itemGoodList" => $itemGoodList
        ]);
    }

    public function EditCustomerInformation(Request $request)
    {
        DocumentGoods::where('id', $request->Id)->update([
            'PicCustomerId' => $request->Pic,
            'AlamatInvoiceId' => $request->Alamat
        ]);  

        return back();
    }
    
    public function EditRecipientInformation(Request $request)
    {
        DocumentGoods::where('id', $request->Id)->update([
            'PicRecipientId' => $request->Pic,
            'AlamatDeliveryId' => $request->Alamat,
            'EstimasiTime' => $request->eTime,
            'EstimasiDate' => $request->eDate
        ]);  

        return back();
    }
    
    public function EditGoodsItem(Request $request)
    {
        if($request->IdItem == null || $request->IdItem == "" ){
            ItemGood::create([
                'Regno' => $request->Id,
                'Nama' => $request->Nama,
                'Spesifikasi' => $request->Spesifikasi,
                'Qty' => $request->Qty,
                'Satuan' => $request->Satuan,
                'Keterangan' => $request->Keterangan
            ]);
        }
        else{
            ItemGood::where('id', $request->IdItem)->update([
                'Nama' => $request->Nama,
                'Spesifikasi' => $request->Spesifikasi,
                'Qty' => $request->Qty,
                'Satuan' => $request->Satuan,
                'Keterangan' => $request->Keterangan
            ]);    
        }

        return back();
    }
    
    public function DeleteGoodsItem(Request $request)
    { 
        ItemGood::where('id', $request->Id)->delete();
        
        return back();
    }
}
