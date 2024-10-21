
@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Supplier Link</h1>
</div>

<div class="mt-4">
    <div class="card" style="border-radius: 25px">
        <div class="card-body">
            <table>
                <tr><td>Source Doc</td><td>:</td></tr>
                <tr><td>Date Doc</td><td>:</td></tr>
                <tr><td>Customer</td><td>:</td><td>&nbsp;{{ $supplierDt->created_at }}</td></tr>
                <tr><td>Delivery</td><td>:</td><td>&nbsp;{{ $dokumenGoodDt->AlamatDelivery->Alamat }}</td></tr>
            </table>
        </div>
    </div>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-sm" style="">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">Name of Goods & Codes Series</th>
                        <th scope="col">QTY</th>
                        <th scope="col" style="text-align: center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemGoodDt as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="white-space: nowrap;">{{ $data->Nama }}</td>
                            <td style="white-space: nowrap;">{{ $data->Qty }}</td>
                            <td style="text-align: center">
                                <button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="SmSupplier('{{ $data->id }}')">Tambah</button>
                            </td>
                        </tr>
                        @if(!empty($data->SupplierLink) && count($data->SupplierLink) > 0)
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <table style="width: 100%" class="table-sm table">
                                        <thead class="table-primary" >
                                            <tr>
                                                <th style="white-space: nowrap;">Supplier</th>
                                                <th style="white-space: nowrap;">PPN</th>
                                                <th style="white-space: nowrap;">Harga Satuan</th>
                                                <th style="white-space: nowrap;">Total Harga</th>
                                                <th style="text-align: center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->SupplierLink as $dataLink)
                                                <tr>
                                                    <td style="white-space: nowrap;">{{ $dataLink->Supplier }}</td>
                                                    <td style="white-space: nowrap;">{{ $dataLink->Ppn }} %</td>
                                                    <td style="white-space: nowrap;">Rp. {{ $dataLink->Harga }}</td>
                                                    <td style="white-space: nowrap;">Rp. {{ $dataLink->TotalHarga }}</td>
                                                    <td style="white-space: nowrap; text-align: center;">
                                                        <a href="{{ $dataLink->Link }}" class="btn btn-sm btn-outline-primary">Link</a>
                                                        <button class="btn btn-sm btn-info" onclick="SmEditSupplier('{{ $data->id }}', 
                                                            '{{ $dataLink->id }}',
                                                            '{{ $dataLink->Supplier }}', 
                                                            '{{ $dataLink->Alamat }}', 
                                                            '{{ $dataLink->NoTelepon }}', 
                                                            '{{ $dataLink->Link }}',
                                                            '{{ $dataLink->Harga }}',
                                                            '{{ $dataLink->Ppn }}',
                                                            '{{ $dataLink->Keterangan }}')">Edit</button>
                                                        <button class="btn btn-sm btn-danger"  onclick="SmDeleteSupplier('{{ $data->id }}')" >Hapus</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Goods --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mtSupplier">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/AddSupplierLink" method="post">
                @csrf
                <input type="text" name="IdItem" id="isIdItem" hidden />
                <input type="text" name="Id" id="isId" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Data Supplier </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Supplier <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="Supplier" id="isSupplier" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alamat <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="Alamat" id="isAlamat" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>No Telepon <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Telepon" id="isTelepon" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Link <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="Link" id="isLink" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Harga <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Harga" id="isHarga" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Ppn <i style="color: crimson">*</i></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="Ppn" id="isPpn" required>
                            <span class="input-group-text" >%</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Keterangan <i style="color: crimson">*</i></label>
                        <textarea type="text" class="form-control" name="Keterangan" id="isKeterangan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

{{-- Modal Hapus Goods --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mHapusPic">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeleteSupplierLink" method="post">
                @csrf
                <input type="text" name="Id" id="idSupplierHapus" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <p style="color: black">Apakah anda yakin akan menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<script type="text/javascript">
    function SmSupplier(id){
        $("#isIdItem").val(id);
        $("#isId").val("");
        $("#isSupplier").val("");
        $("#isAlamat").val("");
        $("#isTelepon").val("");
        $("#isLink").val("");
        $("#isHarga").val("");
        $("#isPpn").val("");
        $("#isKeterangan").val("");

        $('#mtSupplier').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function SmEditSupplier(idItem, id, sup, alamat, tlp, link, harga, ppn, ket){
        $("#isIdItem").val(idItem);
        $("#isId").val(id);
        $("#isSupplier").val(sup);
        $("#isAlamat").val(alamat);
        $("#isTelepon").val(tlp);
        $("#isLink").val(link);
        $("#isHarga").val(harga);
        $("#isPpn").val(ppn);
        $("#isKeterangan").val(ket);

        $('#mtSupplier').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function SmDeleteSupplier(id){
        $("#idSupplierHapus").val(id);

        $('#mHapusPic').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>   

@endsection
