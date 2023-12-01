<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CvController extends Controller
{
    public function show(){
        $cv = Cv::first();
        return view('admin.cv.index',[
            'cv' => $cv,
        ]);
    }

    public function update(Request $request){
        $cv = Cv::first();
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email'=> 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'noTelp' => 'required'
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'email.required'=> 'Email Wajib Diisi',
            'kota.required' => 'Kota Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'provinsi.required' => 'Provinsi Wajib Diisi',
            'noTelp.required' => 'No Telfon Wajib Diisi',
        ]);

        $data = request()->except(['_token']);
        $cv->update($data);
        return redirect()->back()->with('success','Provile CV Berhasil Diupdate');
    }
}
