<?php

//* Model adalah tempat yang digunakan untuk mengatur data

namespace App\Models;

class Post
{
    // Membuat property static yang nantinya digunakan didalam class
    static $blog_posts =
    [
        [
            "title" => "Judul Post pertama",
            "slug" => "judul-post-pertama",
            "author" => "Ikbar rabbani",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et sapiente quae ipsum voluptates voluptatibus? Necessitatibus quasi dignissimos veritatis sequi recusandae dolorum voluptatibus enim dolore excepturi sunt repudiandae quidem dicta blanditiis, ullam culpa vero optio pariatur. Cupiditate ab iure accusantium animi molestiae. Libero distinctio voluptates dolores architecto molestias recusandae eligendi ad laboriosam laudantium delectus labore eos, ex rem quod iure! Et maiores provident minus voluptatibus. Praesentium magnam, alias doloremque, hic odio autem esse quam magni maiores excepturi consequatur eveniet at quis."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Asep Ferdiansyah",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore voluptate, velit autem sint voluptates, quidem magni laboriosam vero quo, ipsum reprehenderit sapiente similique quae excepturi quasi error saepe libero commodi maxime? Nam accusamus, voluptatibus vero aut a eum perspiciatis, sequi distinctio quia, in voluptate porro adipisci. Amet praesentium nihil porro itaque odit optio, ut explicabo repellendus fuga, voluptatum non iusto aperiam nobis quia cumque, error laborum quidem omnis! Reiciendis, a repudiandae? Accusamus distinctio eos placeat temporibus inventore sequi veritatis esse fugit optio. Velit molestiae quas in? Ipsa accusamus commodi iure mollitia eius, laborum recusandae corporis error adipisci placeat voluptate repellat."
        ]
    ];

    // Membuat function public static yang nantinya akan digunakan di luar class
    public static function all()
    {
        //* self khusu digunakan untuk memanggil property yang static pada class
        // Mengakses property $blog_posts dengan menggunakan self::
        // Menggunakan self dikarenakan untuk memanggil property yang static
        return collect(self::$blog_posts);
        //* Jika menggunakan collect dia akan menjadi array yang spesial, seperti bisa dimodifikasi oleh method tertentu (map, first, firstWhere, dll)
    }

    public static function find($slug)
    {
        //* static khusus digunakan untuk memanggil mehtod yang static pada class
        // Menggunakan static dikarenakan untuk memanggil method all
        $posts = static::all();

        //* Cara pertama menyaring data
        // Memilih data yang sama antara parameter $slug dengan slug yang ada pada data property $blog_posts.
        // $post = [];
        // foreach ($posts as $p) {
        //     if ($p["slug"] == $slug) {
        //         $post = $p;
        //     }
        // }

        //* Cara kedua menyaring data
        // method firstWhere digunakan dengan cara mencari data yang pertama ditemukan, 
        // dengan kondisi property slug pada data array sama dengan $slug yang ada pada parameter
        return $posts->firstWhere('slug', $slug);
    }
}
