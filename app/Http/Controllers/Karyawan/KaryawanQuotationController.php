<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;

class KaryawanQuotationController extends Controller
{
    public function index(){
        return view('karyawan.quotation.index',[
            'quotations' => Quotation::where('is_archive','0')->where('status',['1','2'])->get(),
        ]);
    }
}
