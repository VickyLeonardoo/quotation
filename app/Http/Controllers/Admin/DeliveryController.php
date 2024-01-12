<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cv;
use App\Models\Invoice;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use League\CommonMark\Delimiter\Delimiter;

class DeliveryController extends Controller
{
    public function index(){
        return view('admin.delivery.index',[
            'draftCount' => Delivery::where('status','0')->where('is_archive' ,'0')->count(),
            'confCount' => Delivery::where('status','1')->where('is_archive' ,'0')->count(),
            'archiveCount' => Delivery::where('is_archive' ,'1')->count(),
        ]);
    }

    public function showDraft(){
        return view('admin.delivery.viewDelivery',[
            'deliveries' => Delivery::where('status', '0')->where('is_archive', false)->get(),
        ]);
    }

    public function showConf(){
        return view('admin.delivery.viewDelivery',[
            'deliveries' => Delivery::whereIn('status',['1', '2'])->where('is_archive', false)->get(),
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

        return view('admin.delivery.create',[
            'invoices' => Invoice::whereIn('status',['3','4'])->where('is_archive',false)->get(),
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
            return redirect()->route('admin.delivery.draft')->with('success','Data Delivery Order berhasil disimpan');
        }
    }

    public function edit($id){
        return view('admin.delivery.edit',[
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
        return redirect()->route('admin.delivery.draft')->with('success','Data berhasil diupdate');
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

    public function viewDelivery(Delivery $id){
        return view('admin.delivery.view',[
            'do' => $id,
            'cv' => Cv::first(),
        ]);
    }

    public function confirmDo(Delivery $id){
        $id->update([
            'status' => '1'
        ]);
        return redirect()->route('admin.delivery.confirmed')->with('success','Delivery Order berhasil dikonfirmasi');
    }

    public function doneDo(Delivery $id){
        $id->update([
            'status' => '2'
        ]);
        return redirect()->route('admin.delivery.confirmed')->with('success','Delivery Order berhasil dikonfirmasi');
    }

    public function archiveDelivery(Delivery $id){
        if ($id->status != 2) {
            return redirect()->back()->with('error', 'Invoice hanya dapat di arsipkan jika sudah selesai');
        }else{
            $id->update([
                'is_archive' => true
            ]);
            return redirect()->back()->with('success', 'Invoice berhasil di arsipkan');
        }
    }

    public function unarchiveDo(Delivery $id){
        $id->update([
            'is_archive' => 0
        ]);
        return redirect()->back()->with('success', 'Invoice berhasil di unarsip');
    }

    public function deliveryArchive(){
        $years = Delivery::select(DB::raw('DISTINCT YEAR(tglDelivery) as year'))
                        ->orderBy('year', 'desc')
                        ->paginate(12);
        return view('admin.delivery.archive.index', ['years' => $years]);
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
            $deliveryYears = Delivery::whereBetween('tglDelivery', [$request["mulai"], $request["akhir"]])->where('is_archive','1')->get();
        }
        return view('admin.delivery.archive.archiveYear',[
            'deliveries' => $deliveryYears,
            'year' => $year,
        ]);
    }

    public function print($id){
        return view('admin.delivery.print',[
            'do' => Delivery::findOrFail($id),
            'cv' => Cv::first(),
        ]);
    }
}
