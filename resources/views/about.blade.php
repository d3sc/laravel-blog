@extends('layouts.main')

@section('container')

<!-- Mengambil nilai variable dari route get about di file web.php, yang sudah ada di array.
dan cara memanggil nya ambil key dari array nya dan dipanggil sebagai variable dalam php -->

{{-- Menggunakan sintaks dari blade --}}
<p>{{ $name }}</p>
<p>{{ $email }}</p>
<img src="{{ $image }}" alt="{{ $name }}" width="300">

@endsection
