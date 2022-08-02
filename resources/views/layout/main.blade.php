<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- boostrap --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    {{-- datatables --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>
    {{-- jquery validate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous">
    </script>
    {{-- sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #117a8b">
        <a class="navbar-brand"><img alt="SIKAT" src="{{asset('/pictures/SiKat1.png')}}" width="100" height="30"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item katalog">
                    <a class="nav-link" href="{{url('katalog')}}">Katalog</a>
                </li>
                <li class="nav-item beranda">
                    <a class="nav-link" href="{{url('tentang')}}">Tentang </a>
                </li>
                @if(session('username'))
                <li class="nav-item admin">
                    <a class="nav-link" href="{{url('admin')}}">List Publikasi</a>
                </li>
                <li class="nav-item qrcode">
                    <a class="nav-link" href="{{url('qrcode')}}">Cetak QR Code </a>
                </li>
                <li class="nav-item scanner">
                    <a class="nav-link" href="{{url('scanner')}}">Scan QR Code </a>
                </li>
                @endif
                @if(!session('username'))
                <li class="nav-item bpsri">
                    <a class="nav-link" href="https://www.bps.go.id">BPS RI </a>
                </li>
                <li class="nav-item bpssumsel">
                    <a class="nav-link" href="https://sumsel.bps.go.id/">BPS Sumsel </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#117a8b">
                        <a class="dropdown-item text-white-50" href="{{url('admin')}}">Admin</a>
                    </div>
                </li>
                @endif


            </ul>
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <p class="small text-center m-0 font-italic small font-weight-bold text-white">AYO BANTU ISI</p>
                    <a class="nav-link mr-sm-2 small " style="padding:0" href="http://s.bps.go.id/SKK2021">
                        Survei Kepuasan Pengunjung
                    </a>
                </li>
                @if(session('username'))
                <li class="nav-item ">
                    <a class="nav-link mr-sm-2 " href="{{url('logout')}}">logout<i class="bi bi-door-open"></i></a>
                </li>
                @endif
            </ul>


        </div>
    </nav>

    @yield('container')
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>BPS Provinsi Sumatera Selatan</span></strong>.
            </div>
            <div class="credits">
                Designed by <a href="" style=" color: #43aea0;">BOMBOM ART</a>
            </div>
        </div>
    </footer>
</body>

</html>
@yield('style')
@yield('script')
<style>
    /*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
    #footer {
        background: #117a8b;
        padding: 30px 0;
        color: #fff;
        font-size: 14px;
        /* position: fixed;
        bottom: 0; */
        /* width: -webkit-fill-available; */
    }

    #footer .copyright {
        text-align: center;
    }

    #footer .credits {
        padding-top: 10px;
        text-align: center;
        font-size: 13px;
        color: #fff;
    }
</style>