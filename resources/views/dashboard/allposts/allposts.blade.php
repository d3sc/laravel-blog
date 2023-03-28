@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Posts</h1>
  </div>

  @if (session()->has('success'))
      <div class="alert alert-success col-lg-10" role="alert">
        {{ session('success') }}
      </div>
  @endif

  <div class="table-responsive col-lg-10">
      <form action="/dashboard/allposts" method="get">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search.." name="post" value="{{ request('post') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
                {{--* loop iteration digunakan untuk menghitung ada di pengulangan keberapa --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>
                    <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye" style="color: #222;"></span></a>
                    {{-- * /edit itu adalah bawaan dari route resource --}}
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit" style="color: #222;"></span></a>
                    <form class="d-inline-block" action="/dashboard/posts/{{ $post->slug }}" method="post">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0" type="submit" onclick="return confirm('are you sure?')"><span data-feather="x-circle" style="color: #222;"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{--* Memberikan link pagination --}}
        {{ $posts->links() }}
      </div>
@endsection