<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class ManagerKaryawanController extends Controller
{
    public function show(){
        $karyawans = User::where('is_active','1')->whereIn('role',['2','1'])->get();
        return view('manager.karyawan.index',[
            'karyawans' => $karyawans,
        ]);
    }

    public function create(){
        return view('manager.karyawan.create');
    }

    public function edit($slug){
        $user = User::where('slug',$slug)->first();
        return view('manager.karyawan.edit',[
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
            'role' => $request->role,
            'slug' => Str::slug($request->name)
        ];
        User::create($data);
        return redirect()->route('manager.karyawan')->with('success','Data Karyawan Berhasil Ditambahkan');
    }

    public function resetPassword($id){
        $karyawan = User::findOrFail($id);
        $karyawan->update([
            'password' => bcrypt('12345'),
        ]);
        return redirect()->back()->with('success','Berhasil reset password karyawan');
    }
}
