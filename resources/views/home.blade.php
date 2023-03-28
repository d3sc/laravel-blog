{{-- Karena arah dari folder relatif dari views, maka dia akan masuk ke folder layouts lalu memilih file main.blade.php --}}
@extends('layouts.main')


{{-- jika menggunakan section, dia akan menggunakan @yield sesuai name yang ada di argument section. --}}
@section('container')
<h1>Halaman Home</h1> 
{{-- <button id="halo" onclick="this.setAttribute('disabled', 'true')">halo</button> --}}
@endsection