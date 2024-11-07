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
use App\Models\PlanDetail;
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
        $perusahaan = Perusahaan::get();
        $plan = Plan::where('Regno', $id)->first();
        if($plan == null){
            $plan = Plan::create([
                'Regno' => $id
            ]);
        }
        
        $planItem = PlanItem::where('Regno', $id)->get();
        PlanItem::where('Regno', $id)->delete();
        PlanDetail::where('Regno', $id)->delete();

        $itemGood = ItemGood::where('Regno', $id)->get();

        // Initialize totals outside the loop
        $TotalCapitalPrice = 0;
        $TotalOrderValueExcludeVat = 0;
        $TaxGoods  = 0;

        foreach ($itemGood as $item)
        {
            $supLink = SupplierLink::where('ItemGoodsId', $item->id)->where('Checked', true)->first();
            $supPo = SupplierPo::where('ItemGoodsId', $item->id)->where('Checked', true)->first();

            if ($supLink != null){
                $profit = $supLink->Harga + ($supLink->Harga * ($plan->ExpectedProfit / 100));
                //dd( $plan->ExpectedProfit);
                $Discount = $supLink->Harga * ($plan->Discount / 100);
                $HargaDiscount = $profit - $Discount;

                $TotalCapitalPrice += $supLink->TotalHarga;
                $TotalOrderValueExcludeVat += $HargaDiscount * $item->Qty;
                $TaxGoods += ((($supLink->Harga * (111 / 100)) - $supLink->Harga) * $item->Qty);

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
                    'CustomCaseVat' => $supLink->Harga + ($supLink->Harga * (3 / 100)),
                    'Vat' => ($supLink->Harga * (111 / 100))- $supLink->Harga,
                    'TotalVatItem' => ((($supLink->Harga * (111 / 100)) - $supLink->Harga) * $item->Qty)
                ]);
            }
            
            if ($supPo != null){
                $profit = $supPo->Harga + ($supPo->Harga * ($plan->ExpectedProfit / 100));
                $Discount = $supPo->Harga * ($plan->Discount / 100);
                $HargaDiscount = $profit - $Discount;
                
                $TotalCapitalPrice += $supPo->TotalHarga;
                $TotalOrderValueExcludeVat += $HargaDiscount * $item->Qty;
                $TaxGoods += ((($supPo->Harga * (111 / 100))- $supPo->Harga) * $item->Qty) ;

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
                    'CustomCaseVat' => $supPo->Harga + ($supPo->Harga * (3 / 100)),
                    'Vat' => ($supPo->Harga * (111 / 100))- $supPo->Harga,
                    'TotalVatItem' => ((($supPo->Harga * (111 / 100))- $supPo->Harga) * $item->Qty)
                ]);
            }
            $planItem = PlanItem::where('Regno', $id)->get();
        }

        $ExpectedDeliveryCost = $TotalCapitalPrice * (5 / 100);
        $ExpectedOperationalCost = $TotalCapitalPrice * (3 / 100);
        $TotalCapitalNeeds = $TotalCapitalPrice + $ExpectedDeliveryCost + $ExpectedOperationalCost;

        $Vat11 = $TotalOrderValueExcludeVat * 0.11;
        $TotalOrderValueIncludeVat = $TotalOrderValueExcludeVat + $Vat11;
        $PPHFinal = $TotalOrderValueIncludeVat * 0.01;
        $CostOfMoney = $TotalCapitalNeeds * 0.025;
        $RelationA = $TotalOrderValueExcludeVat * 0.03;
        $RelationB = 0;
        $RelationC = 0;
        $Risk = $TotalOrderValueExcludeVat * 0.05;
        $Total = $PPHFinal + $CostOfMoney + $RelationA + $RelationB + $RelationC + $Risk;
        $TaxPayable = $Vat11 - $TaxGoods;

        $GrossProfit = $TotalOrderValueExcludeVat - $TotalCapitalNeeds;
        $NetProfitA = $GrossProfit - $Total;
        $NetProfitB = $GrossProfit - $Total + $Risk;
        $NetProfitC = $GrossProfit - $Total + $Risk + $TaxGoods;
        
        PlanDetail::create([
            'Regno' => $id,
            'DetailCode' => '101',
            'Deskripsi' => 'TotalCapitalPrice',
            'Nilai' => $TotalCapitalPrice
        ],
        [
            'Regno' => $id,
            'DetailCode' => '102',
            'Deskripsi' => 'TotalCapitalPrice',
            'Nilai' => $TotalOrderValueExcludeVat
        ],
        [
            'Regno' => $id,
            'DetailCode' => '104',
            'Deskripsi' => 'TaxPayable',
            'Nilai' => $TaxPayable
        ]);

        //dd($Vat11);
        //dd($TotalCapitalPrice); 

        return view('admin.planDetail', [
            "title" => "Plan",
            "aplikasiDt" => $aplikasi,
            "planDt" => $plan,
            "planItem" => $planItem,
            "wfApp" => $wf,
            "perusahaanList" => $perusahaan,
            
            "TotalCapitalPrice" => $TotalCapitalPrice,
            "TotalOrderValueExcludeVat" => $TotalOrderValueExcludeVat,
            "ExpectedDeliveryCost" => $ExpectedDeliveryCost,
            "ExpectedOperationalCost" => $ExpectedOperationalCost,
            "TotalCapitalNeeds" => $TotalCapitalNeeds,
            "Vat11" => $Vat11,
            "TotalOrderValueIncludeVat" => $TotalOrderValueIncludeVat,
            "PPHFinal" => $PPHFinal,
            "CostOfMoney" => $CostOfMoney,
            "RelationA" => $RelationA,
            "RelationB" => $RelationB,
            "RelationC" => $RelationC,
            "Risk" => $Risk,
            "Total" => $Total,
            "TaxGoods" => $TaxGoods,
            "TaxPayable" => $TaxPayable,

            "GrossProfit" => $GrossProfit,
            "NetProfitA" => $NetProfitA,
            "NetProfitB" => $NetProfitB,
            "NetProfitC" => $NetProfitC
        ]);

    }
    
    public function SavePlan(Request $request)
    {
        Plan::where('Regno', $request->Regno)->update([
            'ExpectedProfit' => $request->ExpectedProfit,
            'Discount' => $request->Discount
        ]);
        
        return back();
        //return redirect('DetailPlan/'.$request->Regno);
        //return DetailPlan($request->Regno);
    }
}
