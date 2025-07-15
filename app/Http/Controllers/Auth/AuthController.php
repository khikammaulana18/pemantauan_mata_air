<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function index(){
        if(!Auth::check()){
            return view('auth.pages.signin');
        }
        return redirect()->route('dashboard');
    }
    public function auth(Request $request){
        
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password'  => ['required']
        ]);
       
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            $defaultRedirect = (auth()->user()->role ?? null) === 'pelapor' ? '/lapor' : '/dashboard';
            return redirect()->intended($defaultRedirect);
        }
        return redirect()->back()->with('error', "Email atau Password salah, silahkan coba lagi !")->onlyInput('email');
    }
    public function signout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Log Out Berhasil');
    }
}
