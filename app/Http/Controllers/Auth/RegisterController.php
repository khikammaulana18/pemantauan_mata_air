<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()->intended('/lapor');
        }
        return view('auth.pages.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','confirmed','min:6'],
        ]);

        $user = User::create([
            'image' => 'thumbnail/user.png',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelapor',
        ]);

        Auth::login($user);

        return redirect()->intended('/lapor');
    }
}
