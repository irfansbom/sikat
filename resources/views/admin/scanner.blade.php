@extends('layout/main')
@section('title', 'Scanner')
@section('container')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
</script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script> --}}
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> --}}

<body>
    <div class="container mx-auto my-5" style="min-height: 37em">
        {{-- <div id="message" style="position:  ">
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Success! </strong> Product have added to your wishlist.
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-7">
                <video id="preview" width="100%"></video>
            </div>
            <div class="col-md-5">
                <label>Pilih Kamera</label>
                <select class="custom-select" id="inputGroupSelect01">

                </select>
                <label>QR CODE</label>
                <input type="text" name="text" id="text" readonly="" placeholder="QRCode Scanned" class="form-control">
            </div>
        </div>
    </div>

</body>

<div class="position-fixed" style="z-index: 5; top: 0; right:0; margin-right: 50px; margin-top:50px">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"
        style=" background-color: rgb(11, 146, 11);">
        <div class="toast-header">
            <strong class="mr-auto"><i id="icon" class="fas fa-thumbs-up"> </i> Info Scanner</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="info" class="toast-body" style=" background-color: rgb(214, 245, 214);">
        </div>
    </div>
</div>

<script>
    $( ".scanner" ).addClass("active");
    $( document ).ready(function() {
        $("#success-alert").hide();
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0 ){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }
            a = ""
            let i = 0;
            cameras.forEach(element => {
                console.log(element)
                a += '<option  data-id="'+i+'">' + element.name +'</option>'
                i++
            });
                $('.custom-select').html(a)
                $('.custom-select').change(function() {
                    console.log($('.custom-select').find(":selected").data('id'));
                    scanner.start(cameras[$('.custom-select').find(":selected").data('id')]);
                })
        }).catch(function(e) {
            // console.error(e);
        });

        scanner.addListener('scan',function(c){


            $.ajax({
                type: "POST",
                url: "{{ url('scanner/scannedqr') }}",
                data: {  _token: "{{ csrf_token() }}", qrcode:c },
                dataType: "json",
                success: function(feedback) {
                    console.log(feedback)
                    if(feedback == 1 ){
                        document.getElementById('text').value=c;
                        $("#icon").removeClass("fa-thumbs-down");
                        $("#icon").addClass("fa-thumbs-up");
                        $('#liveToast').css("background-color", "rgb(11, 146, 11)");
                        $('#info').css("background-color", "rgb(214, 245, 214)");
                        $('#info').html(c+' berhasil discan')
                        $('.toast').toast('show')
                    }else{
                        document.getElementById('text').value=c;
                        $("#icon").removeClass("fa-thumbs-up");
                        $("#icon").addClass("fa-thumbs-down");
                        $('#info').html(c+' tidak ditemukan')
                        $('#liveToast').css("background-color", "rgb(237, 18, 14)");
                        $('#info').css("background-color", "rgb(247, 174, 173)");
                        $('.toast').toast('show')
                    }
                }
            });

            
        });

        // $('#text').change(function(){
        //     $('.alert').alert()
        // })
        // $('.custom-select').change(function() {
        //     console.log($('.custom-select').find(":selected").data('id'));
        //     scanner.start(cameras[$('.custom-select').find(":selected").data('id')]);
        // })
    })
</script>

</html>
@endsection