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
  @if (session()->has('warning'))
      <div class="alert alert-warning col-lg-10" role="alert">
        {{ session('warning') }}
      </div>
  @endif

  <div class="table-responsive col-lg-10">
      <form action="/dashboard/newadmin" method="get">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search.." name="author" value="{{ request('author') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">username</th>
              <th scope="col">is banned</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
                {{--* loop iteration digunakan untuk menghitung ada di pengulangan keberapa --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->is_banned }}</td>
                <td>
                  <form action="/dashboard/banned-user/add" method="post" class="d-inline-block">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit" class="border-0 badge bg-success" onclick="return confirm('This user will be unbanned, are you sure?')"><span data-feather="check" style="color: #222;"></span></button>
                  </form>
                  <form action="/dashboard/banned-user/delete" method="post" class="d-inline-block">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit" class="border-0 badge bg-danger" onclick="return confirm('banned this user, are you sure?')"><span data-feather="slash" style="color: #222;"></span></button>
                  </form>
                    {{-- <a href="/dashboard/banned-user?unBannedUser={{ $user->username }}" class="badge bg-success" onclick="return confirm('This user will be unbanned, are you sure?')"><span data-feather="check" style="color: #222;"></span></a>
                    <a href="/dashboard/banned-user?bannedUser={{ $user->username }}" class="badge bg-danger" onclick="return confirm('delete this user, are you sure?')"><span data-feather="x-circle" style="color: #222;"></span></a> --}}
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{--* Memberikan link pagination --}}
        {{ $users->links() }}
      </div>
@endsection