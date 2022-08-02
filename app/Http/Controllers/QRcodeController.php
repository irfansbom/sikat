<?php

namespace App\Http\Controllers;

use App\Models\qrcode_terakhir;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QRcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        // QrCode::generate('as');
        if (session()->has('username')) {
            $qrcode_last = qrcode_terakhir::find(1);
            return view('admin/qrcode', compact('qrcode_last'));;
        } else {
            return view('admin/login');;
        }
    }

    public function createqr(Request $request)
    {
        // $arrqrcode  = [];
        $qrcode =  $request->get('qrcode');
        $arrqrcode = explode('-', $qrcode);
        $result = "";
        $arr = [];
        $nomor = null;
        if (count($arrqrcode) > 1) {
            $jml = substr($arrqrcode[1], 2) - substr($arrqrcode[0], 2);
            for ($i = 0; $i <= $jml; $i++) {
                $nomor = substr($arrqrcode[0], 2);
                $nomor = $nomor + $i;
                $nomor = str_pad($nomor, 5,  "0",  STR_PAD_LEFT);
                array_push($arr, 'QR' . $nomor);
                QrCode::size(70)->generate('QR' . $nomor, '../public/QRCODES/QR' . $nomor . '.png');
            }
        } else {
            $nomor = substr($qrcode, 2);
            QrCode::size(70)->generate($qrcode, '../public/QRCODES/' . $qrcode . '.png');
            array_push($arr, 'QR' . $nomor);
        }
        qrcode_terakhir::where('id', '1')
            ->update(['qrcode' => 'QR' . $nomor]);
        $this->createpdf($arr);
        return "QR" . $nomor;
    }
    public function createpdf(array $arr)
    {
        $data = $arr;
        $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        $view = view('admin.qrcode_print', compact('data'))->render();
        $pdf->loadHTML($view)->setPaper('a4', 'potrait')->setWarnings(false);
        // $pdf = PDF::loadView('admin.qrcode_print', $data)->setPaper('a4', 'potrait');
        // PDF::loadView('pdf.invoice', $data);
        $pdf->save('../public/QRCODES/qrcodecetak.pdf');
        // return $pdf->download('laporan-pdf.pdf');
    }

    public function viewprint()
    {
        $data = ['QR00001', 'QR00002', 'QR00003',];
        return view('admin.qrcode_print', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
