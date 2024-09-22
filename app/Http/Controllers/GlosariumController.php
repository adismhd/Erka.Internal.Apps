<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Glosarium;

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
        $glosarium = Glosarium::where('code', $id)->first();

        return view('admin.glosariumDetail', [
            "title" => "Glosarium",
            "glosariumData" => $glosarium
        ]);
    }

    public function InsertGlosarium(Request $request)
    {
        Glosarium::create([
            'Code' => $request-> Code,
            'Perusahaan' => $request-> Perusahaan,
            'Pic' => $request->Pic,
            'NoTelepon' => $request->NoTelepon
        ]);

        //dd($param);  
        //return back();
        return redirect('/DetailGlosarium/'.$request->Code);
    }
}
