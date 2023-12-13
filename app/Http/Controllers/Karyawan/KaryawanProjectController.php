<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Project;
use Illuminate\Http\Request;

class KaryawanProjectController extends Controller
{
    public function viewOngoing(){
        return view('karyawan.project.index',[
            'projects' => Project::where('is_archive','0')->where('status','0')->get(),
        ]);
    }

    public function viewDone(){
        return view('karyawan.project.index',[
            'projects' => Project::where('is_archive','0')->where('status','1')->get(),
        ]);
    }

    public function viewDetail(Project $id){
        return view('karyawan.project.edit',[
            'project' => $id
        ]);
    }

    public function storeLogbook(Request $request,$id){
        $data = $request->validate([
            'persentase' => 'required',
            'deskripsi' => 'required',
            'tglPekerjaan' => 'required',
        ],[
            'persentase.required' => 'Persentase Wajib Diisi',
            'deskripsi.required' => 'Deskripsi Wajib Diisi',
            'tglPekerjaan.required' => 'Tanggal Wajib Diisi',
        ]);
        $data['project_id'] = $id;
        $data['user_id'] = auth()->user()->id;
        Logbook::create($data);
        return redirect()->back()->with('success','Tambah data Log Pekerjaan berhasil');
    }

    public function deleteLogbook(Logbook $id){
        $id->delete();
        return redirect()->back()->with('success','Logbook berhasil dihapus');
    }
}
