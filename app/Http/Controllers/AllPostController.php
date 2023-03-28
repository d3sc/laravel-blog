<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AllPostController extends Controller
{
    public function index() {
        return view('dashboard.allposts.allposts', [
            'posts' => Post::latest()->filter(request(['post']))->paginate(10)->WithQueryString(),
        ]);
    }
}
