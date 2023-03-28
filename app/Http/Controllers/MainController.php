<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function root()
    {
        //* jika menggunakan method view(), artinya direktori sudah relatif terhadap folder views.
        // mengembalikan nilai, file yang ada di folder views lalu nama file nya.
        // karena dibawah ini home, berarti panggil file home yang ada di folder views
        return view('home', [
            "title" => "Home",
            "active" => "home",
        ]);
    }

    public function about()
    {
        //* memberikan tambahan parameter kedua akan membuat simpanan variable yang di berisi data di dalam routes.
        // yang dimana nanti data akan dapat dipanggil di dalam file tersebut dengan menggunakan key.
        return view('about', [
            //* key dari array tersebut akan dipanggil nanti menjadi variable dalam php
            // "key" => "value",
            "title" => "About",
            "active" => "about",
            "name" => "Ikbar",
            "email" => "vinary686@gmail.com",
            "image" => "img/kerja.png"
        ]);
    }
}
