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
<body class="relative" 
    x-data="{
        open : false, 
        dropdown : false,
        scrolled: false 
    }">
    <header  
        class="transition-all ease-in-out duration-700"
        style="background : linear-gradient(180deg,rgba(24, 24, 24, 0.656) 33%,rgba(8, 8, 8, 0) 100%); height: 102px"
        x-init="$watch('scrolled', () => console.log(scrolled))"
        :style="scrolled ? 'background : rgba(20,20,20,0.3); height : 80px; backdrop-filter: blur(15px); padding-bottom: 2px' : 'linear-gradient(180deg,rgba(24, 24, 24, 0.656) 33%,rgba(8, 8, 8, 0) 100%)'"
        @scroll.window="scrolled = (window.scrollY > window.innerHeight/8)">
        <x-navbar/>
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer>

    </footer>
</body>
</html>