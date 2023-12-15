<?php

namespace App\Http\Controllers\Manager;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerProjectController extends Controller
{
    public function index(){
        return view('manager.project.index');
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
}
