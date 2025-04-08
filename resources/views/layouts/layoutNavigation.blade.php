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
    @if (isset($contactTitle))
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    @endif
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class=" bg-neutral-100 dark:bg-zinc-900 solaris max-w-screen overflow-x-hidden"
x-data="{
    open : false, 
    dropdown : false,
    loading : true
}"
x-init="window.onload = () => loading = false; document.body.classList.remove('no-transition');">
    
    <header class="z-30 w-full fixed">
        <x-navbars.navbar background="bg-black" search="false"/>
    </header>

    <x-loading-screen/>
    
    <main class="w-full max-w-full">
        @yield('content')
    </main>

    {{-- <x-menus.bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/> --}}
    
    <footer class="">
        
    </footer>
</body>
</html>