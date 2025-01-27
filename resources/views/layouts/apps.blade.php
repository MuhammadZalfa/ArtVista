<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css','resources/js/app.js'])
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.25/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.25/dist/sweetalert2.min.css" rel="stylesheet">
    <style>  
        .font-italiana {  
            font-family: 'Italiana', serif;  
        }  
        .font-francois {
            font-family: 'Jacques Francois', serif;
        }
        .bg-custom {
            background-image: url('{{ asset('images/bg.png') }}'); /* Gambar background */
            background-size: cover; /* Menutupi seluruh area header */
            background-position: center; /* Menjaga posisi gambar tetap di tengah */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            height: auto; /* Tinggi akan menyesuaikan isi konten */
            min-height: 100vh;
        }
        .bg2-custom {
            background-image: url('{{ asset('images/bg2.png') }}'); /* Gambar background */
            background-size: cover; /* Menutupi seluruh area header */
            background-position: center; /* Menjaga posisi gambar tetap di tengah */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            height: auto; /* Tinggi akan menyesuaikan isi konten */
            min-height: 100vh;
        }
        body {
            margin: 0;
            padding: 0;
        }
    </style>  
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Header -->
    <div class="main">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
