
@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Detail Document Goods</h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mt-3" style="border-radius: 25px">  
            <div class="card-header" style="border-top-right-radius: 25px; border-top-left-radius: 25px">
                <h4>Customer Information</h4>
            </div>  
            <div class="card-body" >
                <div class="table-responsive">
                    <table style="width: 100%">
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Company</td style="width: 1%"><td> : </td>
                            @if(isset($aplikasiDt->Customers->Perusahaan))
                                <td>{{ $aplikasiDt->Customers->Perusahaan }}</td>
                            @else
                                <td>$aplikasiDt->Customers->Perusahaan</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">PIC</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->PicCustomer->Nama))
                                <td>{{ $dgDt->PicCustomer->Nama }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">No. Telepon</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->PicCustomer->NoTelepon))
                                <td>{{ $dgDt->PicCustomer->NoTelepon }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Date Doc</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->created_at))
                                <td>{{ $dgDt->created_at }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Source Docs </td style="width: 1%"><td> : </td><td></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Invoicing To</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->AlamatInvoice->Alamat))
                                <td>{{ $dgDt->AlamatInvoice->Alamat }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-footer" style="border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; text-align: right">
                <button class="btn-success btn" onclick="smEditCI()">Edit</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mt-3" style="border-radius: 25px">  
            <div class="card-header" style="border-top-right-radius: 25px; border-top-left-radius: 25px">
                <h4>Recipient Information</h4>
            </div>  
            <div class="card-body" >
                <div class="table-responsive">
                    <table style="width: 100%">
                        <tr>
                            <td style="white-space: nowrap; width: 35%">PIC</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->PicRecipient->Nama))
                                <td>{{ $dgDt->PicRecipient->Nama }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">No. Telepon</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->PicRecipient->NoTelepon))
                                <td>{{ $dgDt->PicRecipient->NoTelepon }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Email</td style="width: 1%"><td> : </td><td></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Estitmated Time</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->EstimasiTime))
                                <td>{{ $dgDt->EstimasiTime }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Estimated Date</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->EstimasiDate))
                                <td>{{ $dgDt->EstimasiDate }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="white-space: nowrap; width: 35%">Delivery To</td style="width: 1%"><td> : </td>
                            @if(isset($dgDt->AlamatDelivery->Alamat))
                                <td>{{ $dgDt->AlamatDelivery->Alamat }}</td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-footer" style="border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; text-align: right">
                <button class="btn-success btn" onclick="smEditRI()">Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="mb-4 row">
            <div class="col-md-6">
                <table style="width: 100%">
                    <tr><td style="width: 35%">Input Date</td><td>{{ $dgDt->created_at }}</td></tr>
                    <tr><td style="width: 35%">Authors</td><td>{{ $aplikasiDt->Author->Nama }}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <table style="width: 100%">
                    <tr><td style="width: 35%">Authors Contact</td><td>{{ $aplikasiDt->Author->NoTelepon }}</td></tr>
                    <tr><td style="width: 35%">Jabatan</td><td>{{ $aplikasiDt->Author->Jabatan }}</td></tr>
                </table>
            </div>
        </div>
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
                        <th scope="col" style="text-align: center"><button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="smTambahDG()">Tambah</button></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($alamatData as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $data->Deskripsi }}</td>
                            <td style="white-space: nowrap;">{{ $data->Alamat }}</td>
                            <td style="text-align: center">
                                <button class="btn btn-sm btn-info" style="border-radius: 15px" onclick="smEditDG('{{ $data->id }}', '{{ $data->Deskripsi }}', '{{ $data->Alamat }}')">Edit</button>
                                <button class="btn btn-sm btn-danger" style="border-radius: 15px" onclick="smDeleteDG('{{ $data->id }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Customer Information --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mtCI">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/EditCustomerInformation" method="post">
                @csrf
                <input type="text" value="{{ $dgDt->id }}" name="Id" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Data Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>PIC <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="Pic" id="sCiPic">
                            @foreach ($picList as $data)
                                <option value="{{ $data->id }}">{{ $data->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alamat Invoicing <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="Alamat" id="sCiAlamat">
                            @foreach ($alamatList as $data)
                                <option value="{{ $data->id }}">{{ $data->Alamat }}</option>
                            @endforeach
                        </select>
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

{{-- Modal Recipient  Information --}}
<div class="modal fade" tabindex="-1" role="dialog" id="mtRI">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/EditRecipientInformation" method="post">
                @csrf
                <input type="text" value="{{ $dgDt->id }}" name="Id" hidden />
                <div class="modal-header">
                    <h5 class="modal-title">Data Recipient Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>PIC <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="Pic" id="sCiPic">
                            @foreach ($picList as $data)
                                <option value="{{ $data->id }}">{{ $data->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alamat Delivery <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="Alamat" id="sCiAlamat">
                            @foreach ($alamatList as $data)
                                <option value="{{ $data->id }}">{{ $data->Alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Estitmated Time <i style="color: crimson">*</i></label>
                        <input type="time" class="form-control" name="eTime">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Estitmated Date <i style="color: crimson">*</i></label>
                        <input type="date" class="form-control" name="eDate">
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
    function smEditCI(){
        $('#mtCI').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function smEditRI(){
        $('#mtRI').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>    
@endsection
