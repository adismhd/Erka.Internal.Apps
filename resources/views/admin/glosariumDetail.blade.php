@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Detail Customer</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">Code</td>
                    <td style="white-space: nowrap;">&nbsp;: {{ $glosariumData->Code }}</td>
                </tr>
                <tr>
                    <td style="width: 10%">Perusahaan</td>
                    <td style="white-space: nowrap;">&nbsp;: {{ $glosariumData->Perusahaan }}</td>
                </tr>
                <tr>
                    <td style="width: 10%">Pic</td>
                    <td style="white-space: nowrap;">&nbsp;: {{ $glosariumData->Pic }}</td>
                </tr>
                <tr>
                    <td style="width: 10%">No Telepon</td>
                    <td style="white-space: nowrap;">&nbsp;: {{ $glosariumData->NoTelepon }}</td>
                </tr>
            </table>
            <table class="mt-2"  style="width: 100%">
                <tr>
                    <td style="text-align: right">
                        <button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="showModalEdit()">Edit</button>
                    </td>
                </tr>
            </table>
            
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mEdit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="InsertGlosarium" method="post">
                @csrf
                {{-- <input type="text" value="{{ $NoPesanan }}" name="NoPesanan" hidden /> --}}
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Code <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="PCNI" name="Code" value=" {{ $glosariumData->Code }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Perusahaan <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="PT. Nama Perusahaan" name="Perusahaan" value=" {{ $glosariumData->Perusahaan }}"  required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>PIC <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="Nama" name="Pic" value=" {{ $glosariumData->Pic }}"  required>
                    </div>        
                    <div class="col-md-12 mb-3">
                        <label>No Telepon<i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="NoTelepon" value=" {{ $glosariumData->NoTelepon }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<script type="text/javascript">
    function showModalEdit(){
        $('#mEdit').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>    
@endsection
