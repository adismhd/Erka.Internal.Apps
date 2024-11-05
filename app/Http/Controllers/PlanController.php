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
            $plan = Plan::create([
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
                $profit = $supLink->Harga + ($supLink->Harga * ($plan->ExpectedProfit / 100));
                $Discount = $supLink->Harga * ($plan->Discount / 100);
                $HargaDiscount = $supLink->Harga - $Discount;

                PlanItem::create([
                    'Regno' => $id,
                    'ItemGoodsId' => $item->id,
                    'SupplierCode' => '102',
                    'SupplierId' => $supLink->id,
                    'Harga' => $supLink->Harga,
                    'TotalHarga' => $supLink->TotalHarga,
                    'Profit' => $profit,
                    'TotalProfit' => $profit * $item->Qty,
                    'Discount' => $Discount,
                    'HargaDiscount' => $HargaDiscount,
                    'TotalHargaDiscount' => $HargaDiscount * $item->Qty,
                    'OngkosKirim' => $supLink->OngkosKirim,
                    'Ppn' => $supLink->Ppn,
                    'Qty' => $item->Qty,
                ]);
            }
            
            if ($supPo != null){
                $profit = $supPo->Harga + ($supPo->Harga * ($plan->ExpectedProfit / 100));
                $Discount = $supPo->Harga * ($plan->Discount / 100);
                $HargaDiscount = $supPo->Harga - $Discount;

                PlanItem::create([
                    'Regno' => $id,
                    'ItemGoodsId' => $item->id,
                    'SupplierCode' => '101',
                    'SupplierId' => $supPo->id,
                    'Harga' => $supPo->Harga,
                    'TotalHarga' => $supPo->TotalHarga,
                    'Profit' => $profit,
                    'TotalProfit' => $profit * $item->Qty,
                    'Discount' => $Discount,
                    'HargaDiscount' => $HargaDiscount,
                    'TotalHargaDiscount' => $HargaDiscount * $item->Qty,
                    'OngkosKirim' => $supPo->OngkosKirim,
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
