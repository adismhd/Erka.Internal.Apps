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
        $tanggal = Carbon::now()->translatedFormat('l, d F Y');

        if($rfq == null){
            $rfq = Rfq::create([
                'Regno' => $id,
                'PerusahaanId' => null
            ]);
        }
        else
        {
            $tanggal = Carbon::parse($rfq->created_at)->translatedFormat('l, d F Y');
        }

        $tempPerushaan = $rfq->PerusahaanId ?? "";
        //dd($tempPerushaan);
        $in = InstructionNote::where('PerusahaanId', $tempPerushaan)->get();
        $perusahaanDt = Perusahaan::where('Code', $tempPerushaan)->first();

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

    public function SavePerushaan(Request $request)
    {
        Rfq::where('Regno', $request->Regno)->update([
            'PerusahaanId' => $request->ptInduk,
            'SourceDocument' => $request->ptInduk . $request->Regno
        ]);

        return back();
    }

    public function SaveSupplierInformation(Request $request)
    {
        Rfq::where('Regno', $request->Regno)->update([
            'SupplierCompany' => $request->Company,
            'SupplierNPWP' => $request->Npwp
        ]);

        return back();
    }

    public function ValidateRfq($id)
    {
        $dg = Rfq::where('Regno', $id)->first();
        $validate = true;
        if ($dg->PerusahaanId == null || $dg->PerusahaanId == "")
        {
            $validate = false;
        }

        return Response()->json($validate);
    }
}
