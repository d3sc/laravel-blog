<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "login",
            "active" => "login"
        ]);
    }

    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required|min:4|max:255',
            'password' => 'required',
        ]);

        //* Menggunakan method attempt pada class Auth untuk memastikan bahwa tidak ada error pada saat pengecekan login.
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', "Login Failed!");
    }

    public function logout()
    {
        //* Berikut cara cara meng-logout user.

        //* menggunakan method logout pada class Auth.
        Auth::logout();

        //* menghapus session.
        request()->session()->invalidate();

        //* meng-generate ulang token.
        request()->session()->regenerateToken();

        //* me-redirect ke halaman home
        return redirect('/');
    }
}
