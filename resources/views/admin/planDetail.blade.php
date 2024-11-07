
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
                            <td>{{ number_format($data->Profit) }}</td>
                            <td>{{ number_format($data->TotalProfit) }}</td>
                            <td>{{ number_format($data->Discount) }}</td>
                            <td>{{ number_format($data->HargaDiscount) }}</td>
                            <td>{{ number_format($data->TotalHargaDiscount) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td colspan="3">Total Capital Price</td>
                        <td colspan="6">{{ number_format($TotalCapitalPrice) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">Expected Delivery Cost </td>
                        <td colspan="6">{{ number_format($ExpectedDeliveryCost) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">Expected Operational Cost  </td>
                        <td colspan="6">{{ number_format($ExpectedOperationalCost) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">Total Capital Needs</td>
                        <td colspan="6">{{ number_format($TotalCapitalNeeds) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="8">Total Order Value Exclude Vat 11%</td>
                        <td colspan="1">{{ number_format($TotalOrderValueExcludeVat) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="8">Vat 11%</td>
                        <td colspan="1">{{ number_format($Vat11) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="8">Total Order Value Include Vat 11%</td>
                        <td colspan="1">{{ number_format($TotalOrderValueIncludeVat) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="card mt-3" style="border-radius: 25px">    
    <div class="card-header" style="border-top-left-radius: 25px; border-top-right-radius: 25px;">
        <h5>Goods Tax</h5>    
    </div> 
    <div class="card-body" >
        <div class="table-responsive" style="border-radius: 15px;">
            <table class="table table-striped table-sm" style="">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">Goods Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Custom Case Vat 11%</th>
                        <th scope="col">Vat 11% Value </th>
                        <th scope="col">Total Vat Item </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planItem as $data)
                        <tr class="" >
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ isset($data->IG->Nama) ?  $data->IG->Nama  : '' }}</td>
                            <td>{{ isset($data->Qty) ?  number_format($data->Qty)  : '0' }}</td>
                            <td>{{ number_format($data->CustomCaseVat) }}</td>
                            <td>{{ number_format($data->Vat) }}</td>
                            <td>{{ number_format($data->TotalVatItem) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td colspan="4">Tax Goods </td>
                        <td colspan="1">{{ number_format($TaxGoods) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">Tax Project </td>
                        <td colspan="1">{{ number_format($Vat11) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">Tax Payable </td>
                        <td colspan="1">{{ number_format($TaxPayable) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">Tax Restitution </td>
                        <td colspan="1">{{ number_format($TaxGoods) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mt-3" style="border-radius: 25px">    
            <div class="card-header" style="border-top-left-radius: 25px; border-top-right-radius: 25px;">
                <h5>Price After With Drawl</h5>    
            </div> 
            <div class="card-body" >
                <div class="table-responsive" style="border-radius: 15px;">
                    <table class="table table-striped table-sm" style="">
                        <thead class="table-dark">
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>PPH Final (1%)</td>
                                <td>{{ number_format($PPHFinal) }}</td>
                            </tr>
                            <tr>
                                <td>Cost Of Money (2,5%)</td>
                                <td>{{ number_format($CostOfMoney) }}</td>
                            </tr>
                            <tr>
                                <td>Relation A (3%)</td>
                                <td>{{ number_format($RelationA) }}</td>
                            </tr>
                            <tr>
                                <td>Relation B </td>
                                <td>{{ number_format($RelationB) }}</td>
                            </tr>
                            <tr>
                                <td>Relation C</td>
                                <td>{{ number_format($RelationC) }}</td>
                            </tr>
                            <tr>
                                <td>Risk</td>
                                <td>{{ number_format($Risk) }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>{{ number_format($Total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </div>
        
    <div class="col-md-6">
        <div class="card mt-3" style="border-radius: 25px">    
            <div class="card-header" style="border-top-left-radius: 25px; border-top-right-radius: 25px;">
                <h5>Budgeting analysis</h5>    
            </div> 
            <div class="card-body" >
                <div class="table-responsive" style="border-radius: 15px;">
                    <table class="table table-striped table-sm" style="">
                        <thead class="table-dark">
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gross Profit </td>
                                <td>{{ number_format($GrossProfit) }}</td>
                            </tr>
                            <tr>
                                <td>Net Profit (No Risk + No Rest) A</td>
                                <td>{{ number_format($NetProfitA) }}</td>
                            </tr>
                            <tr>
                                <td>Net Profit (Incl Risk + No Rest) B</td>
                                <td>{{ number_format($NetProfitB) }}</td>
                            </tr>
                            <tr>
                                <td>Net Profit (incl Risk + Incl Rest) C</td>
                                <td>{{ number_format($NetProfitC) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="alert btn-info mt-3" style="border-radius: 25px; text-align: center" onclick="SmGOL()">
    <a href="#"><i class="fa-regular fa-file"></i> &nbsp; Generate Dokumen Offering Letter</a>
</div>

<div class="alert btn-info mt-3" style="border-radius: 25px; text-align: center" onclick="SmGOL()">
    <a href="#"><i class="fa-regular fa-file"></i> &nbsp; Generate Dokumen Purchase Order</a>
</div>

@if($wfApp->WorkflowCurrentCodeId == 'PL')
    <div class="alert btn-primary mt-3" style="border-radius: 25px; text-align: center" onclick="ValidateData()">
        <a href="#">Lanjutkan Data Ke Supplier</a>
    </div>
@endif

{{-- Modal Plan --}}
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>            
        </div>
    </div>
</div>

{{-- Modal Generate Dokumen OL --}}
<div class="modal" id="mGOL">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/asd" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Generate </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" value="{{ $aplikasiDt->Regno }}" name="Regno" hidden />
                    <div class="input-group">
                        <select class="form-control" id="scPT" name="ptInduk">
                            <option value="">-- Pilih --</option>
                            @foreach ($perusahaanList as $data)
                                <option value="{{ $data->Code }}">{{ $data->Nama }}</option>
                            @endforeach
                        </select> &nbsp;
                        <button type="submit" class="btn btn-success">Generate</button>
                    </div>
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
    
    function SmGOL(){
        $('#mGOL').modal({
            show: true,
            backdrop: 'static'
        });
    }
</script>    
@endsection
