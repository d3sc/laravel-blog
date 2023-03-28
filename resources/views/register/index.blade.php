@extends('layouts.main')


@section('container')

<div class="row justify-content-center ">
    <div class="col-lg-6">
        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
      <form action="/register" method="post">

        {{--* fungsi dibawah ini digunakan untuk memberikan token yang sesuai dengan form kita, agar menghindari serangan csrf --}}
        @csrf
        <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Your name" required {{-- method old('name') adalah fungsi yang digunakan jika terdapat error, value yang telah di isi tidak akan hilang pada input. --}} value="{{ old('name') }}">
          <label for="name">Name</label>
          {{--* fungsi dibawah ini digunakan untuk menangani/menampilkan error yang terjadi jika method validate yang ada pada RegisterController terdapat error --}}
          @error("name")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Your username" required value="{{ old('username') }}">
          <label for="username">Username</label>
          @error("username")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
          <label for="email">Email address</label>
          @error("email")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required value="{{ old('password') }}">
          <label for="password">Password</label>
          @error("password")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
    
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
      </form>

      <small class="d-block text-center mt-3">
        Already Registered? <a href="/login">Login</a> 
      </small>
    </main>
    </div>
</div>

@endsection