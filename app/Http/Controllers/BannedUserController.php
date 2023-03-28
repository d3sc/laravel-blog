<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannedUserController extends Controller
{
    public function index() {
        return view('dashboard.bannedUser.banneduser', [
            "users" => User::latest()->filter(request(['author']))->paginate(10)->WithQueryString(),
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            "id" => ['required', 'max:12'],
        ]);

        $user = User::findOrfail($validateData['id']);

        if($user->username == 'admin') {
            return redirect('/dashboard/banned-user')->with('warning', 'this user cannot be unbanned!');
        }
        
        $user->is_banned = null;
        $user->save();
        return redirect('/dashboard/banned-user')->with('success', 'this user was successfully unbanned!');
    }

    public function delete(Request $request) {
        // dd($request->all());
        $validateData = $request->validate([
            "id" => ['required', 'max:12'],
        ]);

        $user = User::findOrfail($validateData['id']);

        if($user->username == 'admin') {
            return redirect('/dashboard/banned-user')->with('warning', 'this user cannot be banned!');
        }
        $user->is_banned = true;
        $user->save();
        return redirect('/dashboard/banned-user')->with('success', 'this user has been banned!');
    }
}
