
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
            <table class="table table-striped table-sm" style="">
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
                        <input type="number" class="form-control" name="Ppn" id="isPpn" required>
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

</script>   

@endsection
