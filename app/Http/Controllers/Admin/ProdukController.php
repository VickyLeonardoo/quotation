<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDO;

class ProdukController extends Controller
{
    public function show(){
        $produks = Produk::all();
        return view('admin.produk.index',[
            'produks' => $produks,
        ]);
    }

    public function create(){
        return view('admin.produk.create');
    }

    public function edit($slug){
        $produk = Produk::where('slug', $slug)->first();
        return view('admin.produk.edit',[
            'produk' => $produk
        ]);
    }

    public function store(Request $request){
        request()->validate([
            'kodeProduk' => 'required|unique:produks,kodeProduk',
            'namaProduk' => 'required',
            'hargaProduk' => 'required',
        ],
        [
            'kodeProduk.required' => 'Kode Produk Wajib Diisi',
            'kodeProduk.unique' => 'Kode Produk Sudah Ada',
            'namaProduk.required' => 'Nama Produk Wajib Diisi',
            'hargaProduk.required' => 'Harga Produk Wajib Diisi',
        ]);
        $slug = Str::slug($request->namaProduk);
        // Cek apakah slug sudah ada dalam database
        $existingSlug = Produk::where('slug', $slug)->exists();
        // Jika slug sudah ada, tambahkan angka unik ke slug
        if ($existingSlug) {
            $count = 1;
            while (Produk::where('slug', $slug . '-' . $count)->exists()) {
                $count++;
            }
            $slug = $slug . '-' . $count;
        }
        $data = [
            'kodeProduk' => $request->kodeProduk,
            'namaProduk' => $request->namaProduk,
            'hargaProduk' => $request->hargaProduk,
            'slug' => $slug,
        ];
        Produk::create($data);
        return redirect()->back()->with('success', 'Data Produk Berhasil Ditambahkan');
    }

    public function update(Request $request, $id){
        $produk = Produk::findOrFail($id);
        $id = $produk->id;
        $str = strtolower(Request()->kodeProduk.'-'.Request()->namaProduk);
        $slug = Str::slug($request->namaProduk);
        $existingSlug = Produk::where('slug', $slug)->exists();
        // Jika slug sudah ada, tambahkan angka unik ke slug
        if ($existingSlug) {
            $count = 1;
            while (Produk::where('slug', $slug . '-' . $count)->exists()) {
                $count++;
            }
            $slug = $slug . '-' . $count;
        }
        $data = [
            'kodeProduk' => $request->kodeProduk,
            'namaProduk' => $request->namaProduk,
            'hargaProduk' => $request->hargaProduk,
            'slug' => $slug,
        ];
        Produk::where('id',$id)->update($data);
        return redirect()->route('admin.produk')->with('success','Produk Berhasil diupdate');
    }

    public function destroy($id){
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success','Produk berhasil dihapus');
    }

}
