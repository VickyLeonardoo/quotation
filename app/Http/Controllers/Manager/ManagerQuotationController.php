<?php

namespace App\Http\Controllers\Manager;

use App\Models\Cv;
use App\Models\Produk;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ManagerQuotationController extends Controller
{
    public function show(){
        return view('manager.quotation.index');
    }

    public function showDraft(){
        return view('manager.quotation.qtoDraft',[
            'quotations' => Quotation::where('status','1')->where('is_archive','0')->get(),
        ]);
    }

    public function showConf(){
        return view('manager.quotation.qtoDraft',[
            'quotations' => Quotation::where('status','3')->where('is_archive','0')->get(),
        ]);
    }

    public function viewQto($id){
        return view('manager.quotation.view',[
            'qto' => Quotation::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function print($id){
        return view('manager.quotation.print',[
            'qto' => Quotation::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function acceptedQto(Quotation $id){
        $id->update([
            'status' => '2',
        ]);
        return redirect()->back()->with('success','Status Quotation berhasil menjadi Accepted');
    }
}
