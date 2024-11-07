<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMD3BXneEjRPq0Zq9Xq93D75z1Mdgi0tyrv0A+6" crossorigin="anonymous">

    <title>Laravel</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Contenedor para el navbar con Vue -->
    <div id="navbar-app">
        <Navbar></Navbar>
    </div>

    <!-- Contenedor principal donde se monta el contenido de la página -->
    <div id="app">
        @yield('content')
    </div>
</body>

</html>