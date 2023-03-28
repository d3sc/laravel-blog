@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create new Posts</h1>
  </div>

  <div class="col-lg-8">
      <form action="/dashboard/posts" method="post" class="mb-5" enctype="multipart/form-data">
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
        @error('title')
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
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
          @if (old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}" >{{ $category->name }}</option>
          @endif
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label @error('image') is-invalid @enderror">Post Image (Optional)</label>
        <img class="img-preview img-fluid my-3 mx-auto col-sm-5">
        <input class="form-control" type="file" id="image" name="image" oninput="previewImage()">
        @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      

      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
        <trix-editor input="body"></trix-editor>
        @error('body')
          <p class="text-danger">
            {{ $message }}
          </p>
        @enderror
      </div>
      
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
  <script>
    const title = document.getElementById('title');
    const slug = document.getElementById('slug');

    // event akan dijalankan jika selalu terjadi perubahan pada element title
    title.addEventListener('keyup', () => {
      //* Melakukan request dengan menggunakan fetch, yang mengirimkan checkSlug yang mempunyai id title yng berisi title.value (isi dari title).
      // coba buka = http://127.0.0.1:8000/dashboard/posts/checkSlug?title=halo+saya+keren , nah data itu akan dimasukkan kedalam value slug.
      fetch('/dashboard/posts/checkSlug?title=' + title.value)
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