@extends('layout/main')

@section('title', 'Admin Dashboard')

@section('container')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body class="">
    <section class="py-2">
        <div class="container border rounded">
            <div id="content" class="row">
                <div class="col-md-3" style="border-right: 1px solid rgb(199, 199, 199);">
                    <div class="m-2" style=" ">
                        <div class="border rounded alert alert-success text-center">Kode Terakhir
                            <b id='last_qr'>{{ $qrcode_last['qrcode'] ?? ''}}</b>
                        </div>
                        <h4>Opsi</h4>
                        <div>
                            <label>Masukkan QR CODE</label>
                            <textarea id="qrcode" name="qrcode" style="width:  -webkit-fill-available;"></textarea>
                            <button id="prs_btn" class="btn btn-success" onclick="proses()">Proses</button>
                        </div>
                        <div>
                            <b>*Note</b>
                            <br>

                            Isi dengan 5 angka setelah kode QR, gunakan tanda "-" untuk jumlah lebih dari 1
                            <br>
                            contoh :
                            <ul class="">
                                <li>QR00001</li>
                                <li>QR00001-QR00030</li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="m-2 border rounded">
                        <div class="container">Preview</div>
                        <div id="pdf_plc" class="row p-3 text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection

@section('script')
<script>
    $( ".qrcode" ).addClass("active");
    function proses(){
        var code = $('#qrcode').val()
        // $.get( "qrcode/createqr/"+code, function( data ) {
            
        // });
        $.get({
            method: 'GET',
            url: 'qrcode/createqr',
            headers: {
                'Content-Type': 'application/json',
            },
            // query parameters go under "data" as an Object
            data: {
                qrcode: code
            },
            success: function(msg){
                console.log(msg)
                $('#last_qr').html(msg)
                $('#pdf_plc').html("<iframe src='../public/QRCODES/qrcodecetak.pdf'style='width:600px; height:500px; margin:auto' frameborder='0'></iframe>")
            }   
        })
    }
</script>
@endsection

@section('style')
<style>
    #content {
        min-height: 40em
    }
</style>
@endsection