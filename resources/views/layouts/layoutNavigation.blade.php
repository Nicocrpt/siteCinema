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
    
    <header class="z-30">
        
        <nav class="fixed top-0 h-14  w-full z-2 shadow-lg flex items-center justify-between px-5" style="background : rgba(0,0,0,0.8); backdrop-filter: blur(8px);">
            <x-menus.menu-hamb/>
            <div class="flex md:gap-10 gap-3 items-center">
                <img width="35px" src="{{Storage::url('assets/mainLogo.png')}}" alt="" class="hidden md:block">
                <ul class="row  md:flex space-x-6 hidden">
                    <li class="navBar-li"><a href="{{ route('index') }}">Accueil</a></li>
                    <li class="navBar-li"><a href="{{ route('films.index') }}">Films</a></li>
                    <li class="navBar-li"><a href="{{ route('seances.index') }}">Seances</a></li>
                    <li class="navBar-li"><a href="">Contact</a></li>
                </ul>
                <p class="text-white text-xl font-base md:hidden">Le Solaris</p>
            </div>
            
            @if (Auth::check())
                <div class="relative md:inline-block hidden">
                    <a @click="dropdown = !dropdown" class="navBar-account flex items-center gap-2 group cursor-pointer" >
                        <svg width="22px" class="group-hover:text-cyan-600" height="30px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3C9.56586 3 7.59259 4.95716 7.59259 7.37143C7.59259 9.7857 9.56586 11.7429 12 11.7429C14.4341 11.7429 16.4074 9.7857 16.4074 7.37143C16.4074 4.95716 14.4341 3 12 3Z" fill="#ffffff"></path> <path d="M14.601 13.6877C12.8779 13.4149 11.1221 13.4149 9.39904 13.6877L9.21435 13.7169C6.78647 14.1012 5 16.1783 5 18.6168C5 19.933 6.07576 21 7.40278 21H16.5972C17.9242 21 19 19.933 19 18.6168C19 16.1783 17.2135 14.1012 14.7857 13.7169L14.601 13.6877Z" fill="#ffffff"></path> </g></svg>
                        Mon compte 
                    </a>
        
        
                    <div @click.away="dropdown = false" class="p-1 absolute right-0 z-10 mt-4 w-48 origin-top-right  rounded-md bg-stone-600 bg-opacity-100 shadow-lg focus:outline-none"  role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" x-show="dropdown"
                    x-transition:enter="transition ease-out duration-200" 
                x-transition:enter-start="transform opacity-0 scale-y-50" 
                x-transition:enter-end="transform opacity-100 scale-y-100" 
                x-transition:leave="transition ease-in duration-150" 
                x-transition:leave-start="transform opacity-100 scale-y-100" 
                x-transition:leave-end="transform opacity-0 scale-y-50">
                        <div class=" hover:bg-white hover:bg-opacity-30 rounded" role="none">
                            <a href="{{route('home')}}" class="block px-4 py-2 text-sm text-white opacity-100"  tabindex="-1" id="menu-item-0"><span class="text-white">Voir mon compte</span></a>
                        </div>
                        <div class="mt-1 hover:bg-white hover:bg-opacity-30 rounded" role="none">
                            <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-white hover:text-red-500" role="menuitem" tabindex="-1" id="menu-item-1">Me déconnecter</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            
            @else
                <div class="md:flex items-center gap-5 hidden">
                    <a href="{{ route('login')}}" class="navBar-account flex items-center gap-2 group" >
                        Se connecter
                    </a>
                    <a href="{{ route('register')}}" class="navBar-account flex items-center gap-2 group" >
                        S'inscire
                    </a>
                </div>
        
            @endif
            </nav>
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