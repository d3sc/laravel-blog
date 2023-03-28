@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create new Posts</h1>
  </div>

  <div class="col-lg-8">
      <form action="/dashboard/categories" method="post" class="mb-5">
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Category Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly required value="{{ old('slug') }}">
        @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
  <script>
    const name = document.getElementById('name');
    const slug = document.getElementById('slug');

    // event akan dijalankan jika selalu terjadi perubahan pada element name
    name.addEventListener('keyup', () => {
      //* Melakukan request dengan menggunakan fetch, yang mengirimkan checkSlug yang mempunyai id name yng berisi name.value (isi dari name).
      // coba buka = http://127.0.0.1:8000/dashboard/categories/checkSlug?name=halo+saya+keren , nah data itu akan dimasukkan kedalam value slug.
      fetch('/dashboard/categories/checkSlug?name=' + name.value)
      // Ubah response menjadi json
      .then(res => res.json())
      // mengisi value dari slug dengan data yang telah didapatkan dari request dari fetch, kedalam value slug
      .then(data => processData(data))
    })

    const processData = (data) => {
      slug.setAttribute('value', data.slug);
      slug.value = data.slug;
    }

    document.addEventListener('trix-file-accept', (e) => {
      e.preventDefault();
    })
  </script>
@endsection