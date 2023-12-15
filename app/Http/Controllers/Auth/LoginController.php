<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function viewForgetPassword(){
        return view('auth.forgetPassword');
    }

    public function prosesLogin(Request $request){
        request()->validate([
            'email' => 'required', // Required => Wajib Diisi
            'password' => 'required',
        ],
        [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi'
        ]
        );
        $kredensil = $request->only('email','password'); //Menyimpan Data Email dan Password
        if (Auth::guard('user')->attempt($kredensil)) { //Melakukan pengecekan tabel users apakah memiliki email dan password yang sama
            $user = Auth::guard('user')->user();
            if ($user->role == '1') {
                return redirect()->route('admin.dashboard')->with('message','Berhasil');
            }else if($user->role == '2'){
                return redirect()->route('karyawan.dashboard')->with('message','Selamat Datang!');
            }else if($user->role == '3'){
                return redirect()->route('manager.dashboard')->with('message','Selamat Datang!');
            }
        }
        return redirect()->back()->with('error','Maaf Username atau Password kamu Salah');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login')->with('logout',true);
    }
}
