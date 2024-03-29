<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
        return view('admin.project.index',[
            'ongoCount' => Project::where('status','0')->where('is_archive','0')->count(),
            'doneCount' => Project::where('status','1')->where('is_archive','0')->count(),
            'archiveCount' => Project::where('is_archive','1')->count(),
        ]);
    }

    public function showOngoing(){
        return view('admin.project.viewProject',[
            'projects' => Project::where('is_archive','0')->where('status','0')->get(),
        ]);
    }

    public function showDone(){
        return view('admin.project.viewProject',[
            'projects' => Project::where('is_archive','0')->where('status','1')->get(),
        ]);
    }

    public function create(){
        return view('admin.project.create',[
            'quotations' => Quotation::where('is_archive', '0')->where('status','3')->get(),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'quotation_id' => 'required',
        ],[
            'quotation_id.required' => 'Quotation Wajib Diisi',
        ]);
        $id = $request->quotation_id;
        $qto = Quotation::findOrFail($id);
        if ($qto->project) {
            return redirect()->back()->with('error',$qto->project->id);
        }else{
            $project = Project::create([
                'quotation_id' => $id,
            ]);
            return redirect()->route('admin.project.ongoing.edit',$project->id)->with('success','Project Berhasil Dibuat, Lengkapi Formulir Project yang Tersedia');
        }
    }

    public function edit($id){
        return view('admin.project.edit',[
            'project' => Project::findOrFail($id),
        ]);
    }

    public function editDone($id){
        return view('admin.project.edit',[
            'project' => Project::findOrFail($id),
        ]);
    }

    public function update(Request $request,$id){
        $project = Project::findOrFail($id);
        $data = [
            'nama' => $request->nama,
            'tglMulai' => $request->tglMulai,
            'tglSelesai' => $request->tglSelesai,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ];
        $project->update($data);
        return redirect()->back()->with('success','Project berhasil diperbarui');
    }

    public function archiveProject(Project $id){
        if ($id->status != 1) {
            return redirect()->back()->with('error', 'Project hanya dapat di arsipkan jika sudah selesai');
        }else{
            if (!$id->tglMulai) {
                return redirect()->back()->with('error','Isi terlebih dahulu tanggal mulai');
            }
            $id->update([
                'is_archive' => true
            ]);
            return redirect()->back()->with('success', 'Project berhasil di arsipkan');
        }
    }

    public function destroy(Project $id){
        if ($id->status == 1) {
            return redirect()->back()->with('error','Project tidak dapat dihapus, karna project sudah selesai');
        }else{
            $id->delete();
            return redirect()->back()->with('success','Project berhasil dihapus');

        }
    }

    public function unarchiveProject(Project $id){
        $id->update([
            'is_archive' => 0
        ]);
        return redirect()->back()->with('success', 'Project berhasil di unarsip');
    }

    public function projectArchive(){
        $years = Project::select(DB::raw('DISTINCT YEAR(tglMulai) as year'))
                        ->orderBy('year', 'desc')
                        ->where('is_archive','1')
                        ->paginate(12);
        return view('admin.project.archive.index', ['years' => $years]);
    }

    public function yearArchive(Request $request, $year){
        $projectYears = Project::whereYear('tglMulai', $year)->where('is_archive','1')->get();

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["mulai"] && $request["akhir"]) {
            $projectYears = Project::whereBetween('tglMulai', [$request["mulai"], $request["akhir"]])->where('is_archive','1')->get();
        }
        return view('admin.project.archive.archiveYear',[
            'projects' => $projectYears,
            'year' => $year,
        ]);
    }

}
