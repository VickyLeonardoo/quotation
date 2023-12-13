<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanProfileController extends Controller
{
    //

    public function index(){
        return view('karyawan.profile.index');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Nama Wajib Diisi'
        ]);
        $user = User::find(auth()->user()->id);
        $user->update([
            'name' => $request->nama,
        ]);
        return redirect()->route('karyawan.dashboard')->with('success','Profile berhasil perbarui');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required|min:3|same:password_confirmation',
            'password_confirmation' => 'required'
        ],[
            'password.required' => 'Password Wajib Diisi',
            'password_confirmation.required' => 'Password Konfirmasi wajib diisi',
            'password.min' => 'Password Minimal 3 Karakter',
            'password.same' => 'Password Tidak Sama',
        ]);

        $user = User::find(auth()->user()->id);

        try {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        } catch (\Exception $e) {
            session()->flash('activeForm', 'formPassword');
            return 'gagal';
            return redirect()->route('karyawan.profile')->with('error', 'Gagal mengubah password');
        }

        // Jika sukses, kita hapus status form yang sedang aktif
        session()->forget('activeForm');

        return redirect()->route('karyawan.dashboard')->with('success', 'Password berhasil diubah');
    }

}
