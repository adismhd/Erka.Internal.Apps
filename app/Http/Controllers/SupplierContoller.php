<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefSupplier;
use App\Models\Supplier;
use App\Models\SupplierLink;
use App\Models\Aplikasi;
use App\Models\Perusahaan;
use App\Models\WorkflowApplication;
use App\Models\DocumentGoods;
use App\Models\ItemGood;
use App\Models\Rfq;
use App\Models\InstructionNote;
use Carbon\Carbon;

class SupplierContoller extends Controller
{
    public function GetListData()
    {
        $aplikasis = Aplikasi::whereHas('WorkflowHistory', function($query) {
            $query->where('WorkflowCodeId', 'SW');
        })
        ->with('WorkflowHistory')
        ->with('Author')
        ->with('Customers')
        ->with('Supplier')
        ->get();

        $supplierList = RefSupplier::get();
            
        return view('admin.supplier', [
            "title" => "Supplier",
            "inboxList" => $aplikasis,
            "supplierList" => $supplierList
        ]);
    }

    public function SetSupplier(Request $request)
    {
        $data = Supplier::where('Regno', $request->Regno)->first();
        if ($data == null){
            Supplier::create([
                'Regno' => $request->Regno,
                'SupplierCode' => $request->SupplierCode
            ]);
        }
        else {
            Supplier::where('Regno', $request->Regno)->update([
                'SupplierCode' => $request->SupplierCode
            ]);
        }

        return back();
    }
    
    public function DetailSupplier($id)
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
        $perusahaanDt = Perusahaan::where('Code', $tempPerushaan)->first();

        $tanggal = Carbon::parse($rfq->created_at)->translatedFormat('l, d F Y');

        return view('admin.rfqDetail', [
            "title" => "RFQ",
            "aplikasiDt" => $aplikasi,
            "dgDt" => $dg,
            "rfq" => $rfq,
            "tanggal" => $tanggal,
            "perusahaanList" => $perusahaan,
            "perusahaanDt" => $perusahaanDt,
            "itemGoodList" => $itemGoodList,
            "instructionNote" => $in,
            "wfApp" => $wf
        ]);
    }

}
