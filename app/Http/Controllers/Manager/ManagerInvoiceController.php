<?php

namespace App\Http\Controllers\Manager;

use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManagerInvoiceController extends Controller
{
    public function show(){
        return view('manager.invoice.index',[
            'draftCount' => Invoice::whereIn('status',['0','1','5'])->where('is_archive','0')->count(),
            'confCount' => Invoice::whereIn('status',['2','3','4'])->where('is_archive','0')->count(),
            'archiveCount' => Invoice::where('is_archive','1')->count(),
        ]);
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

    public function rejectInv(Request $request, Invoice $id){
        $request->validate([
            'deskripsi' => 'required'
        ], [
            'deskripsi.required' => 'Deskripsi wajib diisi'
        ]);

        $id->log()->create([
            'deskripsi' => $request->deskripsi,
        ]);

        $id->update([
            'status' => '5'
        ]);
        return redirect()->route('manager.invoice.draft')->with('success','Invoice berhasil ditolak');
    }

    public function invoiceArchive(){
        $years = Invoice::select(DB::raw('DISTINCT YEAR(tglInvoice) as year'))
                        ->orderBy('year', 'desc')
                        ->paginate(12);
        return view('manager.invoice.archive.index', ['years' => $years]);
    }

    public function yearArchive(Request $request, $year){
        $invoiceYears = Invoice::whereYear('tglInvoice', $year)->where('is_archive','1')->get();

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["mulai"] && $request["akhir"]) {
            $invoiceYears = Invoice::whereBetween('tglInvoice', [$request["mulai"], $request["akhir"]])->get();
        }
        return view('manager.invoice.archive.archiveYear',[
            'invoices' => $invoiceYears,
            'year' => $year,
        ]);
    }

}
