<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title')</title>
</head>
    <body class="relative">
        <img class="absolute top-0 left-0 w-full h-full object-cover" src="{{ asset('img/brick.png') }}" alt="Imagen de fondo">
        
        <div class="relative z-10">
            @yield('content')
        </div>
    </body>
</html>