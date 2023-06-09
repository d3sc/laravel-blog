{{-- Content bagian navbar yang dipisah, dan yang nantinya akan dipakai oleh include --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/">Ikbar Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ ($active == 'home') ? 'active' : ''}}" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active == 'about') ? 'active' : ''}}" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active == 'posts') ? 'active' : ''}}" href="/posts">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active == 'categories') ? 'active' : ''}}" href="/categories">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active == 'authors') ? 'active' : ''}}" href="/authors">Authors</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
      {{--* sebuah directive @auth berguna untuk menampilkan sesuatu kepada user yang telah terautentikasi/login --}}
        @auth
          
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{--* Memanggil nama user yang telah terautentikasi --}}
            Welcome Back, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
              </form>
            </li>
          </ul>
        </li>


      {{--* dan else di tengah @auth berguna untuk mengatasi jika user belum terautentikasi/login--}}
        @else
        <li class="nav-item">
          <a href="/login" class="nav-link {{ ($active == 'login') ? 'active' : ''}}"><i class="bi bi-box-arrow-in-right"></i> Log in</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>