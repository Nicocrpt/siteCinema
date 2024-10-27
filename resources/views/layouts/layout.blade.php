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
<body class="relative no-transition h-full w-full bg-zinc-800"
    x-data="{
        open : false, 
        dropdown : false,
        scrolled: false,
        loading : true,
        burgerMenu: false
    }"
    x-init="window.onload = () => loading = false; document.body.classList.remove('no-transition');"
    :class="open ? 'overflow-hidden' : 'overflow-auto'"
    >
    <header  
        class="transition-all ease-in-out duration-700 h-14 w-full z-40"
        x-init="$watch('scrolled', () => console.log(scrolled))"
        :style="scrolled ? 'background : rgba(20,20,20,0.3); height : 3.5rem; backdrop-filter: blur(15px); padding-bottom: 2px' : 'background : linear-gradient(180deg,rgba(0, 0, 0, 0.3) 5%,rgba(0, 0, 0, 0) 100%)'"
        @scroll.window="scrolled = (window.scrollY > window.innerHeight/8)">
        <x-navbar/>
        
    </header>
    <x-loading-screen/>
    <x-search-modal class="transition-all ease-in-out duration-300 overflow-hidden min-h-full"/>




    <x-bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/>

    {{-- <x-floating-burger-menu/> --}}



    <main>
        @yield('content')
    </main>
    
    <footer>

    </footer>
</body>
</html>