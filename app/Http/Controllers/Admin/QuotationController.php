<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cv;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
// use \Mpdf\Mpdf as PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Produk;
use App\Models\Project;
use Barryvdh\DomPDF\PDF;
use App\Models\Quotation;
use App\Mail\ApprovalMail;
// use Barryvdh\DomPDF\PDF;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class QuotationController extends Controller
{
    public function show(){
        return view('admin.quotation.index',[
            'draftCount' => Quotation::whereIn('status',['0','1','5'])->where('is_archive','0')->count(),
            'confCount' => Quotation::whereIn('status',['2','3','4'])->where('is_archive','0')->count(),
            'archiveCount' => Quotation::where('is_archive','1')->count(),
        ]);
    }

    public function showDraft(){
        return view('admin.quotation.qtoDraft',[
            'quotations' => Quotation::whereIn('status',['0','1','5'])->where('is_archive','0')->get(),
        ]);
    }

    public function showConf(){
        return view('admin.quotation.qtoDraft',[
            'quotations' => Quotation::whereIn('status',['2','3','4'])->where('is_archive','0')->get(),
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
            'garansi' => 'required',
            'periode' => 'required',
        ]);
        // return $validatedData;
        // $email = $user->email;
        // Simpan data ke dalam tabel Quotation
        $quotation = new Quotation();
        $quotation->perusahaan_id = $validatedData['perusahaan_id'];
        $quotation->quotationNo = $validatedData['quotation_no'];
        $quotation->tglQuotation = $validatedData['tglQuotation'];
        $quotation->garansi = $validatedData['garansi'];
        $quotation->periode = $validatedData['periode'];
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

    public function draftQto(Quotation $id){
        $id->update([
            'status' => '0',
        ]);
        return redirect()->route('admin.quotation.draft')->with('success','Quotation berhasil set ke draft');

    }

    public function pendingQto($id){
        $user = User::where('role','3')->first();
        // $email = $user->email;
        $email = 'manager@example.com';
        $qto = Quotation::findOrFail($id);
        $qto->update([
            'status' => '1',
        ]);
        Mail::to($email)->send(new ApprovalMail($qto));
        return redirect()->back()->with('success','Quotation berhasil set ke pending');
    }

    public function confirmQto(Request $request, $id){
        $request->validate([
            'purchaseNo' => 'required'
        ],[
            'purchaseNo.required' => 'PO Number Wajib Diisi',
        ]);
        $qto = Quotation::findOrFail($id);
        if ($qto->project) {
            return redirect()->back()->with('error', 'Project telah dibuat, silahkan periksa quotation yang tersedia');
        }else{
            $qto->update([
                'status' => '3',
                'purchaseNo' => $request->purchaseNo,
            ]);
            $project = Project::create([
                'quotation_id' => $id,
            ]);
            return redirect()->route('admin.project.ongoing.edit',$project->id)->with('success','Project Berhasil Dibuat, Lengkapi Formulir Project yang Tersedia');
        }

    }

    public function doneQto($id){
        $qto = Quotation::findOrFail($id);
        if ($qto->project->status == 0) {
            return redirect()->back()->with('error','Project belum selesai, selesaikan terlebih dahulu status projectt');
        }else{
            $qto->update([
                'status' => '4',
            ]);
            return redirect()->back()->with('success','Status Quotation berhasil menjadi Selesai');
        }
    }

    public function edit(Quotation $id){
        if (in_array($id->status, [0,1])) {
            return view('admin.quotation.edit', [
                'qto' => $id,
                'perusahaans' => Perusahaan::all(),
                'produks' => Produk::all(),
            ]);
        } else {
            return redirect()->back()->with('error', 'Quotation yang sudah Dikonfirmasi tidak dapat di edit. Set ke draft terlebih dahulu');
        }

    }

    public function update(Request $request, Quotation $id){
        $validatedData = $request->validate([
            'perusahaan_id' => 'required',
            'quotation_no' => 'required',
            'tglQuotation' => 'required',
            'produk_id' => 'required|array',
            'quantity' => 'required|array',
            'garansi' => 'required',
            'periode' => 'required',
        ]);

        // Ambil instance Quotation yang ingin diupdate
        $quotation = $id;

        // Update data utama Quotation
        $quotation->update([
            'perusahaan_id' => $validatedData['perusahaan_id'],
            'quotationNo' => $validatedData['quotation_no'],
            'tglQuotation' => $validatedData['tglQuotation'],
            'garansi' => $validatedData['garansi'],
            'periode' => $validatedData['periode'],
        ]);

        // Hapus semua produk terkait dari pivot table
        $quotation->produk()->detach();

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

        // Update total di Quotation
        $quotation->total = $total;
        $quotation->save();

        return redirect()->route('admin.quotation.draft')->with('success','Quotation Berhasil Diupdate');
    }


    public function destroy(Quotation $id){
        try {
            if ($id->status == 1 || $id->status == 2 || $id->status == 3) {
                return redirect()->back()->with('error', 'Pending Quotation tidak dapat dihapus. Silahkan set draft terlebih dahulu.');
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

    public function archiveQto(Quotation $id){
        if ($id->status != 4) {
            return redirect()->back()->with('error', 'Quotation hanya dapat di arsipkan jika sudah selesai');
        }else{
            $id->update([
                'is_archive' => true
            ]);
            return redirect()->back()->with('success', 'Quotation berhasil di arsipkan');

        }
    }

    public function unarchiveQto(Quotation $id){
        $id->update([
            'is_archive' => 0
        ]);
        return redirect()->back()->with('success', 'Quotation berhasil di unarsip');

    }

    public function rejectQto(Quotation $id){
        if ($id->status == 2) {
            $id->update([
                'status' => '5'
            ]);
            return redirect()->back()->with('success', 'Quotation berhasil diperbarui');
        }
    }

    public function sendQuotationMail($id){
        $image = base64_encode(file_get_contents(public_path('/assets/gmp.png')));
        // Generate PDF from Blade template
        $qto = Quotation::find($id);
        $quotationNo = $qto->quotationNo;
        $total = $qto->total;
        // $terbilang = Helper::terbilang($total);

        // $pdf = PDF::loadview('email.quotationMail', ['qto' => $qto]);
        // return $pdf->download('quotation-download.pdf');

        $dompdf = new Dompdf();
        // $dompdf->set_option('enable_remote', true);
        // $dompdf->set_option('chroot', public_path('assets'));
        $html = view('email.quotationMail', ['qto' => $qto, 'img' => $image])->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();

        // Save PDF to temporary file
        $pdfPath = public_path('QuotationMitra.pdf');
        file_put_contents($pdfPath, $output);

        // Send email with the PDF attachment
        $email = 'admin@example.com'; // Email recipient
        Mail::send('email.text', [], function ($message) use ($email, $pdfPath, $qto) {
            $message->to($email)
                ->subject('Quotation For Project XXX')
                ->attach($pdfPath);
        });

        // Delete the temporary PDF file
        unlink($pdfPath);
        $qto->update([
            'is_email' => true,
        ]);
        return redirect()->back()->withToastSuccess('Email Berhasil Dikirim');
    }



    public function quotationArchive(){
        // Mengambil semua tahun unik dari kolom 'tglQuotation' dengan pagination 10 item per halaman
        $years = Quotation::select(DB::raw('DISTINCT YEAR(tglQuotation) as year'))
                        ->orderBy('year', 'desc')
                        ->paginate(12);
        return view('admin.quotation.archive.index', ['years' => $years]);
    }

    public function yearArchive(Request $request, $year){
        $quotationsYear = Quotation::whereYear('tglQuotation', $year)->where('is_archive','1')->get();

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["mulai"] && $request["akhir"]) {
            $quotationsYear = Quotation::whereBetween('tglQuotation', [$request["mulai"], $request["akhir"]])->where('is_archive','1')->get();
        }
        return view('admin.quotation.archive.archiveYear',[
            'quotations' => $quotationsYear,
            'year' => $year,
        ]);
    }

}
