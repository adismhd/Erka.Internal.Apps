@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>List Parameter</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <h3 class="mb-3">Author</h3>
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-striped table-sm" style="">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">No Telepon</th>
                        <th scope="col" style="text-align: center"><button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="smAuthorTambah()">Tambah</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authorList as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $data->Nama }}</td>
                            <td>{{ $data->Jabatan }}</td>
                            <td>{{ $data->NoTelepon }}</td>
                            <td  style="text-align: center">
                                <button class="btn btn-sm btn-info" style="border-radius: 15px" 
                                onclick="smAuthorEdit('{{ $data->id }}','{{ $data->Nama }}','{{ $data->Jabatan }}','{{ $data->NoTelepon }}')">Edit</button>
                                <button class="btn btn-sm btn-danger" style="border-radius: 15px" 
                                onclick="smAuthorHapus('{{ $data->id }}')">Hapus</button>
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
        <h3 class="mb-3">Perusahaan</h3>
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-striped table-sm" style="">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Alamat</th>
                        <th scope="col" style="text-align: center"><button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="smPerusahaanTambah()">Tambah</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perusahaanList as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $data->Code }}</td>
                            <td>{{ $data->Nama }}</td>
                            <td>{{ $data->Deskripsi }}</td>
                            <td>{{ $data->Alamat }}</td>
                            {{-- <td>{{ $data->InstructionNotes }}</td> --}}
                            <td  style="text-align: center">
                                <button class="btn btn-sm btn-info" style="border-radius: 15px" 
                                onclick="smPerusahaanEdit('{{ $data->id }}','{{ $data->Nama }}','{{ $data->Code }}','{{ $data->Deskripsi }}', '{{ $data->Alamat }}')">Edit</button>
                                <button class="btn btn-sm btn-danger" style="border-radius: 15px" 
                                onclick="smPerusahaanHapus('{{ $data->id }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Author --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mAuthor">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="AddAuthor" method="post">
                @csrf
                <input type="text" id="iAuthorId" name="Id" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Author Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Nama <i style="color: crimson">*</i></label>
                        <input type="text" id="iAuthorNama" class="form-control" placeholder="Nama" name="Nama" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Jabatan <i style="color: crimson">*</i></label>
                        <input type="text" id="iAuthorJabatan" class="form-control" placeholder="Manager" name="Jabatan" required>
                    </div>        
                    <div class="col-md-12 mb-3">
                        <label>No Telepon<i style="color: crimson">*</i></label>
                        <input type="number" id="iAuthorNoTelepon" class="form-control" placeholder="085xxxxxx" name="NoTelepon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mAuthorHapus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeleteAuthor" method="post">
                @csrf
                <input type="text" name="Id" id="iAuthorIdDelete" hidden />
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

{{-- Modal Perusahaan --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mPerusahaan">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="AddPerusahaan">
                @csrf
                <input type="text" id="iPerusahaanId" name="Id" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Perusahaan Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Code <i style="color: crimson">*</i></label>
                        <input type="text" id="iPerusahaanCode" class="form-control" placeholder="NPK" name="Code" required>
                    </div> 
                    <div class="col-md-12 mb-3">
                        <label>Nama <i style="color: crimson">*</i></label>
                        <input type="text" id="iPerusahaanNama" class="form-control" placeholder="PT. Nama Perusahaan" name="Nama" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Deskripsi <i style="color: crimson">*</i></label>
                        <input type="text" id="iPerusahaanDeskripsi" class="form-control" placeholder="Perushaan Minyak" name="Deskripsi" required>
                    </div> 
                    <div class="col-md-12 mb-3">
                        <label>Alamat <i style="color: crimson">*</i></label>
                        <input type="text" id="iPerusahaanAlamat" class="form-control" placeholder="Jakarta Selatan" name="Alamat" required>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mPerusahaanHapus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/DeletePerusahaan" method="post">
                @csrf
                <input type="text" name="Id" id="iPerusahaanIdDelete" hidden />
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
    function smAuthorTambah(){
        $('#iAuthorId').val();
        $('#iAuthorNama').val();
        $('#iAuthorJabatan').val();
        $('#iAuthorNoTelepon').val();
        $('#mAuthor').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function smAuthorEdit(id, nama, jabatan, tlp){
        $('#iAuthorId').val(id);
        $('#iAuthorNama').val(nama);
        $('#iAuthorJabatan').val(jabatan);
        $('#iAuthorNoTelepon').val(tlp);
        $('#mAuthor').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function smAuthorHapus(id){
        $('#iAuthorIdDelete').val(id);
        $('#mAuthorHapus').modal({
            show: true,
            backdrop: 'static'
        });
    }
    
    function smPerusahaanTambah(){
        $('#iPerusahaanId').val();
        $('#iPerusahaanCode').val();
        $('#iPerusahaanNama').val();
        $('#iPerusahaanDeskripsi').val();
        $('#iPerusahaanAlamat').val();
        $('#mPerusahaan').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function smPerusahaanEdit(id, nama, code, des, alamat){
        $('#iPerusahaanId').val(id);
        $('#iPerusahaanCode').val(code);
        $('#iPerusahaanNama').val(nama);
        $('#iPerusahaanDeskripsi').val(des);
        $('#iPerusahaanAlamat').val(alamat);
        $('#mPerusahaan').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function smPerusahaanHapus(id){
        $('#iPerusahaanIdDelete').val(id);
        $('#mPerusahaanHapus').modal({
            show: true,
            backdrop: 'static'
        });
    }

    $(document).ready(function() {
        $('#AddPerusahaan').on('submit', function(event) {
            event.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: '/AddPerusahaan',
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
        });
    });
</script>    
@endsection
