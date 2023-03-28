<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NewAdminController extends Controller
{
    public function index() {
        return view('dashboard.newAdmin.newadmin', [
            "users" => User::latest()->filter(request(['author']))->paginate(10)->WithQueryString(),
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            "id" => ['required', 'max:12'],
        ]);

        $user = User::findOrfail($validateData['id']);
        
        $user->is_admin = true;
        $user->save();
        return redirect('/dashboard/newadmin')->with('success', 'the user has been changed to admin!');
    }

    public function delete(Request $request) {
        // dd($request->all());
        $validateData = $request->validate([
            "id" => ['required', 'max:12'],
        ]);

        $user = User::findOrfail($validateData['id']);

        if($user->username == 'admin') {
            return redirect('/dashboard/newadmin')->with('warning', 'this user cannot be delete');
        }
        $user->is_admin = null;
        $user->save();
        return redirect('/dashboard/newadmin')->with('success', 'the user has been delete!');
    }
}
