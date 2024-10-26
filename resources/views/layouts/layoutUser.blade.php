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
<body class=" bg-zinc-200 dark:bg-zinc-800 relative" 
    x-data="{
        open : false, 
        dropdown : false,
        scrolled: false 
    }">
    <header>
        <div class="fixed top-0 left-0 h-14  w-full z-2 shadow-lg flex items-center px-6 gap-10" style="background : rgba(20,20,20,0.6); backdrop-filter: blur(15px);">
            <img width="35px" src="{{Storage::url('assets/mainLogo.png')}}" alt="">

            <ul class="row space-x-6 hidden md:flex">
                <li class="navBar-li"><a href="{{ route('index') }}">Accueil</a></li>
                <li class="navBar-li"><a href="{{ route('films.index') }}">Films</a></li>
                <li class="navBar-li"><a href="{{ route('seances.index') }}">Seances</a></li>
                <li class="navBar-li"><a href="">Contact</a></li>
            </ul>
            <p class="text-white text-xl font-base md:hidden">Le Cinéma</p>
        </div>
    </header>

    <main class="absolute top-0 left-0 w-full">
        @yield('content')
    </main>

    <x-bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/>
    
    <footer>

    </footer>
</body>
</html>