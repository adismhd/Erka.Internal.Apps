<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Glosarium;
use App\Models\Alamat;

class GlosariumController extends Controller
{
    public function GetListData()
    {
        $glosarium = Glosarium::orderBy('created_at', 'DESC')->get();

        return view('admin.glosarium', [
            "title" => "Glosarium",
            "glosariumList" => $glosarium
        ]);
    }

    public function GetDetailGlosarium($id)
    {
        $glosarium = Glosarium::where('Code', $id)->first();
        $alamat = Alamat::where('CodeId', $glosarium->Code)->get();

        return view('admin.glosariumDetail', [
            "title" => "Glosarium",
            "glosariumData" => $glosarium,
            "alamatData" => $alamat
        ]);
    }

    public function InsertGlosarium(Request $request)
    {
        Glosarium::create([
            'Code' => $request-> Code,
            'Perusahaan' => $request->Perusahaan,
            'Pic' => $request->Pic,
            'NoTelepon' => $request->NoTelepon
        ]);

        return redirect('/DetailGlosarium/'.$request->Code);
    }

    public function DeleteGlosarium(Request $request)
    {
        $glosariumLama = Glosarium::where('Id',$request->Id)->delete();
        
        return redirect('/Glosarium');
    }

    public function EditGlosarium(Request $request)
    {
        $glosariumLama = Glosarium::where('Id',$request->Id)->first();
        Alamat::where('CodeId', $glosariumLama->Code)->update([
            'CodeId' => $request->Code
        ]);
        
        //dd($request->Id);
        Glosarium::where('Id',$request->Id)->update([
            'Code' => $request-> Code,
            'Perusahaan' => $request->Perusahaan,
            'Pic' => $request->Pic,
            'NoTelepon' => $request->NoTelepon
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

}
