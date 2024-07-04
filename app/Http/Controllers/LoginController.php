<?php

namespace App\Http\Controllers;

use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function auth(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'Email atau password salah');
        }
    }
}
