<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function show(){
        return view('admin.invoice.index');
    }

    public function showDraft(){
        return view('admin.invoice.viewInv',[
            'invoices' => Invoice::where('status','0')->where('is_archive',0)->get(),
        ]);
    }

    public function showConf(){
        return view('admin.invoice.viewInv',[
            'invoices' => Invoice::where('status','1')->where('is_archive',0)->get(),
        ]);
    }

    public function create(){
        try {
            $invoice = Invoice::latest()->firstOrFail();
            $invoiceId = $invoice->id + 1;
        } catch (\Throwable $e) {
            $invoiceId = 1;
        }
        $currentMonth = Carbon::now()->formatLocalized('%b');
        $currentYear = Carbon::now()->format('Y');
        $invoiceNo = "INV/{$invoiceId}/{$currentMonth}/{$currentYear}";

        return view('admin.invoice.create',[
            'quotations' => Quotation::where('is_archive',0)->where('status','1')->get(),
            'invoiceNo' => $invoiceNo,
        ]);
    }

    public function store(Request $request){
        $qtoId = $request->quotation_id;

        $validatedData = $request->validate([
            'quotation_id' => 'required',
            'invoiceNo' => 'required',
            'tglInvoice' => 'required',
            'payment_due' => 'required',
        ],[
            'quotation_id.required' => 'Wajib memilih Quotation',
            'invoiceNo.required' => 'No Invoice Kosong',
            'tglInvoice.required' => 'Tanggal invoice wajib diisi',
            'payment_due.required' => 'Batas pembayaran wajib diisi',
        ]);

        $qtoFind = Invoice::where('quotation_id',$qtoId)->first();
        $invoiceNo = $qtoFind->invoiceNo;
        if (!$qtoFind) {
            $tglInvoice = Carbon::parse($validatedData['tglInvoice']);
            $paymentDue = $tglInvoice->addDays($request->payment_due);
            $validatedData['payment_due'] = $paymentDue;

            Quotation::where('id',$qtoId)->update(['is_invoice' => true]);
            Invoice::create($validatedData);
            return redirect()->route('admin.invoice.draft')->with('success','Invoice berhasil dibuat');
        }else{
            return redirect()->back()->with('error','Invoice untuk quotation sudah ada, Periksa invoice '.$invoiceNo);
        }
    }

    public function viewInv($id){
        return view('admin.invoice.view',[
            'inv' => Invoice::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function print($id){
        return view('admin.invoice.print',[
            'inv' => Invoice::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function confirmInv($id){
        $inv = Invoice::findOrFail($id);
        $inv->update([
            'status' => '1'
        ]);
        return redirect()->route('admin.invoice.draft')->with('success','Invoice berhasil dikonfirmasi');
    }

    public function doneInv($id){
        $inv = Invoice::findOrFail($id);
        $inv->update([
            'status' => '2'
        ]);
        return redirect()->route('admin.invoice.confirmed')->with('success','Invoice berhasil diselesaikan');
    }
}
