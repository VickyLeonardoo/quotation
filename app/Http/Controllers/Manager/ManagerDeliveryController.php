<?php

namespace App\Http\Controllers\Manager;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManagerDeliveryController extends Controller
{
    public function index(){
        return view('manager.delivery.index',[
            'draftCount' => Delivery::where('status','0')->where('is_archive' ,'0')->count(),
            'confCount' => Delivery::where('status','1')->where('is_archive' ,'0')->count(),
            'archiveCount' => Delivery::where('is_archive' ,'1')->count(),
        ]);
    }

    public function showDraft(){
        return view('manager.delivery.viewDelivery',[
            'deliveries' => Delivery::where('status', '0')->where('is_archive', false)->get(),
        ]);
    }

    public function showConf(){
        return view('manager.delivery.viewDelivery',[
            'deliveries' => Delivery::where('status', '1')->where('is_archive', false)->get(),
        ]);
    }

    public function create(){
        try {
            $delivery = Delivery::latest()->firstOrFail();
            $deliveryId = $delivery->id + 1;
        } catch (\Throwable $e) {
            $deliveryId = 1;
        }
        $currentMonth = Carbon::now()->formatLocalized('%b');
        $currentYear = Carbon::now()->format('Y');
        $deliveryNo = "DO/{$deliveryId}/{$currentMonth}/{$currentYear}";

        return view('manager.delivery.create',[
            'invoices' => Invoice::where('status',['1','2'])->where('is_archive',false)->get(),
            'deliveryNo' => $deliveryNo,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'invoice_id' => 'required',
            'tglDelivery' => 'required',
        ],[
            'invoice_id.required' => 'Invoice No Wajib Diisi',
            'tglDelivery.required' => 'Tanggal Delivery Wajib Diisi',
        ]);
        $data = [
            'invoice_id' => $request->invoice_id,
            'deliveryNo' => $request->deliveryNo,
            'tglDelivery' => $request->tglDelivery,
        ];
        $inv = Invoice::findOrFail($request->invoice_id);

        if ($inv->is_delivery == true) {
            return redirect()->back()->with('error','Delivery untuk invoice sudah ada, Periksa DO '.$inv->delivery->deliveryNo);
        }else{
            $inv->update([
                'is_delivery' => true
            ]);
            Delivery::create($data);
            return redirect()->route('manager.delivery.draft')->with('success','Data Delivery Order berhasil disimpan');
        }
    }

    public function edit($id){
        return view('manager.delivery.edit',[
            'delivery' => Delivery::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id){
        $do = Delivery::findOrFail($id);

        $request->validate([
            'tglDelivery' => 'required',
        ],[
            'invoiceNo.required' => 'Invoice No Wajib Diisi',
            'tglDelivery.required' => 'Tanggal Delivery Wajib Diisi',
        ]);
        $data = [
            'tglDelivery' => $request->tglDelivery,
        ];
        $do->update($data);
        return redirect()->route('manager.delivery.draft')->with('success','Data berhasil diupdate');
    }

    public function destroy($id){
        $do = Delivery::findOrFail($id);
        if ($do->status == 0) {
            $do->invoice->update([
                'is_delivery' => false,
            ]);
            $do->delete();
            return redirect()->back()->with('success','Data delivery berhasil dihapus');
        }else{
            return redirect()->back()->with('error','Status delivery sudah confirmed, tidak dapat dihapus');
        }
    }

    public function deliveryArchive(){
        $years = Delivery::select(DB::raw('DISTINCT YEAR(tglDelivery) as year'))
                        ->orderBy('year', 'desc')
                        ->paginate(12);
        return view('manager.delivery.archive.index', ['years' => $years]);
    }

    public function yearArchive(Request $request, $year){
        $deliveryYears = Delivery::whereYear('tglDelivery', $year)->where('is_archive','1')->get();

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["mulai"] && $request["akhir"]) {
            $deliveryYears = Delivery::whereBetween('tglDelivery', [$request["mulai"], $request["akhir"]])->get();
        }
        return view('manager.delivery.archive.archiveYear',[
            'deliveries' => $deliveryYears,
            'year' => $year,
        ]);
    }
}
