{{-- //* View adalah tempat yang digunakan untuk menampilkan sebuah arsitektur dari sebuah website seperti isi dari html --}}

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    {{-- My Style --}}
    <link rel="stylesheet" href="css/style.css">

    <title>Ikbar Blog | {{ $title }}</title>
  </head>
  <body>

    {{-- include digunakan untuk memisah content yang telah dibuat pada file lain, mirip seperti include pada php. parameter pertama itu isinya direction dari file tersebut. --}}
    @include('partials.navbar')

    <div class="container mt-4">
        {{-- Digunakan untuk memberikan isi layout, yang nanti akan digunakan oleh child lain --}}
        @yield('container')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
  <script>
    // const halo = document.getElementById("halo");

    // console.log(halo);
    // halo.addEventListener("click", () => {
    //     console.log("halos")
    // })
  </script>
</html>
