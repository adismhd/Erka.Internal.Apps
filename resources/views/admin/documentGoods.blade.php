@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>List Document Goods</h1>
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
                        <th scope="col" style="text-align: center"><button class="btn btn-sm btn-primary" style="border-radius: 15px" onclick="showModalTambah()">Tambah</button></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inboxList as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $data->Regno }}</td>
                            <td>{{ $data }}</td>
                            <td>{{ $data->customers->Perusahaan }}</td>
                            <td  style="text-align: center"><a href="DetailGlosarium/{{ $data->Regno }}" class="btn btn-sm btn-info"  style="border-radius: 15px" >Detail</a></td>
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
            <form action="InsertGlosarium" method="post">
                @csrf
                {{-- <input type="text" value="{{ $NoPesanan }}" name="NoPesanan" hidden /> --}}
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Code <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="PCNI" name="Code" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Perusahaan <i style="color: crimson">*</i></label>
                        <input type="text" class="form-control" placeholder="PT. Nama Perusahaan" name="Perusahaan" required>
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
