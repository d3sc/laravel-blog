{{-- @dd digunakan untuk debug, dd yang artinya dump die. cara kerjanya sama seperti var_dump() yang ada di php. --}}
{{-- @dd($posts) --}}

{{-- Mengambil layout yang ada di file main.blade.php --}}
@extends('layouts.main')

{{-- Memasang layout, dengan menggunakan section --}}
@section('container')
<h1 class="mb-5">{{ $title }}</h1>
<div class="row justify-content-end">
    <div class="col-md-6">
        <form action="/authors" method="get">
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Search.." name="author" value="{{ request('author') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<ul>
    @foreach ($authors as $author)
    <li>
        <h5><a href="/posts?author={{ $author->username }}">{{ $author->username }}</a></h5>
    </li>
    @endforeach
</ul>
@endsection