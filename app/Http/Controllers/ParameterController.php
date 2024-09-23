<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Perusahaan;
use App\Models\InstructionNote;

class ParameterController extends Controller
{
    public function GetListParamter()
    {
        $author = Author::orderBy('created_at', 'DESC')->get();
        $perusahaan = Perusahaan::orderBy('tbl_perusahaans.created_at', 'DESC')
            ->with('instructionNotes')    
            //->leftJoin('tbl_intsruction_notes', 'tbl_perusahaans.Code', '=', 'tbl_intsruction_notes.PerusahaanId')
            ->get();

        //dd($perusahaan);

        return view('admin.parameter', [
            "title" => "Parameter",
            "authorList" => $author,
            "perusahaanList" => $perusahaan,
        ]);
    }

    public function AddAuthor(Request $request)
    {
        $author = Author::where('id', $request->Id)->first();
        if ($author) {
            Author::where('id', $request->Id)->update([
                'Nama' => $request->Nama,
                'Jabatan' => $request->Jabatan,
                'NoTelepon' => $request->NoTelepon
            ]);
        }
        else {
            Author::create([
                'Nama' => $request->Nama,
                'Jabatan' => $request->Jabatan,
                'NoTelepon' => $request->NoTelepon
            ]);
        }

        return back();
    }

    public function DeleteAuthor(Request $request)
    {
        $author = Author::where('id', $request->Id)->delete();

        return back();
    }
    
    public function AddPerusahaan(Request $request)
    {
        $perusahaan = Perusahaan::where('id', $request->Id)->first();
        //dd($request);
        if ($perusahaan != null) {
            Perusahaan::where('id', $request->Id)->update([
                'Code' => $request->Code,
                'Nama' => $request->Nama,
                'Deskripsi' => $request->Deskripsi,
                'Alamat' => $request->Alamat
            ]);
        }
        else {
            $perusahaan = Perusahaan::where('Code', $request->Code)->first();
            if ($perusahaan != null) {
                return response()->json(['message' => 'Perusahaan sudah ada', 'code' => '401']);
            }

            Perusahaan::create([
                'Code' => $request->Code,
                'Nama' => $request->Nama,
                'Deskripsi' => $request->Deskripsi,
                'Alamat' => $request->Alamat
            ]);
        }

        return back();
    }

    public function DeletePerusahaan(Request $request)
    {
        $author = Perusahaan::where('id', $request->Id)->delete();

        return back();
    }
    
    public function AddInstruction(Request $request)
    {
        $dt = Perusahaan::where('id', $request->Id)->first();
        //dd($request);
        if ($dt != null) {
            InstructionNote::where('id', $request->Id)->update([
                'PerusahaanId' => $request->Code,
                'Deskripsi' => $request->Deskripsi
            ]);
        }
        else {
            InstructionNote::create([
                'PerusahaanId' => $request->Code,
                'Deskripsi' => $request->Deskripsi
            ]);
        }

        return back();
    }

    public function DeleteInstruction(Request $request)
    {
        InstructionNote::where('id', $request->Id)->delete();

        return back();
    }
}
