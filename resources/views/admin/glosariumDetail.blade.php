@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Detail Customer</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="row" style="font-size: 1.5rem">
            <div class="col-md-2">
                <table style="width: 100%"><tr><td>Code</td><td style="text-align: right;">:</td></tr></table>
            </div>
            <div class="col-md-10">{{ $glosariumData->Code }}</div>
        </div>
        <div class="row" style="font-size: 1.5rem;">
            <div class="col-md-2">
                <table style="width: 100%"><tr><td>Perusahaan</td><td style="text-align: right">:</td></tr></table>
            </div>
            <div class="col-md-10">{{ $glosariumData->Perusahaan }}</div>
        </div>
        <div class="row">
            <div class="col-md-12"  style="text-align: right">
                <hr>
                <button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="showModalEdit()">Edit</button>&nbsp;
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
                        {{-- <th scope="col">Code</th> --}}
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Alamat</th>
                        <th scope="col" style="text-align: center"><button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="showModalTambahAlamat()">Tambah</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alamatData as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            {{-- <td>{{ $data->CodeId }}</td> --}}
                            <td>{{ $data->Deskripsi }}</td>
                            <td style="white-space: nowrap;">{{ $data->Alamat }}</td>
                            <td style="text-align: center">
                                <button class="btn btn-sm btn-info" style="border-radius: 15px" onclick="showModalEditAlamat('{{ $data->id }}', '{{ $data->Deskripsi }}', '{{ $data->Alamat }}')">Edit</button>
                                <button class="btn btn-sm btn-danger" style="border-radius: 15px" onclick="showModalDeleteAlamat('{{ $data->id }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
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
                        <th scope="col">Nama Pic</th>
                        <th scope="col">No Telepon</th>
                        <th scope="col" style="text-align: center"><button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="showModalTambahPic()">Tambah</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($picData as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            {{-- <td>{{ $data->CodeId }}</td> --}}
                            <td>{{ $data->Nama }}</td>
                            <td>{{ $data->NoTelepon }}</td>
                            <td style="text-align: center">
                                <button class="btn btn-sm btn-info" style="border-radius: 15px" onclick="showModalEditPic('{{ $data->id }}', '{{ $data->Nama }}', '{{ $data->NoTelepon }}')">Edit</button>
                                <button class="btn btn-sm btn-danger" style="border-radius: 15px" onclick="showModalDeletePic('{{ $data->id }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="alert alert-danger mt-3" style="border-radius: 25px">
    <a href="#" onclick="showModalHapus()">Hapus Data Customer</a>
</div>

{{-- Modal Edit --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mEdit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/EditGlosarium" method="post">
                @csrf
                <input type="text" value="{{ $glosariumData->id }}" name="Id" hidden />
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

{{-- Modal Tambah Alamat --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mTambahAlamat">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/InsertAlamatGlosarium" method="post">
                @csrf
                <input type="text" class="form-control" name="Id" id="idAlamat" hidden>
                <input type="text" value="{{ $glosariumData->Code }}" name="Code" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Data Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Deskripsi <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="Head Office" id="deskripsiAlamat" name="Deskripsi" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alamat <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="Jakarta Barat" id="detailAlamat" name="Alamat" required>
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

{{-- Modal Hapus Alamat --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mHapusAlamat">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeleteAlamatGlosarium" method="post">
                @csrf
                <input type="text" name="Id" id="idAlamatHapus" hidden />
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

{{-- Modal Tambah PIC --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mTambahPic">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/InsertPicGlosarium" method="post">
                @csrf
                <input type="text" class="form-control" name="Id" id="idPic" hidden>
                <input type="text" value="{{ $glosariumData->Code }}" name="Code" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Data PIC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Nama PIC <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="Nama" id="picNama" name="Nama" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>No Telepon <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="+62 081xxxxxx" id="picNoTlp" name="NoTelepon" required>
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

{{-- Modal Hapus PIC --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mHapusPic">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeletePicGlosarium" method="post">
                @csrf
                <input type="text" name="Id" id="idPicHapus" hidden />
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

{{-- Modal Hapus Glosarium --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mHapus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeleteGlosarium" method="post">
                @csrf
                <input type="text" value="{{ $glosariumData->id }}" name="Id" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <p style="color: black">Apakah anda yakin akan menghapus data?</p>
                    <b style="color: crimson">Semua data customer dan alamat akan dihapus PERMANEN</b>
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
    function showModalEdit(){
        $('#mEdit').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function showModalHapus(){
        $('#mHapus').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function showModalTambahAlamat(){
        $("#idAlamat").val();
        $("#deskripsiAlamat").val();
        $("#detailAlamat").val();
        $('#mTambahAlamat').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function showModalEditAlamat(id, des, alamat){
        $("#idAlamat").val(id);
        $("#deskripsiAlamat").val(des);
        $("#detailAlamat").val(alamat);
        $('#mTambahAlamat').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function showModalDeleteAlamat(id){
        $("#idAlamatHapus").val(id);
        $('#mHapusAlamat').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function showModalTambahPic(){
        $("#idPic").val();
        $("#picNama").val();
        $("#picNoTlp").val();
        $('#mTambahPic').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function showModalEditPic(id, des, alamat){
        $("#idPic").val(id);
        $("#picNama").val(des);
        $("#picNoTlp").val(alamat);
        $('#mTambahPic').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function showModalDeletePic(id){
        $("#idPicHapus").val(id);
        $('#mHapusPic').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>    
@endsection
