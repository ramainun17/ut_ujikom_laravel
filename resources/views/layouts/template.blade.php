<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zen Bengkel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icon/tools.svg') }}"/>
    
</head>
<body>  


    @include('layouts.navbar')

    @yield('content')
    <style>
      .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: transparent;
        transition: background-color 0.3s ease;
        margin-bottom: 10px;
      }
    </style>
    <script>
      const nav = document.getElementById('navbar');
      const mentok = navbar.offsetTop + 20;

      window.addEventListener('scroll', function() {
        if (window.pageYOffset > mentok) {
          nav.classList.add('navbar-white');
        } else {
          nav.classList.remove('navbar-white');
        }
      });
    </script>
    <style>
      .navbar-white {
        background-color: white;
      }
    </style>
    <script>
      // Mengecek apakah ada pesan sukses dalam sesi
      var successMessage = "{{ session('success') }}";
  
      // Menampilkan alert jika ada pesan sukses
      if (successMessage) {
          alert(successMessage);
      }
    </script>
    @auth
    
    @endauth
@include('layouts.footer')

</body>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    </html>