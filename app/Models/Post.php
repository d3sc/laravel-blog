<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//* ini digunakan untuk mengaktifkan library sluggable
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory, Sluggable;

    //* Membuat method local scope yang hanya bisa diakses di models post saja
    //* jadi dengan kata lain kita dapat membuat method sendiri lalu digunakan untuk mengatur data pada model.
    public function scopeFilter($query, array $filters)
    {
        //* Menggunakan Null Coalescing OPT, cara kerja nya sama seperti Ternary, tetapi lebih ringkas
        //* (Condition ?? false);

        //* Penggunaan when itu sama seperti if tetapi di jadikan function/method. agar lebih pendek
        //* when(condition, callback)
        $query->when($filters['search'] ?? false, fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'));
        //* membuat filter di halaman dashboard.posts.index
        $query->when($filters['post'] ?? false, fn ($query, $post) => $query->where('title', 'like', '%' . $post . '%'));


        // mengambil isi dari input yang dikirim ke url.
        $query->when($filters['category'] ?? false, function ($query, $category) {
            // method whereHas digunakan untuk mencari dan mengambil table yang mempunyai relationship
            return $query->whereHas('category', function ($query) use ($category) {
                // mencocok-kan, slug yang ada di post di miripkan sesuai dengan slug yang ada di table category. lalu setelah ketemu panggil isinya.
                $query->where('slug', $category);
            });
        });

        // mengambil isi dari input yang dikirim ke url.
        $query->when($filters['author'] ?? false, function ($query, $author) {
            // method whereHas digunakan untuk mencari dan mengambil table yang mempunyai relationship
            return $query->whereHas('author', fn ($query) =>
            $query->where('username', $author));
        });
    }

    protected $guarded = ['id'];
    //* Menuliskan method with yang nanti setiap data yang keluar akan menjalankan method with.
    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //* liat di dokumentasi Customizing The Key pada laravel 
    //* Mengubah Route key name menjadi slug, yang tadinya harus mengirim menggunakan id bisa menjadi slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //* menggunakan method ini untuk mengaktifkan library sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
