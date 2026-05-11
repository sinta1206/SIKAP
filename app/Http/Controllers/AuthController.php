<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Pakai username (BUKAN email)
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
