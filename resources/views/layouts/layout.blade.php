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
<body class="relative no-transition bg-neutral-100" style="height: 100%"
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

    <div class="fixed bottom-0 w-full left-0 bg-neutral-950 h-20 z-40 border-t-2 border-neutral-800 md:hidden">
        <ul class="flex justify-center items-center h-full w-full">
            <li class="h-full w-full border-r border-neutral-800">
                <a href="" class="text-sm text-white font-semibold flex flex-cols items-center justify-center h-full w-full">
                    Accueil
                </a>
            </li>

            <li class="h-full w-full border-x border-neutral-800">
                <a href="" class="text-sm text-white font-semibold flex flex-cols items-center justify-center h-full w-full">
                    Films
                </a>
            </li>

            <li class="h-full w-full border-x border-neutral-800">
                <a href="" class="text-sm text-white font-semibold flex flex-cols items-center justify-center h-full w-full">
                    Seances
                </a>
                
            </li>

            <li class="h-full w-full border-l border-neutral-800">
                <a href="" class="text-sm text-white font-semibold flex flex-cols items-center justify-center h-full w-full">
                    Compte
                </a>
            </li>
        </ul>
    </div>
    <main>
        @yield('content')
    </main>
    
    <footer>

    </footer>
</body>
</html>