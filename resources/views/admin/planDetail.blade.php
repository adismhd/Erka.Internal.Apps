
@extends('layout.admin')

@section('container')

<div class="mt-4">
    <h1>Plan</h1>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-striped table-sm" style="">
                <tbody>
                   <tr><td>Expected Profit</td><td>:</td><td>{{ isset($planDt->ExpectedProfit) ?  $planDt->ExpectedProfit  : '0' }} %</td></tr>
                   <tr><td>Discount</td><td>:</td><td>{{ isset($planDt->Discount) ?  $planDt->Discount  : '0' }} %</td></tr>
                </tbody>
                <tfoot>
                   <tr><td></td><td></td><td style="width: 20%; text-align: right; "><button class="btn btn-sm btn-primary" onclick="SmEditPlan()">Edit</button></td></tr>
                </tfoot>
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
                        <th scope="col">Goods Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Capital Price</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Expected Profit</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Price After</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planItem as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ isset($data->IG->Nama) ?  $data->IG->Nama  : '' }}</td>
                            <td>{{ isset($data->Qty) ?  number_format($data->Qty)  : '0' }}</td>
                            <td>{{ isset($data->Harga) ?  number_format($data->Harga)  : '0' }}</td>
                            <td>{{ number_format($data->TotalHarga) }}</td>
                            <td>{{ number_format($data->Harga + ($data->Harga * ($planDt->ExpectedProfit / 100))) }}</td>
                            <td>{{ number_format(($data->Harga + ($data->Harga * ($planDt->ExpectedProfit / 100))) * $data->Qty) }}</td>
                            <td>{{ number_format($data->Harga * ($planDt->Discount / 100)) }}</td>
                            <td>{{ number_format($data->Harga - ($data->Harga * ($planDt->Discount / 100))) }}</td>
                            <td>{{ number_format(($data->Harga - ($data->Harga * ($planDt->Discount / 100))) * $data->Qty) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Supplier Po --}}
<div class="modal" id="mPlan">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="/SavePlan" method="post">
                @csrf
                <input type="text" value="{{ $aplikasiDt->Regno }}" name="Regno" hidden/>
                <div class="modal-header">
                    <h5 class="modal-title">Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label>Expected Profit <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="ExpectedProfit" id="inExpectedProfit" value="{{ isset($planDt->ExpectedProfit) ?  $planDt->ExpectedProfit  : '0' }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Discount <i style="color: crimson">*</i></label>
                        <input type="number" class="form-control" name="Discount" id="inDiscount" value="{{ isset($planDt->Discount) ?  $planDt->Discount  : '0' }}" required>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>


<input type="text" value="{{ $aplikasiDt->Regno }}" id="dtId" hidden/>

<script type="text/javascript">
    function SmEditPlan(){
        $('#mPlan').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>    
@endsection
