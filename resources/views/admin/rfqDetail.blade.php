
@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Request For Quotation</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">
    <div class="card-body">
        <div class="input-group">
            <select class="form-control" onchange="ChangePt()" id="scPT">
                <option value="">-- Pilih --</option>
                @foreach ($perusahaanList as $data)
                    <option value="{{ $data->Code }}" {{ ($data->Code == $rfq->PerushaanId) ? 'selected' : '' }}>{{ $data->Nama }}</option>
                @endforeach
            </select> &nbsp;
            <button class="btn btn-success">Save</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="mt-3 col-md-7">
        <div class="card" style="border-radius: 25px">
            <div class="card-body">
                
            </div>
        </div>
    </div>
    <div class="mt-3 col-md-5">
        <div class="card" style="border-radius: 25px">
            <div class="card-body">
                
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
                <table>
                    <tr>
                        <td>Company</td>
                        <td>&nbsp; : </td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td>&nbsp; : </td>
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
                        <td>&nbsp; : </td>
                    </tr>
                    <tr>
                        <td>Delivery To</td>
                        <td>&nbsp; : {{ $dgDt->AlamatDelivery->Alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3 col-md-6">
        <div class="card" style="border-radius: 25px">
            <div class="card-body">
                
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

@if($wfApp->WorkflowCurrentCodeId == 'RFQ')
    <div class="alert alert-primary mt-3" style="border-radius: 25px">
        <a href="#" onclick="showModalNextStage()">Lanjutkan Data Ke Supplier</a>
    </div>
@endif

<script type="text/javascript">
    function showModalNextStage(){
        $('#mNext').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function ChangePt(){
        var val = $("#scPT").val();
        alert(val);
    }
    
</script>    
@endsection
