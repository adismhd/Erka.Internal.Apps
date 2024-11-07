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
use App\Models\Ref\RefTemplateDokumen;
use Carbon\Carbon;
use Dompdf\Dompdf;


class GenerateController extends Controller
{
    public function GeneratePdfRfq(Request $request)
    {
        $dompdf = new Dompdf();

        $aplikasi = Aplikasi::where('Regno', $request->Regno)->first();
        $dokumen = RefTemplateDokumen::where('DokumenCode', 'DRFQ')->where('KeyId', $request->Perusahaan)->first();
        $perusahaan = Perusahaan::where('Code', $request->Perusahaan)->first();
        $rfq = Rfq::where('Regno', $request->Regno)->first();
        $dg = DocumentGoods::where('Regno', $request->Regno)->first();
        $in = InstructionNote::where('PerusahaanId', $request->Perusahaan)->get();
        $ig = ItemGood::where('Regno', $request->Regno)->get();
        $stringHTML = $dokumen->Html;
        
        $logo = "";
        $ptInduk = $perusahaan->Nama;
        $ptSlogan = $perusahaan->Deskripsi;
        $ptAlamat = $perusahaan->Alamat;
        $sourceDokumen = $rfq->SourceDocument;
        $date = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
        $ptClient = $rfq->Company;
        $npwp = $rfq->SupplierNPWP;
        $pic = $dg->PicCustomer->Nama;
        $kontak = $dg->PicCustomer->NoTelepon;
        $alamatClient = $dg->AlamatDelivery->Alamat;
        $instruction = "";
        $itemgoods = "";
        
        foreach ($in as $index => $data){
            $instruction .= "<tr><td>".($index + 1)."</td><td>".$data->Deskripsi."</td></tr>";
        }

        foreach ($ig as $index => $data){
            $itemgoods .= "<tr><td>".($index + 1)."</td><td>".$data->Nama."</td><td>".$data->Spesifikasi."</td><td>".$data->Qty."</td><td>".$data->Satuan."</td><td>".$data->Keterangan."</td></tr>";
        }
        
        $newString = str_replace("&logo&", $logo, $stringHTML);
        $newString = str_replace("&ptInduk&", $ptInduk, $newString);
        $newString = str_replace("&ptSlogan&", $ptSlogan, $newString);        
        $newString = str_replace("&ptAlamat&", $ptAlamat, $newString);   
        $newString = str_replace("&sourceDokumen&", $sourceDokumen, $newString);
        $newString = str_replace("&ptClient&", $ptClient, $newString);
        $newString = str_replace("&date&", $date, $newString);
        $newString = str_replace("&npwp&", $npwp, $newString);
        $newString = str_replace("&pic&", $pic, $newString);
        $newString = str_replace("&kontak&", $kontak, $newString);
        $newString = str_replace("&alamatClient&", $alamatClient, $newString);
        $newString = str_replace("&instruction&", $instruction, $newString);
        $newString = str_replace("&itemgoods&", $itemgoods, $newString);

        $dompdf->loadHtml($newString);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('RFQ_'.$rfq->SourceDocument.'.pdf');
    }    
}
