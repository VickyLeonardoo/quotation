<?php

namespace App\Http\Controllers\Manager;

use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Quotation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerInvoiceController extends Controller
{
    public function show(){
        return view('manager.invoice.index');
    }

    public function showDraft(){
        return view('manager.invoice.viewInv',[
            'invoices' => Invoice::where('status','1')->where('is_archive',0)->get(),
        ]);
    }

    public function showConf(){
        return view('manager.invoice.viewInv',[
            'invoices' => Invoice::whereIn('status', ['3','4'])->where('is_archive',0)->get(),
        ]);
    }

    public function viewInv($id){
        return view('manager.invoice.view',[
            'inv' => Invoice::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function print($id){
        return view('manager.invoice.print',[
            'inv' => Invoice::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function acceptedInv(Invoice $id){
        $id->update([
            'status' => '2'
        ]);
        return redirect()->route('manager.invoice.draft')->with('success','Invoice berhasil dikonfirmasi');
    }
}
