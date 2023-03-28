@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-8 mb-5 mt-3">
                <h2 class="mb-3">{{ $post->title }}</h2>

                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my Posts</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"></span> Edit</a>
                <form class="d-inline-block" action="/dashboard/posts/{{ $post->slug }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger my-auto" type="submit" onclick="return confirm('are you sure?')">Delete</button>
                </form>

                @if ($post->image)
                <div style="overflow:hidden mx-auto">
                    <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">    
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                @endif

                <p class="mt-3">created at: {{ $post->created_at }}, by. {{ $post->author->name }}</p>

                {{--* Dengan menggunakan {!! code !!} maka code yang di dalam jika terdapat tag html maka akan dijalankan juga --}}
                <article class="my-4 fs-5">
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
@endsection