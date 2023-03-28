{{-- @dd digunakan untuk debug, dd yang artinya dump die. cara kerjanya sama seperti var_dump() yang ada di php. --}}
{{-- @dd($posts) --}}

{{-- Mengambil layout yang ada di file main.blade.php --}}
@extends('layouts.main')

{{-- Memasang layout, dengan menggunakan section --}}
@section('container')
<h1 class="mb-5">{{ $title }}</h1>

<div class="container">

<div class="row justify-content-end mb-5">
    <div class="col-md-6">
        <form action="/categories" method="get">
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Search.." name="categories" value="{{ request('categories') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

    <div class="row categories-row">
        @foreach ($categories as $category)
        <div class="col-md-4">
        <a href="/posts?category={{ $category->slug }}">
            <div class="card text-bg-dark ">
                <img src="https://source.unsplash.com/500x400?{{ $category->name }}" class="card-img" alt="...">
                <div class="card-img-overlay d-flex align-items-center p-0">
                <h5 class="card-title text-white flex-fill text-center p-4 fs-3" style="background-color: rgba(0,0,0,0.7);">{{ $category->name }}</h5>
                </div>
            </div>
        </a> 
        </div>
        @endforeach
    </div>
</div>
@endsection