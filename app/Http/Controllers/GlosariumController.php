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
}
