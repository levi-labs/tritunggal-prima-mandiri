<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Halaman Login';
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Username atau password anda salah');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
