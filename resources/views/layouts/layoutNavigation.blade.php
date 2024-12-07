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
<body class=" bg-neutral-50 dark:bg-zinc-800"
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
    
    <main class="absolute top-0 left-0 w-full h-[100%]">
        @yield('content')
    </main>

    {{-- <x-menus.bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/> --}}
    
    <footer>

    </footer>
</body>
</html>