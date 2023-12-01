<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cv;
use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Quotation;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    public function show(){
        return view('admin.quotation.index');
    }

    public function showDraft(){
        return view('admin.quotation.qtoDraft',[
            'quotations' => Quotation::where('status','0')->where('is_archive','0')->get(),
        ]);
    }

    public function showConf(){
        return view('admin.quotation.qtoDraft',[
            'quotations' => Quotation::where('status','1')->where('is_archive','0')->get(),
        ]);
    }

    public function create(){
        try {
            $quotation = Quotation::latest()->firstOrFail();
            $quotationId = $quotation->id + 1;
        } catch (\Throwable $e) {
            $quotationId = 1;
        }
        $currentMonth = Carbon::now()->formatLocalized('%b');
        $currentYear = Carbon::now()->format('Y');
        $quotationNo = "QTO/{$quotationId}/{$currentMonth}/{$currentYear}";
        return view('admin.quotation.create',[
            'perusahaans' => Perusahaan::all(),
            'produks' => Produk::all(),
            'qtoNo' => $quotationNo,
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'perusahaan_id' => 'required',
            'quotation_no' => 'required',
            'tglQuotation' => 'required',
            'produk_id' => 'required|array',
            'quantity' => 'required|array',
        ]);
        // return $validatedData;
        // $email = $user->email;
        // Simpan data ke dalam tabel Quotation
        $quotation = new Quotation();
        $quotation->perusahaan_id = $validatedData['perusahaan_id'];
        $quotation->quotationNo = $validatedData['quotation_no'];
        $quotation->tglQuotation = $validatedData['tglQuotation'];
        $quotation->save();

        // Simpan data ke dalam tabel pivot (many-to-many) dengan menghitung total
        $total = 0;
        for ($i = 0; $i < count($validatedData['produk_id']); $i++) {
            $product = Produk::find($validatedData['produk_id'][$i]);
            $quantity = $validatedData['quantity'][$i];
            $harga = $product->hargaProduk;

            $quotation->produk()->attach($product->id, [
                'quantity' => $quantity,
                'harga' => $harga,
            ]);

            $total += $harga * $quantity;
        }

        // Simpan total ke dalam atribut total pada model Quotation
        $quotation->total = $total;
        $quotation->save();

        return redirect()->route('admin.quotation.draft')->with('success','Quotation Berhasil Dibuat');
    }

    public function viewQto($id){
        return view('admin.quotation.view',[
            'qto' => Quotation::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function print($id){
        return view('admin.quotation.print',[
            'qto' => Quotation::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }

    public function emailCustomer($id){
        $qto = Quotation::findOrFail($id);
        $customer = $qto->perusahaan->nama;
        $qto->update([
            'is_email' => true,
        ]);
        return redirect()->back()->with('success','Email berhasil dikirim kepada customer');
    }

    public function confirmQto($id){
        $qto = Quotation::findOrFail($id);
        $qto->update([
            'status' => '1',
        ]);
        return redirect()->back()->with('success','Quotation berhasil dikonfirmasi');
    }

    public function doneQto($id){
        $qto = Quotation::findOrFail($id);
        $qto->update([
            'status' => '2',
        ]);
        return redirect()->back()->with('success','Status Quotation berhasil menjadi Selesai');
    }
}
