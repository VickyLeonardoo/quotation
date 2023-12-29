<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    public function show(){
        $karyawans = User::where('is_active','1')->where('role','2')->get();
        return view('admin.karyawan.index',[
            'karyawans' => $karyawans,
        ]);
    }

    public function create(){
        return view('admin.karyawan.create');
    }

    public function edit($slug){
        $user = User::where('slug',$slug)->first();
        return view('admin.karyawan.edit',[
            'user' => $user
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
        ],[
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email sudah terdaftar, silahkan ganti Email',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345'),
            'role' => 2,
            'slug' => Str::slug($request->name)
        ];
        User::create($data);
        return redirect()->route('admin.karyawan')->with('success','Data Karyawan Berhasil Ditambahkan');
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ], [
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Format Email tidak valid',
            'email.unique' => 'Email sudah terdaftar, silahkan ganti Email',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'slug' => Str::slug($request->name)
        ];

        $user->update($data);
        return redirect()->route('admin.karyawan')->with('success','Data Karyawan Berhasil diperbarui');
    }


    public function resetPassword($id){
        $karyawan = User::findOrFail($id);
        $karyawan->update([
            'password' => bcrypt('12345'),
        ]);
        return redirect()->back()->with('success','Berhasil reset password karyawan');
    }

    public function destroy(User $id){
        $id->update([
            'is_active' => '0'
        ]);
        return redirect()->back()->with('success','Karyawan berhasil dinonaktifkan');
    }
}
