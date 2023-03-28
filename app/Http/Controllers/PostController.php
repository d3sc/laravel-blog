<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {

        $title = '';

        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->username;
        }

        return view('posts', [
            "title" => "All Posts " . $title,
            "active" => 'posts',
            //* filter adalah method yang sudah dibuat didalam file post module, dengan nama scopeFilter.
            //* Menggunakan method paginate untuk menggunakan paginate dalam halaman, dan parameter pertama nya adalah batas item yang dikeluarkan dari database. 
            //* withQueryString adalah method yang digunakan jika kita menekan tombol paginate, lalu query sebelumnya akan di ikuti dalam paginate nya.
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString(),
        ]);
    }

    //* Jika menggunakan Route Model Binding, maka dia akan langsung mencari id dari parameter yang ada di url. lalu dicocokan dengan id yang ada di dalam database.
    // Variable yang di-set di folder routes bagian url harus sama dengan nama parameter di function yang ingin diberikan Route Model Binding.
    public function show(Post $post)
    {
        return view('post', [
            "title" => "single post",
            "active" => 'posts',
            // Hanya perlu memanggil parameter saja jika menggunakan Route Model Binding
            "post" => $post,

        ]);
    }
}
