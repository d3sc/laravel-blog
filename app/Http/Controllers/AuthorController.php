<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function authors()
    {
        return view('author', [
            'title' => "Author Posts",
            "active" => "authors",
            'authors' => User::latest()->filter(request(['author']))->get(),
        ]);
    }
}
