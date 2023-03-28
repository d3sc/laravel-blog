@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Post Categories</h1>
  </div>

  @if (session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
  @endif

  <div class="table-responsive col-lg-8">
    <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create new category</a>
      <form action="/dashboard/categories" method="get">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search.." name="categories" value="{{ request('categories') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
                {{--* loop iteration digunakan untuk menghitung ada di pengulangan keberapa --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    {{-- * /edit itu adalah bawaan dari route resource --}}
                    <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><span data-feather="edit" style="color: #222;"></span></a>
                    <form class="d-inline-block" action="/dashboard/categories/{{ $category->slug }}" method="post">
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
        {{ $categories->links() }}
      </div>
@endsection