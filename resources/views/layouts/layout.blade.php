<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="relative no-transition w-full dark:bg-zinc-950 bg-zinc-100  overscroll-none solaris"
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
        class="transition-all ease-in-out duration-700 h-14 w-full z-30 fixed"
        :class="scrolled ? 'backdrop-blur-[15px]' : ''"
        x-init="$watch('scrolled', () => {if(scrolled) {document.querySelector('main').classList.add('min-h-screen') }})"
        :style="scrolled ? 'background : rgba(20,20,20,0.3); height : 3.5rem; padding-bottom: 2px' : 'background : linear-gradient(180deg,rgba(0, 0, 0, 0.3) 5%,rgba(0, 0, 0, 0) 100%)'"
        @scroll.window="scrolled = (window.scrollY > window.innerHeight/20)">
        <x-navbars.navbar background="'bg-transparent'" search="true"/>
        
    </header>
    <x-loading-screen/>
    <x-modals.search-modal class="transition-all ease-in-out duration-300 overflow-hidden min-h-full"/>




    {{-- <x-menus.bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/> --}}

    

    <main class="dark:bg-zinc-950 bg-zinc-200">
        @yield('content')
    </main>
    
    <footer>
        <x-footer/>
    </footer>
</body>
</html>