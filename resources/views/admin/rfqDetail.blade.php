
@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Request For Quotation</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">
    <div class="card-body">
        <form action="/SavePerushaan" method="post">
            @csrf
            <input type="text" value="{{ $aplikasiDt->Regno }}" name="Regno" hidden />
            <div class="input-group">
                <select class="form-control" onchange="ChangePt()" id="scPT" name="ptInduk">
                    <option value="">-- Pilih --</option>
                    @foreach ($perusahaanList as $data)
                        <option value="{{ $data->Code }}" {{ ($data->Code == $rfq->PerusahaanId) ? 'selected' : '' }}>{{ $data->Nama }}</option>
                    @endforeach
                </select> &nbsp;
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="mt-3 col-md-7">
        <div class="card" style="border-radius: 25px">
            <div class="card-body">
                @isset($perusahaanDt)
                    {{-- <p>{{ $perusahaanDt }}</p> --}}
                    <h4>{{ $perusahaanDt->Nama }}</h4>
                    <h6>{{ $perusahaanDt->Deskripsi }}</h6>
                    <h6>{{ $perusahaanDt->Alamat }}</h6>
                @endisset
            </div>
        </div>
    </div>
    <div class="mt-3 col-md-5">
        <div class="card" style="border-radius: 25px">
            <div class="card-body" style="text-align: center">
                <h5>{{ $aplikasiDt->Regno }}</h5>
                <h6>{{ $tanggal }}</h6>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="mt-3 col-md-6">
        <div class="card" style="border-radius: 25px">
            <div class="card-header" style="border-top-left-radius: 25px; border-top-right-radius: 25px;">
                <h5>Supplier Information </h5>
            </div>
            <div class="card-body">
                <table style="width: 100%">
                    <tr>
                        <td>Company</td>
                        <td>&nbsp; : {{ $rfq->SupplierCompany  }}</td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td>&nbsp; : {{ $rfq->SupplierNPWP  }}</td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td>&nbsp; : {{ $dgDt->PicRecipient->Nama  }}</td>
                    </tr>
                    <tr>
                        <td>No. Handphone</td>
                        <td>&nbsp; : {{ $dgDt->PicRecipient->NoTelepon  }}</td>
                    </tr>
                    <tr>
                        <td>Source Docs</td>
                        <td>&nbsp; : {{ $rfq->SourceDocument  }}</td>
                    </tr>
                    <tr>
                        <td>Delivery To</td>
                        <td>&nbsp; : {{ $dgDt->AlamatDelivery->Alamat }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right"><button class="btn btn-info btn-sm" onclick="ShowModalSupplierInformation()">Edit</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3 col-md-6">
        <div class="card" style="border-radius: 25px">
            <div class="card-header" style="border-top-left-radius: 25px; border-top-right-radius: 25px;">
                <h5>Instruction Note</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="border-radius: 15px;">
                    <table class="table table-striped table-sm" style="">
                        <tbody>
                            @foreach ($instructionNote as $data)
                                <tr class="" >
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="">{{ $data->Deskripsi }}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-striped table-sm" style="">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">Name of Goods & Codes Series</th>
                        <th scope="col">Specification</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemGoodList as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="white-space: nowrap;">{{ $data->Nama }}</td>
                            <td style="white-space: nowrap;">{{ $data->Spesifikasi }}</td>
                            <td style="white-space: nowrap;">{{ $data->Qty }}</td>
                            <td style="white-space: nowrap;">{{ $data->Satuan }}</td>
                            <td style="white-space: nowrap;">{{ $data->Keterangan }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Next Stage --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mSI">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/SaveSupplierInformation" method="post">
                @csrf
                <input type="text" value="{{ $aplikasiDt->Regno }}" name="Regno" hidden />

                <div class="modal-header">
                    <h5 class="modal-title">Supplier Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Company <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="Company" value="{{ $rfq->SupplierCompany }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>NPWP <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Npwp" value="{{ $rfq->SupplierNPWP }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>            
        </div>
    </div>
</div>

{{-- Modal Next Stage --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mNext">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/NextStage" method="post">
                @csrf
                <input type="text" value="{{ $aplikasiDt->Regno }}" name="Regno" hidden />
                <input type="text" value="SW" name="Next" hidden />

                <div class="modal-header">
                    {{-- <h5 class="modal-title">Hapus Data</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <p style="color: black">Apakah anda yakin akan melanjutkan data?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<form action="/GeneratePdfRfq" method="post" id="sGeneratePdf">
    @csrf
    <input type="text" value="{{ $aplikasiDt->Regno }}" name="Regno" hidden />
    <input type="text" value="RKB" name="Perusahaan" hidden />

    <div class="alert btn-info mt-3" style="border-radius: 25px; text-align: center" onclick="GeneratePdf()">
        <a href="#"><i class="fa-regular fa-file"></i> &nbsp; Generate Dokumen Request For Quotation</a>
    </div>        
</form>

@if($wfApp->WorkflowCurrentCodeId == 'RFQ')
    <div class="alert btn-primary mt-3" style="border-radius: 25px; text-align: center" onclick="ValidateData()">
        <a href="#">Lanjutkan Data Ke Supplier</a>
    </div>
@endif

<input type="text" value="{{ $aplikasiDt->Regno }}" id="dtId" hidden/>

<script type="text/javascript">
    function ValidateData(){
        const regno = $("#dtId").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'GET',
            url: "ValidateRfq/"+regno,
            cache:false,
            contentType: false,
            processData: false,
            success: (Dt, textStatus, jqXHR) => {
                console.log(Dt);
                if (Dt == false) {
                    alert("Lengkapi Semua Data!");
                }
                else {
                    ShowModalNextStage()
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    function ShowModalSupplierInformation(){
        $('#mSI').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function ShowModalNextStage(){
        $('#mNext').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function ChangePt(){
        var val = $("#scPT").val();
        //alert(val);
    }
    
    function GeneratePdf() {
        document.getElementById('sGeneratePdf').submit();
    }
</script>    
@endsection
