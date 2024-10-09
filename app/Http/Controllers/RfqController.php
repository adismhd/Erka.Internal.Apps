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
use App\Models\Perusahaan;
use App\Models\Rfq;
use App\Models\InstructionNote;
use Carbon\Carbon;

class RfqController extends Controller
{
    public function GetListData()
    {
        $aplikasis = Aplikasi::whereHas('WorkflowHistory', function($query) {
                $query->where('WorkflowCodeId', 'RFQ');
            })
            ->with('WorkflowHistory')
            ->with('Author')
            ->with('Customers')
            ->get();
            
        return view('admin.rfq', [
            "title" => "RFQ",
            "inboxList" => $aplikasis
        ]);
    }
    
    public function DetailRfq($id)
    {
        $aplikasi = Aplikasi::where('Regno', $id)->first();
        $perusahaan = Perusahaan::get();
        $wf = WorkflowApplication::where('Regno', $id)->first();
        $dg = DocumentGoods::where('Regno', $id)->first();
        $itemGoodList = ItemGood::where('Regno', $id)->get();
        $rfq = Rfq::where('Regno', $id)->first();

        if($rfq == null){
            Rfq::create([
                'Regno' => $id,
                'PerusahaanId' => null
            ]);
        }
        $tempPerushaan = $rfq->PerusahaanId ?? "";
        $in = InstructionNote::where('PerusahaanId', $tempPerushaan)->get();
        
        return view('admin.rfqDetail', [
            "title" => "RFQ",
            "aplikasiDt" => $aplikasi,
            "dgDt" => $dg,
            "rfq" => $rfq,
            "perusahaanList" => $perusahaan,
            "itemGoodList" => $itemGoodList,
            "instructionNote" => $in,
            "wfApp" => $wf
        ]);
    }

    public function SavePerushaan(Request $request)
    {
        Rfq::where('Regno', $request->Regno)->update([
            'PerusahaanId' => $request->ptInduk
        ]);

        return back();
    }

}
