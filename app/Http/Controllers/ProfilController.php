<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    // Mengubah Username
    public function updateUsername(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|alpha_dash|max:255|unique:users,username,' . $user->id,
        ]);

        $user->update([
            'username' => $request->username
        ]);

        return redirect()->back()->with('success', 'Username berhasil diperbarui!');
    }

    // Mengubah Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama yang dimasukkan cocok dengan di DB
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }
}
