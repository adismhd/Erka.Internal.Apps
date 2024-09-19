@extends('layout.admin')

@section('container')
    <div class="mt-4">
        <h1>Glosarium</h1>
    </div>

    <div class="card mt-3" style="border-radius: 25px">    
        <div class="card-body" >
            <div class="table-responsive" style="border-radius: 15px;">
                <table class="table table-striped table-sm" style="">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="text-align: center">No</th>
                            <th scope="col">Code</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col">Pic</th>
                            <th scope="col">NoTelepon</th>
                            <th scope="col" style="text-align: right"><a href="DetailPesanan/" class="btn btn-sm btn-info" style="border-radius: 15px">Tambah</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($glosariumList as $data)
                            <tr class="" >
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->Code }}</td>
                                <td>{{ $data->Perusahaan }}</td>
                                <td>{{ $data->Pic }}</td>
                                <td>{{ $data->NoTelepon }}</td>
                                <td><a href="DetailPesanan/{{ $data->Code }}" class="btn btn-sm btn-primary">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
