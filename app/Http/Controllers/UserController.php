<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        return view('login'); 
    }

    public function authenticate(Request $request)
    {
        $akun = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($akun)) {
            $request->session()->regenerate();
 
            return redirect('/listdata');
        }
 
        return back()->with('error','Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
    return redirect('/');
    }

    public function repass()
    {
        return view('gtpw'); 
    }

    public function repassProcess(Request $request)
    {
        if(Hash::check($request->old_pw, auth()->user()->password)){
            
            $request->validate([
                'old_pw' => ['required'],
                'password' => ['required','min:5','confirmed'],
            ],[
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
                'password.min' => 'Password harus lebih dari 5 huruf/angka',
            ]);

            auth()->user()->update(['password' => Hash::make($request->password)]);

            return back()->with('success','password berhasil diperbaharui');
        } 

        throw ValidationException::withMessages([
            'old_pw' => 'Password lama salah',
        ]);
    }


    public function new(){
        return view('aaa');
    }
}
