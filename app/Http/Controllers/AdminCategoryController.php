<?php

namespace App\Http\Controllers;

use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //* method check adalah kebalikan dari method guest. method check akan mengecek apakah user sudah login/belum, jika belum maka bernilai false.
        //* dan kalau guest adalah method yang menyatakan bahwa user belum login, dan kalau sudah login akan bernilai false.
        // if(!auth()->check() || auth()->user()->username !== "admin") {
        //     abort(403);
        // }

        return view('dashboard.categories.index', [
            'categories' => Category::latest()->filter(request(['categories']))->paginate(10)->WithQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
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
            'name' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
        ]);

        Category::create($validateData);

        return redirect('/dashboard/categories')->with('success', 'New post category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd('halo');
        return view('dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => ['required', 'max:255'],
        ];

        //* Kalau value slug yang di isi di form input tidak sama dengan slug yang disimpan di database, maka lakukan pengecekan slug ke database.
        //* tetapi jika value nya sama maka lewati pengecekan.
        if($request->slug != $category->slug) {
            $rules['slug'] = ['required', 'unique:posts'];
        };

        $validateData = $request->validate($rules);

        //* di dalam dokumentasi laravel, jika ingin update data ke database. kita harus melakukan pengecekan id/nilai dengan data yang dikirimkan menggunakan where terlebih dahulu.
        //* lalu setelah itu kita gunakan method update.
        Category::where('id', $category->id)
                ->update($validateData);

        return redirect('/dashboard/categories')->with('success', 'Post Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/dashboard/categories')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
