<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>ErkaXpress | {{ $title }}</title> --}}
    <title>ErkaInternal | </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
        
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>    
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> --}}
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cf59e3b8b5.js" crossorigin="anonymous"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body  style="background-color:  #f6f6f6">
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <h1>Erka Internal<span>.</span></h1>
            </a>
            {{-- <a href="/" style="border-radius: 25px" class="btn btn-danger">Home</a> --}}
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header>

    <div class="container">
        @yield('container')
    </div>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span>Address</span>
                    </a>
                    <p> Jln. Kebagusan Raya Gang puskesmas RT 07 RW 01 NO 18 Kel Kebagusan kec. Pasar Minggu</p>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->
    <!-- End Footer -->
        
    <div class="modal" tabindex="-1" role="dialog" style="overflow-y: auto;" id="modalLoading">
        <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header box-header with-border">
                    <h3 class="box-title">Please Wait</h3>
                </div>
                <div class="modal-body" style="text-align:center">
                    <img src="{{ asset('img/loading.gif') }}" />
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/mainJs.js') }}"></script>
<script>
    function ShowLoading(){
        $('#modalLoading').modal({
            show: true,
            backdrop: 'static'
        });
    }

    function HideLoading(){
        $('#modalLoading').modal("hide");
    }
</script>
</html>
