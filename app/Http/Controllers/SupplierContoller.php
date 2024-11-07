<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ref\RefSupplier;
use App\Models\Ref\RefTop;

use App\Models\Supplier;
use App\Models\SupplierLink;
use App\Models\SupplierPo;
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
            
        //tambahin harga paling murah

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
        $supplier = Supplier::where('Regno', $id)->first();
        if ($supplier == null){
            $supplier = Supplier::create([
                'Regno' => $id
            ]);
        }

        $aplikasi = Aplikasi::where('Regno', $id)->first();
        $itemGood = ItemGood::where('Regno', $id)->get();
        $dokumenGood = DocumentGoods::where('Regno', $id)->first();
        
        $supplierList = RefSupplier::get();
        $topList = RefTop::get();
        $wf = WorkflowApplication::where('Regno', $id)->first();

        $totalSupplierLink = 0; 
        $totalSupplierLinkPpn = 0; 
        $totalSupplierPo = 0;
        $totalSupplierPoPpn = 0;

        foreach ($itemGood as $itemGoods) 
        { 
            $supLink = SupplierLink::where('ItemGoodsId', $itemGoods->id)->where('Checked', true)->get();
            $supPo = SupplierPo::where('ItemGoodsId', $itemGoods->id)->where('Checked', true)->get();

            foreach ($supLink as $supLinks) 
            { 
                $totalSupplierLink += $supLinks->Harga;
                $totalSupplierLinkPpn += ($supLinks->Harga + ($supLinks->Harga * ($supLinks->Ppn / 100)));
            }
            
            foreach ($supPo as $supPos) 
            { 
                $totalSupplierPo += $supPos->Harga;
                if ($supPos->Ppn == '1' ){
                    $totalSupplierPoPpn += ($supPos->Harga + ($supPos->Harga * 0.11));
                }
            }
        }
        
        $totalHarga = $totalSupplierLink + $totalSupplierPo;
        $totalHargaPpn = $totalSupplierLinkPpn + $totalSupplierPoPpn;

        //dd($totalHargaPpn);

        return view('admin.supplierDetail', [
            "title" => "Supplier",
            "supplierDt" => $supplier,
            "itemGoodDt" => $itemGood,
            "dokumenGoodDt" => $dokumenGood,
            "supplierList" => $supplierList,
            "topList" => $topList,
            "totalHarga" => $totalHarga,
            "totalHargaPpn" => $totalHargaPpn,
            "aplikasi" => $aplikasi,
            "wfApp" => $wf
        ]);
    }

    public function AddSupplierLink(Request $request)
    {
        $dataItem = ItemGood::where('id', $request->IdItem)->first();
        $data = SupplierLink::where('ItemGoodsId', $request->Id)->first();

        $totalHarga = $request->Harga * $dataItem->Qty;
        $hargaPpn = $totalHarga * ($request->Ppn / 100);
        $totalHargaPpn = $totalHarga + $hargaPpn;

        if ($data == null){
            SupplierLink::create([
                'ItemGoodsId' => $request->IdItem,
                'Supplier' => $request->Supplier,
                'Alamat' => $request->Alamat,
                'Pic' => "",
                'NoTelepon' => $request->Telepon,
                'Link' => $request->Link,
                'Harga' => $request->Harga,
                'TotalHarga' => $totalHarga,
                'TotalHargaPpn' => $totalHargaPpn,
                'Ppn' => $request->Ppn,
                'Keterangan' => $request->Keterangan,
                'OngkosKirim' => $request->Ongkos,
                'Checked' => '0'
            ]);
        }
        else {
            SupplierLink::where('id', $request->Id)->update([
                'ItemGoodsId' => $request->IdItem,
                'Supplier' => $request->Supplier,
                'Alamat' => $request->Alamat,
                'Pic' => "",
                'NoTelepon' => $request->Telepon,
                'Link' => $request->Link,
                'Harga' => $request->Harga,
                'TotalHarga' => $totalHarga,
                'TotalHargaPpn' => $totalHargaPpn,
                'Ppn' => $request->Ppn,
                'Keterangan' => $request->Keterangan,
                'OngkosKirim' => $request->Ongkos
            ]);
        }

        return back();
    }
    
    public function DeleteSupplierLink(Request $request)
    {
        //dd($request->Id);
        SupplierLink::where('id',$request->Id)->delete();
        
        return back();
    }

    public function AddSupplierPo(Request $request)
    {
        //dd($request->Id);
        $dataItem = ItemGood::where('id', $request->IdItem)->first();
        $data = SupplierPo::where('id', $request->Id)->first();

        $totalHarga = $request->Harga * $dataItem->Qty;
        $hargaPpn = 0;
        if ($request->Ppn == '1'){
            $hargaPpn = $totalHarga * 0.11;
        }        
        $totalHargaPpn = $totalHarga + $hargaPpn;

        if ($data == null){
            SupplierPo::create([
                'ItemGoodsId' => $request->IdItem,
                'Supplier' => $request->Supplier,
                'Pic' => $request->Pic,
                'NoTelepon' => $request->Telepon,
                'Email' => $request->Email,
                'Ppn' => $request->Ppn,
                'TermOfPayment' => $request->Top,
                'OngkosKirim' => $request->Ongkos,
                'Harga' => $request->Harga,
                'Keterangan' => $request->Keterangan,
                'TotalHarga' => $totalHarga,
                'TotalHargaPpn' => $totalHargaPpn,
                'Checked' => '0'
            ]);
        }
        else {
            SupplierPo::where('id', $request->Id)->update([
                'ItemGoodsId' => $request->IdItem,
                'Supplier' => $request->Supplier,
                'Pic' => $request->Pic,
                'NoTelepon' => $request->Telepon,
                'Email' => $request->Email,
                'Ppn' => $request->Ppn,
                'TermOfPayment' => $request->Top,
                'OngkosKirim' => $request->Ongkos,
                'Harga' => $request->Harga,
                'Keterangan' => $request->Keterangan,
                'TotalHarga' => $totalHarga,
                'TotalHargaPpn' => $totalHargaPpn
            ]);
        }

        return back();
    }
    
    public function DeleteSupplierPo(Request $request)
    {
        //dd($request->Id);
        SupplierPo::where('id',$request->Id)->delete();
        
        return back();
    }

    public function CheckedSupplierPo(Request $request)
    {
        try {
            SupplierPo::where('ItemGoodsId', $request->idGoods)->update(['Checked' => '0']);
            SupplierLink::where('ItemGoodsId', $request->idGoods)->update(['Checked' => '0']);
            $val = '0';
            if ($request->val == 'true')
            {
                $val = '1';
            }
            SupplierPo::where('id', $request->idItem)->update(['Checked' => $val]);

            return response()->json(['code' => 200, 'message' => 'Supplier PO updated successfully']);
        } 
        catch (\Exception $e) {
            return response()->json(['code' => 500, 'message' => 'Failed to update Supplier PO']);
        }
    }
    
    public function CheckedSupplierLink(Request $request)
    {
        try {
            SupplierPo::where('ItemGoodsId', $request->idGoods)->update(['Checked' => '0']);
            SupplierLink::where('ItemGoodsId', $request->idGoods)->update(['Checked' => '0']);
            $val = '0';
            if ($request->val == 'true')
            {
                $val = '1';
            }
            SupplierLink::where('id', $request->idItem)->update(['Checked' => $val]);

            return response()->json(['code' => 200, 'message' => 'Supplier PO updated successfully']);
        } 
        catch (\Exception $e) {
            return response()->json(['code' => 500, 'message' => 'Failed to update Supplier PO']);
        }
    }
}
