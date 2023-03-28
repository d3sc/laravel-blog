{{-- //* file untuk detail dari post --}}

{{-- @dd($post) --}}
@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-5 mt-3">
                <h2 class="mb-3">{{ $post->title }}</h2>
                <p>By. <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

                @if ($post->image)
                <div style="overflow:hidden">
                    <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">    
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
                @endif

                <p class="mt-3">created at: {{ $post->created_at }}, by. {{ $post->author->name }}</p>

                {{--* Dengan menggunakan {!! code !!} maka code yang di dalam jika terdapat tag html maka akan dijalankan juga --}}
                <article class="my-4 fs-5">
                    {!! $post->body !!}
                </article>

                <a href="/posts" class="d-block mt-5">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection