
@extends('layout.admin')

@section('container')

<style>
    .modal-content {
        max-height: 80vh; /* Or any value that fits your design */
        overflow-y: auto;
    }
</style>

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
                        <tr class="table-primary" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="white-space: nowrap;">{{ $data->Nama }}</td>
                            <td style="white-space: nowrap;">{{ $data->Qty }}</td>
                            <td style="text-align: center; width: 13%;">
                                <button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="SmTambahSupplier('{{ $data->id }}')">Tambah</button>
                            </td>
                        </tr>
                        @if(!empty($data->SupplierLink) && count($data->SupplierLink) > 0)
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <table style="width: 100%" class="table-sm table">
                                        <thead class="table-secondary" >
                                            <tr>
                                                <th style="white-space: nowrap; text-align: center; width: 5%;">Pilih</th>
                                                <th style="white-space: nowrap;">Supplier</th>
                                                <th style="white-space: nowrap;">PPN</th>
                                                <th style="white-space: nowrap;">Harga Satuan</th>
                                                <th style="white-space: nowrap;">Total Harga</th>
                                                <th style="text-align: center; width: 13%;">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->SupplierLink as $dataLink)
                                                <tr>
                                                    <td style="white-space: nowrap; text-align: center;">
                                                        <input type="checkbox" 
                                                            {{  $dataLink->Checked == '1' ? 'checked' : '' }}
                                                            onclick="CheckChangeLink(this.checked, '{{ $data->id }}', '{{ $dataLink->id }}')">
                                                    </td>
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
                                                            '{{ $dataLink->Keterangan }}',
                                                            '{{ $dataLink->OngkosKirim }}'
                                                            )">Edit</button>
                                                        <button class="btn btn-sm btn-danger"  onclick="SmDeleteSupplier('{{ $dataLink->id }}')" >Hapus</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                        @if(!empty($data->SupplierPo) && count($data->SupplierPo) > 0)
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <table style="width: 100%" class="table-sm table">
                                        <thead class="table-secondary" >
                                            <tr>
                                                <th style="white-space: nowrap; text-align: center; width: 5%;">Pilih</th>
                                                <th style="white-space: nowrap;">Supplier</th>
                                                <th style="white-space: nowrap;">Pic</th>
                                                <th style="white-space: nowrap;">No. Telepon</th>
                                                <th style="white-space: nowrap;">Top</th>
                                                <th style="white-space: nowrap;">Vat 11%</th>
                                                <th style="white-space: nowrap;">Harga Satuan</th>
                                                <th style="white-space: nowrap;">Total Harga</th>
                                                <th style="text-align: center; width: 13%;">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->SupplierPo as $dataLink)
                                                <tr>
                                                    <td style="white-space: nowrap; text-align: center;">
                                                        <input type="checkbox" 
                                                            {{  $dataLink->Checked == '1' ? 'checked' : '' }}
                                                            onclick="CheckChangePo(this.checked, '{{ $data->id }}', '{{ $dataLink->id }}')">
                                                    </td>
                                                    <td style="white-space: nowrap;">{{ $dataLink->Supplier }}</td>
                                                    <td style="white-space: nowrap;">{{ $dataLink->Pic }}</td>
                                                    <td style="white-space: nowrap;">{{ $dataLink->NoTelepon }}</td>
                                                    <td style="white-space: nowrap;">{{ $dataLink->Top->Deskripsi }}</td>
                                                    <td style="white-space: nowrap;">{{ $dataLink->Ppn == 1 ? 'Ya' : 'Tidak' }}</td>
                                                    <td style="white-space: nowrap;">Rp. {{ $dataLink->Harga }}</td>
                                                    <td style="white-space: nowrap;">Rp. {{ $dataLink->TotalHarga }}</td>
                                                    <td style="white-space: nowrap; text-align: center;">
                                                        <button class="btn btn-sm btn-info" onclick="SmEditSupplierPo('{{ $data->id }}', 
                                                            '{{ $dataLink->id }}',
                                                            '{{ $dataLink->Supplier }}', 
                                                            '{{ $dataLink->Pic }}', 
                                                            '{{ $dataLink->NoTelepon }}', 
                                                            '{{ $dataLink->Email }}',
                                                            '{{ $dataLink->Ppn }}',
                                                            '{{ $dataLink->TermOfPayment }}',
                                                            '{{ $dataLink->OngkosKirim }}',
                                                            '{{ $dataLink->Harga }}',
                                                            '{{ $dataLink->Keterangan }}'
                                                            )">Edit</button>
                                                        <button class="btn btn-sm btn-danger"  onclick="SmDeleteSupplierPo('{{ $dataLink->id }}')" >Hapus</button>
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

