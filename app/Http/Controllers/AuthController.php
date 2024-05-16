<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);
        $request->merge(['statususers' => '1']);
        $credentials = $request->only('email', 'password', 'statususers');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return redirect()->back()->with('error', 'Username atau Password Salah !,pastikan akun anda aktif');
    }
}
