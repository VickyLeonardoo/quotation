<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Perusahaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerusahaanController extends Controller
{
    public function show(){
        $perusahaans = Perusahaan::all();
        return view('admin.perusahaan.index',[
            'perusahaans' => $perusahaans,
        ]);
    }

    public function create(){
        return view('admin.perusahaan.create');
    }

    public function edit($slug){
        $perusahaan = Perusahaan::where('slug',$slug)->first();
        return view('admin.perusahaan.edit',[
            'perusahaan' => $perusahaan
        ]);
    }

    public function store(Request $request){
        request()->validate([
            'kode' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:perusahaans,email',
            'kota' => 'required',
            'provinsi' => 'required',
            'alamat' => 'required',
            'pic' => 'required',
        ],[
            'kode.required' => 'Kode Perusahaan Wajib Diisi',
            'nama.required' => 'Nama Perusahaan Wajib Diisi',
            'email.required' => 'Email Perusahaan Wajib Diisi',
            'kota.required' => 'Kota Perusahaan Wajib Diisi',
            'provinsi.required' => 'Provinsi Perusahaan Wajib Diisi',
            'alamat.required' => 'Alamat Perusahaan Wajib Diisi',
        ]);
        $slug = Str::slug($request->nama);
        // Cek apakah slug sudah ada dalam database
        $existingSlug = Perusahaan::where('slug', $slug)->exists();
        // Jika slug sudah ada, tambahkan angka unik ke slug
        if ($existingSlug) {
            $count = 1;
            while (Perusahaan::where('slug', $slug . '-' . $count)->exists()) {
                $count++;
            }
            $slug = $slug . '-' . $count;
        }
        $data = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'email' => $request->email,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kodePos' => $request->kodePos,
            'alamat' => $request->alamat,
            'jalan1' => $request->jalan1,
            'jalan2' => $request->jalan2,
            'jalan3' => $request->jalan3,
            'noTelp' => $request->noTelp,
            'fax' => $request->fax,
            'slug' => $request->slug,
            'pic' => $request->pic,
            'slug' => $slug,
        ];

        Perusahaan::create($data);
        return redirect()->back()->with('success','Data Perusahaan berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $perusahaan = Perusahaan::findOrFail($id);
        request()->validate([
            'kode' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:perusahaans,email,' . $id,
            'kota' => 'required',
            'provinsi' => 'required',
            'alamat' => 'required',
            'pic' => 'required',
        ],[
            'kode.required' => 'Kode Perusahaan Wajib Diisi',
            'nama.required' => 'Nama Perusahaan Wajib Diisi',
            'email.required' => 'Email Perusahaan Wajib Diisi',
            'kota.required' => 'Kota Perusahaan Wajib Diisi',
            'provinsi.required' => 'Provinsi Perusahaan Wajib Diisi',
            'alamat.required' => 'Alamat Perusahaan Wajib Diisi',
        ]);
        $slug = Str::slug($request->nama);
        // Cek apakah slug sudah ada dalam database
        $existingSlug = Perusahaan::where('slug', $slug)->exists();
        // Jika slug sudah ada, tambahkan angka unik ke slug
        if ($existingSlug) {
            $count = 1;
            while (Perusahaan::where('slug', $slug . '-' . $count)->exists()) {
                $count++;
            }
            $slug = $slug . '-' . $count;
        }
        $data = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'email' => $request->email,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kodePos' => $request->kodePos,
            'alamat' => $request->alamat,
            'jalan1' => $request->jalan1,
            'jalan2' => $request->jalan2,
            'jalan3' => $request->jalan3,
            'noTelp' => $request->noTelp,
            'fax' => $request->fax,
            'slug' => $request->slug,
            'pic' => $request->pic,
            'slug' => $slug,
        ];

        $perusahaan->update($data);
        return redirect()->route('admin.perusahaan')->with('success','Data Perusahaan Berhasil di Update');
    }

    public function destroy($id){
        try {
            $perusahaan = Perusahaan::findOrFail($id);
            $perusahaan->delete();
            return redirect()->back()->with('success','Data Perusahaan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) { // Cek apakah kesalahan terkait foreign key constraint
                return redirect()->back()->with('error', 'Perusahaan tidak dapat dihapus karena masih terdapat referensi di tabel lain.');
            }
            throw $e;
        }
    }

}
