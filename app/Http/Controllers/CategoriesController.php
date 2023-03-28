<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function categories()
    {
        return view('categories', [
            'title' => 'Post Categorieses',
            "active" => 'categories',
            // Panggil semua isi yang ada di model Category
            'categories' => Category::latest()->filter(request(['categories']))->get(),
        ]);
    }
}
