<?php

namespace App\Http\Controllers\Manager;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManagerProjectController extends Controller
{
    public function index(){
        return view('manager.project.index',[
            'ongoCount' => Project::where('status','0')->where('is_archive','0')->count(),
            'doneCount' => Project::where('status','1')->where('is_archive','0')->count(),
            'archiveCount' => Project::where('is_archive','1')->count(),
        ]);
    }

    public function showOngoing(){
        return view('manager.project.viewProject',[
            'projects' => Project::where('is_archive','0')->where('status','0')->get(),
        ]);
    }

    public function showDone(){
        return view('manager.project.viewProject',[
            'projects' => Project::where('is_archive','0')->where('status','1')->get(),
        ]);
    }

    public function edit($id){
        return view('manager.project.edit',[
            'project' => Project::findOrFail($id),
        ]);
    }

    public function editDone($id){
        return view('manager.project.edit',[
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

    public function projectArchive(){
        $years = Project::select(DB::raw('DISTINCT YEAR(tglMulai) as year'))
                        ->orderBy('year', 'desc')
                        ->where('is_archive','1')
                        ->paginate(12);
        return view('manager.project.archive.index', ['years' => $years]);
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
            $projectYears = Project::whereBetween('tglMulai', [$request["mulai"], $request["akhir"]])->get();
        }
        return view('manager.project.archive.archiveYear',[
            'projects' => $projectYears,
            'year' => $year,
        ]);
    }
}
