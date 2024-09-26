
@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Detail Document Goods</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mTambah">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="InsertDocumentGoods" method="post">
                @csrf
                <div></div>
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
