@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>List Request For Quotation</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-striped table-sm" style="">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">Regno</th>
                        <th scope="col">Author</th>
                        <th scope="col">Perusahaan</th>
                        <th scope="col">Create At</th>
                        <th scope="col" style="text-align: center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inboxList as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $data->Regno }}</td>
                            <td>{{ isset($data->author->Nama) ?  $data->author->Nama  : '' }}</td>
                            <td>{{ isset($data->customers->Perusahaan) ?  $data->customers->Perusahaan  : '' }}</td>
                            <td>{{ isset($data->created_at) ?  $data->created_at  : '' }}</td>
                            <td  style="text-align: center"><a href="DetailRfq/{{ $data->Regno }}" class="btn btn-sm btn-info"  style="border-radius: 15px" >Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mTambah">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="InsertDocumentGoods" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Author <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="Author" id="sAuthor">
                            {{-- @foreach ($authorList as $data)
                                <option value="{{ $data->id }}">{{ $data->Nama }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Perusahaan <i style="color: crimson">*</i></label>
                        <select class="form-select form-control" name="PerusahaanData" id="sPerusahaan">
                            {{-- @foreach ($perusahaanList as $data)
                                <option value="{{ $data->Code }}">{{ $data->Perusahaan }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<script type="text/javascript">
    function showModalTambah(){
        $('#mTambah').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>    
@endsection
