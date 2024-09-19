@extends('layout.main')

@section('container')
<div style="height: 70vh">
    <div class="mt-1" >
        <h1 class="mt-5" >Login</h1>
    </div>
    <div class="card mt-4" style="border-radius: 25px">
        <div class="card-body m-3">
            <form class="mt-3" action="LoginCheck" method="post">
                @csrf
                <div class="form-group mt-3">
                    <label for="emailUser">Email address</label>
                    <input type="email" name="Email" class="form-control" required aria-describedby="emailHelp" placeholder="email@domain.com">
                </div>
                <div class="form-group mt-3">
                    <label for="passUser">Password</label>
                    <input type="password" name="Password" class="form-control" required id="passUser" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success mt-3">Login</button>
            </form>
        </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title">Gagal Login!</h5> --}}
                    <h5 class="modal-title">Username atau Password tidak ditemukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    @isset($loginstatus) 
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#myModal').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
        </script>
    @endisset
</div>

@endsection