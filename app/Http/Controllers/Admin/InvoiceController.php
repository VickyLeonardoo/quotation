<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cv;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ApprovalMailInv;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function show(){
        return view('admin.invoice.index');
    }

    public function showDraft(){
        return view('admin.invoice.viewInv',[
            'invoices' => Invoice::whereIn('status',['0','1','2','5'])->where('is_archive',0)->get(),
        ]);
    }

    public function showConf(){
        return view('admin.invoice.viewInv',[
            'invoices' => Invoice::whereIn('status',['3','4'])->where('is_archive',0)->get(),
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
            'quotations' => Quotation::where('is_archive',0)->where('status','3')->get(),
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
        $tglInvoice = Carbon::parse($validatedData['tglInvoice']);
        $paymentDue = $tglInvoice->addDays($request->payment_due);
        $validatedData['payment_due'] = $paymentDue;
        $qto = Quotation::findOrFail($qtoId);

        if ($qto->is_invoice == true) {
            return redirect()->back()->with('error','Invoice untuk quotation sudah ada, Periksa invoice '.$qto->invoice->invoiceNo);
        }else{
            Invoice::create($validatedData);
            $qto->update([
                'is_invoice' => true
            ]);
            return redirect()->route('admin.invoice.draft')->with('success','Invoice berhasil dibuat');
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

    public function pendingInv(Invoice $id){
        $user = User::where('role','3')->first();
        $email = 'manager@example.com';

        $id->update([
            'status' => '1'
        ]);
        Mail::to($email)->send(new ApprovalMailInv($id));
        return redirect()->route('admin.invoice.draft')->with('success','Invoice berhasil dikonfirmasi');
    }

    public function confirmInv($id){
        $inv = Invoice::findOrFail($id);
        $inv->update([
            'status' => '3'
        ]);
        return redirect()->route('admin.invoice.draft')->with('success','Invoice berhasil dikonfirmasi');
    }

    public function doneInv($id){
        $inv = Invoice::findOrFail($id);
        $inv->update([
            'status' => '4'
        ]);
        return redirect()->route('admin.invoice.confirmed')->with('success','Invoice berhasil diselesaikan');
    }

    public function destroy(Invoice $id){
        try {
            if ($id->status == 1) {
                return redirect()->back()->with('error', 'Pending Invoice tidak dapat dihapus. Silahkan set draft terlebih dahulu.');
            } else {
                $id->delete();
                return redirect()->back()->with('success', 'Quotation berhasil dihapus');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) { // Cek apakah kesalahan terkait foreign key constraint
                return redirect()->back()->with('error', 'Quotation tidak dapat dihapus karena masih terdapat referensi di tabel lain.');
            }
            throw $e;
        }
    }

}
