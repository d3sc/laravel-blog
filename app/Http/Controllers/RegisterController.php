<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title" => 'register',
            "active" => 'register',
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        // $validateData['password'] = bcrypt($validateData['password']);
        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        // $request->session()->flash('success');
        //! Error Karena ekstensi, padahal mah kaga error.
        // $request->session()->flash('success', 'Registration Successfull! please login');
        // Session::flash('success', 'Registration Successfull! please login');

        //* Karena masih error pake flash di atas, pake method with aja setelah redirect.
        return redirect('/login')->with('success', 'Registration Successfull! please login');
    }
}
