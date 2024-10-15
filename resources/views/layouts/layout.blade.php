<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="relative bg-stone-900" 
    x-data="{
        open : false, 
        dropdown : false 
    }">
    <header  style="background : linear-gradient(180deg,rgba(24, 24, 24, 0.656) 33%,rgba(8, 8, 8, 0) 100%); height: 102px">
        <x-navbar/>
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer>

    </footer>
</body>
</html>