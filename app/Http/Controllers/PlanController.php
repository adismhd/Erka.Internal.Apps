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
use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\SupplierLink;
use App\Models\SupplierPo;
use Carbon\Carbon;

class PlanController extends Controller
{
    public function GetListData()
    {
        $aplikasis = Aplikasi::whereHas('WorkflowHistory', function($query) {
                $query->where('WorkflowCodeId', 'PL');
            })
            ->with('WorkflowHistory')
            ->with('Author')
            ->with('Customers')
            ->get();
            
        return view('admin.plan', [
            "title" => "Plan",
            "inboxList" => $aplikasis
        ]);
    }
    
    public function DetailPlan($id)
    {
        $aplikasi = Aplikasi::where('Regno', $id)->first();
        $wf = WorkflowApplication::where('Regno', $id)->first();
        $plan = Plan::where('Regno', $id)->first();
        if($plan == null){
            $supplier = Plan::create([
                'Regno' => $id
            ]);
        }
        
        $planItem = PlanItem::where('Regno', $id)->get();
        PlanItem::where('Regno', $id)->delete();

        $itemGood = ItemGood::where('Regno', $id)->get();

        foreach ($itemGood as $item)
        {
            $supLink = SupplierLink::where('ItemGoodsId', $item->id)->where('Checked', true)->first();
            $supPo = SupplierPo::where('ItemGoodsId', $item->id)->where('Checked', true)->first();

            if ($supLink != null){
                PlanItem::create([
                    'Regno' => $id,
                    'ItemGoodsId' => $item->id,
                    'SupplierCode' => '102',
                    'SupplierId' => $supLink->id,
                    'Harga' => $supLink->Harga,
                    'OngkosKirim' => $supLink->OngkosKirim,
                    'TotalHarga' => $supLink->TotalHarga,
                    'Ppn' => $supLink->Ppn,
                    'Qty' => $item->Qty,
                ]);
            }
            
            if ($supPo != null){
                PlanItem::create([
                    'Regno' => $id,
                    'ItemGoodsId' => $item->id,
                    'SupplierCode' => '101',
                    'SupplierId' => $supPo->id,
                    'Harga' => $supPo->Harga,
                    'OngkosKirim' => $supPo->OngkosKirim,
                    'TotalHarga' => $supPo->TotalHarga,
                    'Ppn' => $supPo->Ppn == '1' ? '11' : '0' ,
                    'Qty' => $item->Qty,
                ]);
            }
            
            $planItem = PlanItem::where('Regno', $id)->get();
        }        
        
        return view('admin.planDetail', [
            "title" => "Plan",
            "aplikasiDt" => $aplikasi,
            "planDt" => $plan,
            "planItem" => $planItem,
            "wfApp" => $wf
        ]);
    }
    
    public function SavePlan(Request $request)
    {
        Plan::where('Regno', $request->Regno)->update([
            'ExpectedProfit' => $request->ExpectedProfit,
            'Discount' => $request->Discount
        ]);
        
        return back();
    }
}
