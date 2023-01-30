<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    //
    public function index()
    {
        if (session()->has('username')) {
            return view('admin/scanner');
        } else {
            return view('admin/login');;
        }
    }


    public function scannedqr(Request $request)
    {
        $returnValue =  Publikasi::where('qrcode', $request->qrcode)
            ->update(['terakhir_discan' => date("Y-m-d h:i:s")]);
        return $returnValue;
    }
}
