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
        $supplier = Supplier::where('Regno', $id)->first();

        if ($supplier->SupplierCode == "101")
        {
            $itemGood = ItemGood::where('Regno', $id)->get();
            
            return view('admin.supplierPo', [
                "title" => "Supplier",
                "supplier" => $supplier,
            ]);
        }
        else 
        {
            $itemGood = ItemGood::where('Regno', $id)->get();
            $dokumenGood = DocumentGoods::where('Regno', $id)->first();
            
            return view('admin.supplierLink', [
                "title" => "Supplier",
                "supplierDt" => $supplier,
                "itemGoodDt" => $itemGood,
                "dokumenGoodDt" => $dokumenGood
            ]);
        }
    }

    public function AddSupplierLink(Request $request)
    {
        $dataItem = ItemGood::where('id', $request->Id)->first();
        $data = SupplierLink::where('ItemGoodsId', $request->Id)->first();

        $totalHarga = $request->Harga * $dataItem->Qty;

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
                'Ppn' => $request->Ppn,
                'Keterangan' => $request->Keterangan
            ]);
        }
        else {
            SupplierLink::where('ItemGoodsId', $request->Id)->update([
                'ItemGoodsId' => $request->IdItem,
                'Supplier' => $request->Supplier,
                'Alamat' => $request->Alamat,
                'Pic' => "",
                'NoTelepon' => $request->Telepon,
                'Link' => $request->Link,
                'Harga' => $request->Harga,
                'TotalHarga' => $totalHarga,
                'Ppn' => $request->Ppn,
            ]);
        }

        return back();
    }
    
}
