<?php

namespace App\Http\Controllers\Manager;

use App\Models\Cv;
use App\Models\Produk;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManagerQuotationController extends Controller
{
    public function show(){
        return view('manager.quotation.index',[
            'draftCount' => Quotation::whereIn('status',['0','1','5'])->where('is_archive','0')->count(),
            'confCount' => Quotation::whereIn('status',['2','3','4'])->where('is_archive','0')->count(),
            'archiveCount' => Quotation::where('is_archive','1')->count(),
        ]);
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

    public function reject(Request $request, Quotation $id){
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
        return redirect()->back()->with('success','Berhasil menolak quotation');
    }

    public function quotationArchive(){
        // Mengambil semua tahun unik dari kolom 'tglQuotation' dengan pagination 10 item per halaman
        $years = Quotation::select(DB::raw('DISTINCT YEAR(tglQuotation) as year'))
                        ->orderBy('year', 'desc')
                        ->paginate(12);
        return view('manager.quotation.archive.index', ['years' => $years]);
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
            $quotationsYear = Quotation::whereBetween('tglQuotation', [$request["mulai"], $request["akhir"]])->get();
        }
        return view('manager.quotation.archive.archiveYear',[
            'quotations' => $quotationsYear,
            'year' => $year,
        ]);
    }
}
