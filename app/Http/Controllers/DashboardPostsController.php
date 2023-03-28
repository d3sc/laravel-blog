<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Spatie\FlareClient\View;

//* Controller resource ini akan mudah saat kita menangani kasus seperti CRUD.
class DashboardPostsController extends Controller
{
    //* jika kita masuk kedalam route ini maka automatis akan masuk kedalam method index.
    public function index()
    {
        return view('dashboard.posts.index', [
            //* Cari user_id dalam table post dan bandingkan dengan user id yang sudah di autentikasi.
            'posts' => Post::where('user_id', auth()->user()->id)->filter(request(['post']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            "categories" => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'category_id' => ['required'],
            'image' => ['image', 'file', 'max:1024'],
            'body' => ['required'],
        ]);
        
        // Jika input image ada isinya
        if($request->file('image')) {
            //* Mengambil extensi dari file gambar yang dikirim lewat form
            $extension = $request->file('image')->getClientOriginalExtension();
            //* membuat nama file baru
            $newName = $request->slug . '-' . now()->timestamp . '.' . $extension;
            $validateData['image'] = $request->file('image')->storeAs('post-images', $newName);
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validateData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            "post" => $post,
            "categories" => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'category_id' => ['required'],
            'image' => ['image', 'file', 'max:1024'],
            'body' => ['required'],
        ];

        //* Kalau value slug yang di isi di form input tidak sama dengan slug yang disimpan di database, maka lakukan pengecekan slug ke database.
        //* tetapi jika value nya sama maka lewati pengecekan.
        if($request->slug != $post->slug) {
            $rules['slug'] = ['required', 'unique:posts'];
        };

        $validateData = $request->validate($rules);
        
        if($request->file('image')) {
            if(request()->oldImage) {
                Storage::delete(request()->oldImage);
            }
            //* Mengambil extensi dari file gambar yang dikirim lewat form
            $extension = $request->file('image')->getClientOriginalExtension();
            //* membuat nama file baru
            $newName = $request->slug . '-' . now()->timestamp . '.' . $extension;
            $validateData['image'] = $request->file('image')->storeAs('post-images', $newName);
        }
        // dd($post->id);
        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        //* di dalam dokumentasi laravel, jika ingin update data ke database. kita harus melakukan pengecekan id/nilai dengan data yang dikirimkan menggunakan where terlebih dahulu.
        //* lalu setelah itu kita gunakan method update.
        Post::where('id', $post->id)
                ->update($validateData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image) {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
