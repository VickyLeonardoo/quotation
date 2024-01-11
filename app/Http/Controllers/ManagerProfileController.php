<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagerProfileController extends Controller
{
    public function index(){
        $id = auth()->user()->id;

        $user = User::with('user_detail')->findOrFail($id);
        // $user = User::findOrFail($id);
        // return $user;
        return view('manager.profile',[
            'user' => $user,
        ]);
    }

    public function update(Request $request){
        $id = auth()->user()->id;
        $data1 = [
            'name' => $request->name,
        ];

        $data2 = [
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'noHp' => $request->noHp,
            'tglLahir' => $request->tglLahir,
        ];

        $user = User::findOrFail($id);

        $user->update($data1);

        if ($user->user_detail) {
            $user->user_detail->update($data2);
        } else {
            $user->user_detail()->create([
                'user_id' => $user->id,
                'alamat' => $request->alamat,
                'jk' => $request->jk,
                'noHp' => $request->noHp,
                'tglLahir' => $request->tglLahir,
            ]);
        }

        return redirect()->back()->with('success','Data berhasil diupdate');
    }


    public function password_update(Request $request){
        $request->validate([
            'password' => 'min:5|same:password_confirmation',
            'password_confirmation' => 'min:5'
        ],[
            'password.min' => 'Password minimal 5 karakter',
            'password.same' => 'Password tidak sama',
        ]);

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect()->back()->with('success','Password berhasil di perbarui');
    }
}
