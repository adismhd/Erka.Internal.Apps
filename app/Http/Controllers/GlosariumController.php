<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Alamat;
use App\Models\PicCustomers;

class GlosariumController extends Controller
{
    public function GetListData()
    {
        $glosarium = Customers::orderBy('created_at', 'DESC')->get();

        return view('admin.glosarium', [
            "title" => "Glosarium",
            "glosariumList" => $glosarium
        ]);
    }

    public function GetDetailGlosarium($id)
    {
        $glosarium = Customers::where('Code', $id)->first();
        $alamat = Alamat::where('CodeId', $glosarium->Code)->get();
        $pic = PicCustomers::where('CodeId', $glosarium->Code)->get();

        return view('admin.glosariumDetail', [
            "title" => "Glosarium",
            "glosariumData" => $glosarium,
            "picData" => $pic,
            "alamatData" => $alamat
        ]);
    }

    public function InsertGlosarium(Request $request)
    {
        Customers::create([
            'Code' => $request-> Code,
            'Perusahaan' => $request->Perusahaan
        ]);

        return redirect('/DetailGlosarium/'.$request->Code);
    }

    public function DeleteGlosarium(Request $request)
    {
        $glosariumLama = Customers::where('Id',$request->Id)->delete();
        
        return redirect('/Glosarium');
    }

    public function EditGlosarium(Request $request)
    {
        $glosariumLama = Customers::where('Id',$request->Id)->first();
        Alamat::where('CodeId', $glosariumLama->Code)->update([
            'CodeId' => $request->Code
        ]);
        PicCustomers::where('CodeId', $glosariumLama->Code)->update([
            'CodeId' => $request->Code
        ]);
                
        //dd($request->Id);
        Customers::where('Id',$request->Id)->update([
            'Code' => $request-> Code,
            'Perusahaan' => $request->Perusahaan
        ]);

        return redirect('/DetailGlosarium/'.$request->Code);
        //return back();
    }
    
    public function InsertAlamatGlosarium(Request $request)
    {
        //dd($request->Id);
        if($request->Id == null){
            Alamat::create([
                'CodeId' => $request->Code,
                'Deskripsi' => $request->Deskripsi,
                'Alamat' => $request->Alamat
            ]);
        }
        else{
            Alamat::where('id', $request->Id)->update([
                'CodeId' => $request->Code,
                'Deskripsi' => $request->Deskripsi,
                'Alamat' => $request->Alamat
            ]);    
        }

        return back();
        //return redirect('/DetailGlosarium/'.$request->Code);
    }

    public function DeleteAlamatGlosarium(Request $request)
    { 
        Alamat::where('id', $request->Id)->delete();
        
        return back();
    }

    public function InsertPicGlosarium(Request $request)
    {
        //dd($request->Id);
        if($request->Id == null){
            PicCustomers::create([
                'CodeId' => $request->Code,
                'Nama' => $request->Nama,
                'NoTelepon' => $request->NoTelepon
            ]);
        }
        else{
            PicCustomers::where('id', $request->Id)->update([
                'CodeId' => $request->Code,
                'Nama' => $request->Nama,
                'NoTelepon' => $request->NoTelepon
            ]);    
        }

        return back();
        //return redirect('/DetailGlosarium/'.$request->Code);
    }

    public function DeletePicGlosarium(Request $request)
    { 
        Alamat::where('id', $request->Id)->delete();
        
        return back();
    }

}