<div class="mt-4">
    <div class="card" style="border-radius: 25px">
        <div class="card-body">
            <table class="table table-striped">
                <tr><td>Total Order Value Exclude Ppn</td><td>:</td><td>{{ $totalHarga }}</td></tr>
                <tr><td>Total Order Value Include Ppn</td><td>:</td><td>{{ $totalHargaPpn }}</td></tr>
            </table>
        </div>
    </div>
</div>

{{-- Modal Pilih Supplier --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mTambah">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="SetSupplier" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Supplier Tipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Tipe Supplier <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="SupplierCode" id="sSupplier">
                            @foreach ($supplierList as $data)
                                <option value="{{ $data->CodeId }}">{{ $data->Deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="SmPilihSupplier()">Pilih</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>            
        </div>
    </div>
</div>

{{-- Modal Supplier Link --}}
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
                        <label>Ongkos Kirim <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Ongkos" id="isOngkos" required>
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

{{-- Modal Hapus Supplier Link --}}
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

{{-- Modal Supplier Po --}}
<div class="modal" id="mtPoSupplier">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="/AddSupplierPo" method="post">
                @csrf
                <input type="text" name="IdItem" id="isIdItemPo" hidden />
                <input type="text" name="Id" id="isPoId" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Data Supplier </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Supplier <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="Supplier" id="isPoSupplier" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Pic <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" name="Pic" id="isPoPic" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>No Telepon <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Telepon" id="isPoTelepon" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Email <i style="color: crimson">*</i></label>
                        <input type="email" class="form-control" name="Email" id="isPoEmail" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Vat 11% <i style="color: crimson">*</i></label>
                        <div class="input-group">
                            <select class="form-select form-control" name="Ppn" id="isPoPpn">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <span class="input-group-text" >%</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Term Of Payment <i style="color: crimson">*</i></label>
                        <div class="input-group">
                            <select class="form-select form-control" name="Top" id="isPoTop">
                                @foreach ($topList as $data)
                                    <option value="{{ $data->CodeId }}">{{ $data->Deskripsi }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-text" >%</span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Harga <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Harga" id="isPoHarga" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Ongkos Kirim <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Ongkos" id="isPoOngkos" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Keterangan <i style="color: crimson">*</i></label>
                        <textarea type="text" class="form-control" name="Keterangan" id="isKeteranganPo" required></textarea>
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

{{-- Modal Hapus Supplier Po --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mHapusSupplierPo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeleteSupplierPo" method="post">
                @csrf
                <input type="text" name="Id" id="idSupplierPoHapus" hidden />
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

{{-- Modal Next Stage --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mNext">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/NextStage" method="post">
                @csrf
                <input type="text" value="{{ $supplierDt->Regno }}" name="Regno" hidden />
                <input type="text" value="PL" name="Next" hidden />

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

@if($wfApp->WorkflowCurrentCodeId == 'SW')
    <div class="alert btn-primary mt-3" style="border-radius: 25px; text-align: center" onclick="ValidateData()">
        <a href="#">Lanjutkan Data Ke Plan</a>
    </div>
@endif

<script type="text/javascript">
    function SmTambahSupplier(id){
        $("#isIdItem").val(id);
        $("#isIdItemPo").val(id);

        $('#mTambah').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function SmPilihSupplier(){
        var dtSup = $('#sSupplier').val();
        console.log(dtSup);
        $('#mTambah').modal('hide');

        if (dtSup == "102")
        {
            SmSupplier();
        }
        else
        {
            SmSupplierPo();
        }
    }

    function SmSupplier(){
        //$("#isIdItem").val(id);
        $("#isId").val("");
        $("#isSupplier").val("");
        $("#isAlamat").val("");
        $("#isTelepon").val("");
        $("#isLink").val("");
        $("#isHarga").val("");
        $("#isPpn").val("11");
        $("#isOngkos").val("");
        $("#isKeterangan").val("");

        $('#mtSupplier').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function SmEditSupplier(idItem, id, sup, alamat, tlp, link, harga, ppn, ket, ongkos){
        $("#isIdItem").val(idItem);
        $("#isId").val(id);
        $("#isSupplier").val(sup);
        $("#isAlamat").val(alamat);
        $("#isTelepon").val(tlp);
        $("#isLink").val(link);
        $("#isHarga").val(harga);
        $("#isPpn").val(ppn);
        $("#isKeterangan").val(ket);
        $("#isOngkos").val(ongkos);

        $('#mtSupplier').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function SmDeleteSupplier(id){
        console.log(id);
        $("#idSupplierHapus").val(id);

        $('#mHapusPic').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function SmSupplierPo(){
        //$("#isIdItem").val(id);
        $("#isPoId").val("");
        $("#isPoSupplier").val("");
        $("#isPoPic").val("");
        $("#isPoTelepon").val("");
        $("#isPoEmail").val("");
        $("#isPoPpn").val("");
        $("#isPoTop").val("");
        $("#isPoHarga").val("");
        $("#isPoOngkos").val("");
        $("#isKeterangan").val("");

        $('#mtPoSupplier').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function SmDeleteSupplierPo(id){
        console.log(id);
        $("#idSupplierPoHapus").val(id);

        $('#mHapusSupplierPo').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function SmEditSupplierPo(idItem, id, sup, pic, tlp, email, ppn, top, ongkos, harga, ket){
        $("#isIdItemPo").val(idItem);
        $("#isPoId").val(id);
        $("#isPoSupplier").val(sup);
        $("#isPoPic").val(pic);
        $("#isPoTelepon").val(tlp);
        $("#isPoEmail").val(email);
        $("#isPoPpn").val(ppn);
        $("#isPoTop").val(top);
        $("#isPoHarga").val(harga);
        $("#isPoOngkos").val(ongkos);
        $("#isKeteranganPo").val(ket);

        $('#mtPoSupplier').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function CheckChangePo(val, id, idItem){
        console.log(id);
        console.log(val);
        console.log(idItem);
        
        let formData = {
            idGoods: id,
            val: val,
            idItem: idItem
        };

        $.ajax({
            url: '/CheckedSupplierPo',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.code == "401") {
                    console.log(data.message);
                    alert(data.message);
                }
                else {
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert(error);
            }
        });
    }
    
    function CheckChangeLink(val, id, idItem){
        console.log(id);
        console.log(val);
        console.log(idItem);
        
        let formData = {
            idGoods: id,
            val: val,
            idItem: idItem
        };

        $.ajax({
            url: '/CheckedSupplierLink',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.code == "401") {
                    console.log(data.message);
                    alert(data.message);
                }
                else {
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert(error);
            }
        });
    }

    function ValidateData(){
        //const regno = $("#dtId").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log('1');

        ShowModalNextStage();
        // $.ajax({
        //     type:'GET',
        //     url: "ValidateRfq/"+regno,
        //     cache:false,
        //     contentType: false,
        //     processData: false,
        //     success: (Dt, textStatus, jqXHR) => {
        //         console.log(Dt);
        //         if (Dt == false) {
        //             alert("Lengkapi Semua Data!");
        //         }
        //         else {
        //             ShowModalNextStage()
        //         }
        //     },
        //     error: function(data){
        //         console.log(data);
        //     }
        // });
    }
    
    function ShowModalNextStage(){
        $('#mNext').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
</script>   

@endsection
