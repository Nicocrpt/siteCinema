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
<body class=" bg-neutral-100 dark:bg-zinc-800 relative overscroll-none solaris" 
    x-data="{
        open : false, 
        dropdown : false,
        scrolled: false 
    }">
    <header>
        <x-navbars.navbar background="bg-black" search="false"/>
    </header>

    <main class="w-full">
        @yield('content')
    </main>

    {{-- <x-menus.bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/> --}}
    
    <footer>
        
    </footer>
</body>
</html>