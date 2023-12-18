<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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
}
