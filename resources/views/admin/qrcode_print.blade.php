<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    {{-- <meta charset="UTF-8"> --}}
    <style type="text/css">
        * {
            font-family: Segoe UI, Arial, sans-serif;
            font-size: 12px
        }

        body {
            margin: 20px
        }

        * {
            margin: 0;
            padding: 0
        }
    </style>

    {{-- <link rel="stylesheet" href="{!! asset('lucid/assets/vendor/bootstrap/css/bootstrap.min.css') !!}"> --}}

</head>

<body style="padding: 0px">
    {{-- <div class="container"> --}}
    {{-- {{ $data[0] }} --}}
    <table style="text-align: center; margin:0px">
        <?php $jumlahperline = 6; ?>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
        <?php if ($i % $jumlahperline == 0) {
                    echo '<tr style="margin-left:0px;">';
                } ?>
        <td style="padding: 0">
            <div text-align="center" style="border: 3px solid black; border-radius:20px; padding:10px;">
                <?php $path = url('/QRCODES/' . $data[$i] . '.png')?>
                <img src="{{ $path }}" style="border-radius:1px;width: 2.5cm; "><br style="">
                <div text-align="center" style="margin-top:10px">
                    <b><?php echo $data[$i]; ?></b>
                </div>
            </div>
        </td>
        <?php if ($i % $jumlahperline == $jumlahperline - 1) {
                    echo '</tr>';
                } ?>
        <?php
            } ?>

        {{-- <tr>
                <td style="padding:2px; text-align:center">
                    <img src='../public/QRCODES/{{$data[0]}}.png'>
        <br>
        {{ $data[0] }}
        </td>
        </tr> --}}
        {{-- {{ $data }} --}}
        {{-- {{ $index }} --}}
        {{-- <div class='' style='max-width:100px; border: 2px solid gray;
        border-radius: 5px; text-align:center'>
                <img src='../public/QRCODES/{{$index}}.png' style="margin: 2px" width="100px">
        <p style=''>{{$index}}</p>
        </div> --}}
        {{-- @endforeach --}}
    </table>
    {{-- </div> --}}
</body>