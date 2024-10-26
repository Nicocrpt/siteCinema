<nav class="md:mx-5 mx-2 flex justify-between items-center h-14 navigation bg-transparent md:flex-row flex-row-reverse">
    <div class="flex items-center md:gap-10 gap-5 md:flex-row flex-row-reverse">
        <a cursor="pointer" @click="open = true">
            <svg class="w-[42px] h-[42px] md:w-10 md:h-10 p-2 rounded-md hover:bg-slate-300 hover:bg-opacity-40 cursor-pointer transition-all ease-in-out duration-300" fill="#ffffff" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M497.938,430.063l-126.914-126.91C389.287,272.988,400,237.762,400,200C400,89.719,310.281,0,200,0 C89.719,0,0,89.719,0,200c0,110.281,89.719,200,200,200c37.762,0,72.984-10.711,103.148-28.973l126.914,126.91 C439.438,507.313,451.719,512,464,512c12.281,0,24.563-4.688,33.938-14.063C516.688,479.195,516.688,448.805,497.938,430.063z M64,200c0-74.992,61.016-136,136-136s136,61.008,136,136s-61.016,136-136,136S64,274.992,64,200z"></path> </g> </g></svg>
        </a>
        <img width="35px" src="{{Storage::url('assets/mainLogo.png')}}" alt="" class="hidden md:block">
        <ul class="lg:space-x-6 md:space-x-4 md:flex hidden">
            <li class="navBar-li"><a href="{{ route('index') }}">Accueil</a></li>
            <li class="navBar-li"><a href="{{ route('films.index') }}">Films</a></li>
            <li class="navBar-li"><a href="{{ route('seances.index') }}">Seances</a></li>
            <li class="navBar-li"><a href="">Contact</a></li>
        </ul>
    </div>
    
    @if (Auth::check())
        <div class="relative md:inline-block hidden">
            <div>
                <a @click="dropdown = !dropdown" class="navBar-account flex items-center gap-2 group cursor-pointer" >
                    <svg width="22px" class="group-hover:text-cyan-600" height="30px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3C9.56586 3 7.59259 4.95716 7.59259 7.37143C7.59259 9.7857 9.56586 11.7429 12 11.7429C14.4341 11.7429 16.4074 9.7857 16.4074 7.37143C16.4074 4.95716 14.4341 3 12 3Z" fill="#ffffff"></path> <path d="M14.601 13.6877C12.8779 13.4149 11.1221 13.4149 9.39904 13.6877L9.21435 13.7169C6.78647 14.1012 5 16.1783 5 18.6168C5 19.933 6.07576 21 7.40278 21H16.5972C17.9242 21 19 19.933 19 18.6168C19 16.1783 17.2135 14.1012 14.7857 13.7169L14.601 13.6877Z" fill="#ffffff"></path> </g></svg>
                    Mon compte 
                </a>
    
    
                <div @click.away="dropdown = false" class="p-1 absolute right-0 z-10 mt-4 w-48 origin-top-right  rounded-md bg-stone-600 bg-opacity-60 shadow-lg focus:outline-none backdrop-blur"  role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" x-show="dropdown"
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
    <div class=" items-center gap-5 md:flex hidden">
        <a href="{{ route('login')}}" class="navBar-account flex items-center gap-2 group" >
            Se connecter
        </a>
        <a href="{{ route('register')}}" class="navBar-account flex items-center gap-2 group" >
            S'inscire
        </a>
    </div>
    @endif

    <div class="flex items-center justify-center gap-3 md:hidden">
        <img width="35px" src="{{Storage::url('assets/mainLogo.png')}}" alt="">
        <p class="text-xl text-white font-base">Le Cinéma</p>
    </div>
    
        

</nav>