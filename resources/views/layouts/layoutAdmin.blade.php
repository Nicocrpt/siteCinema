<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-zinc-950 h-screen flex flex-col" x-data="{loading : true}" x-init="window.onload = () => loading = false; document.body.classList.remove('no-transition');">
    <header class="h-16 w-full flex items-center p-4 md:px-6 lg:px-10 justify-between">
        <div class="flex gap-6 items-center" x-data="{rotation : 0}">
            <svg
                 fill="#ffffff" @click="rotation += 180" class="w-[40px] transition-all ease-in-out duration-[1.5s] cursor-pointer" :style="'transform: rotate(' + rotation + 'deg)'" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.002 512.002" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M255.998,120.138c-74.914,0-135.862,60.948-135.862,135.862s60.948,135.862,135.862,135.862S391.86,330.914,391.86,256 S330.912,120.138,255.998,120.138z M255.998,376.138c-66.244,0-120.138-53.894-120.138-120.138s53.894-120.138,120.138-120.138 S376.136,189.756,376.136,256S322.242,376.138,255.998,376.138z"></path> <rect x="248.132" width="15.723" height="104.004"></rect> <rect x="204.41" y="77.295" transform="matrix(0.1737 0.9848 -0.9848 0.1737 270.5177 -152.095)" width="42.967" height="15.723"></rect> <rect x="147.778" y="97.896" transform="matrix(0.5 0.866 -0.866 0.5 176.2168 -93.7057)" width="42.967" height="15.723"></rect> <rect x="101.628" y="136.626" transform="matrix(-0.766 -0.6428 0.6428 -0.766 124.5386 334.3051)" width="42.966" height="15.723"></rect> <rect x="85.111" y="175.186" transform="matrix(0.342 -0.9397 0.9397 0.342 -123.6348 216.775)" width="15.723" height="42.968"></rect> <rect x="61.036" y="248.134" width="42.966" height="15.723"></rect> <rect x="71.491" y="307.47" transform="matrix(-0.9397 0.342 -0.342 -0.9397 288.1874 579.851)" width="42.968" height="15.723"></rect> <rect x="101.599" y="359.634" transform="matrix(-0.7661 0.6428 -0.6428 -0.7661 453.5869 569.907)" width="42.969" height="15.724"></rect> <rect x="161.387" y="384.747" transform="matrix(0.866 0.5 -0.5 0.866 225.7961 -30.199)" width="15.723" height="42.967"></rect> <rect x="217.994" y="405.378" transform="matrix(-0.9848 -0.1736 0.1736 -0.9848 374.1774 886.4498)" width="15.723" height="42.966"></rect> <rect x="264.622" y="418.964" transform="matrix(-0.1737 -0.9848 0.9848 -0.1737 -84.5358 782.7211)" width="42.966" height="15.723"></rect> <rect x="321.241" y="398.39" transform="matrix(-0.5 -0.866 0.866 -0.5 162.268 906.1877)" width="42.967" height="15.723"></rect> <rect x="367.381" y="359.643" transform="matrix(0.766 0.6428 -0.6428 0.766 327.2243 -163.9794)" width="42.966" height="15.723"></rect> <rect x="397.539" y="307.477" transform="matrix(0.9397 0.342 -0.342 0.9397 133.1127 -124.2909)" width="42.968" height="15.723"></rect> <rect x="407.996" y="248.134" width="42.966" height="15.723"></rect> <rect x="397.536" y="188.819" transform="matrix(0.9397 -0.342 0.342 0.9397 -41.9979 155.1646)" width="42.968" height="15.723"></rect> <rect x="367.429" y="136.621" transform="matrix(0.7661 -0.6428 0.6428 0.7661 -1.8874 283.7811)" width="42.969" height="15.724"></rect> <rect x="334.886" y="84.276" transform="matrix(-0.866 -0.5 0.5 -0.866 586.6924 368.7268)" width="15.723" height="42.967"></rect> <rect x="278.258" y="63.66" transform="matrix(0.9848 0.1736 -0.1736 0.9848 19.126 -48.3792)" width="15.723" height="42.966"></rect> <rect x="134.216" y="56.443" transform="matrix(0.342 0.9397 -0.9397 0.342 182.959 -132.6761)" width="104.004" height="15.723"></rect> <rect x="72.871" y="91.866" transform="matrix(0.6428 0.766 -0.766 0.6428 120.9948 -60.0334)" width="104.001" height="15.723"></rect> <rect x="27.325" y="146.135" transform="matrix(0.866 0.5 -0.5 0.866 87.6282 -19.0312)" width="104.002" height="15.723"></rect> <rect x="3.086" y="212.716" transform="matrix(0.9848 0.1737 -0.1737 0.9848 39.1517 -6.2158)" width="104.004" height="15.723"></rect> <rect x="3.111" y="283.559" transform="matrix(0.9848 -0.1737 0.1737 0.9848 -49.7819 14.0032)" width="104.004" height="15.723"></rect> <rect x="27.32" y="350.131" transform="matrix(0.866 -0.5 0.5 0.866 -168.3728 87.6254)" width="104.002" height="15.723"></rect> <rect x="72.853" y="404.42" transform="matrix(0.6428 -0.766 0.766 0.6428 -271.2199 242.9003)" width="104.001" height="15.723"></rect> <rect x="178.378" y="395.687" transform="matrix(-0.9397 -0.342 0.342 -0.9397 208.1387 932.0757)" width="15.723" height="104.004"></rect> <rect x="248.132" y="407.998" width="15.723" height="104.004"></rect> <rect x="273.774" y="439.845" transform="matrix(-0.342 -0.9397 0.9397 -0.342 16.4819 906.9549)" width="104.004" height="15.723"></rect> <rect x="335.101" y="404.425" transform="matrix(-0.6428 -0.766 0.766 -0.6428 320.1168 973.8383)" width="104.001" height="15.723"></rect> <rect x="380.676" y="350.147" transform="matrix(-0.866 -0.5 0.5 -0.866 628.3762 884.394)" width="104.002" height="15.723"></rect> <rect x="449.052" y="239.404" transform="matrix(0.1737 -0.9848 0.9848 0.1737 90.5708 690.757)" width="15.723" height="104.004"></rect> <rect x="404.887" y="212.739" transform="matrix(-0.9848 0.1737 -0.1737 -0.9848 945.1505 358.4856)" width="104.004" height="15.723"></rect> <rect x="380.671" y="146.14" transform="matrix(-0.866 0.5 -0.5 -0.866 884.3768 71.0287)" width="104.002" height="15.723"></rect> <rect x="335.129" y="91.848" transform="matrix(-0.6428 0.766 -0.766 -0.6428 712.3632 -132.7443)" width="104.001" height="15.723"></rect> <rect x="317.909" y="12.304" transform="matrix(0.9397 0.342 -0.342 0.9397 41.6369 -107.5362)" width="15.723" height="104.004"></rect> </g> </g> </g> </g>
            </svg>

            <div class="flex gap-6 items-center">
                <h1 class="lg:text-2xl text-xl font-bold text-white"><a href="{{route('admin.index')}}">Solaris Panel</a></h1>
                <ul class="hidden md:gap-3 md:flex lg:gap-5 justify-center">
                    <li class="hover:bg-white hover:bg-opacity-10 px-2 p-[0.2rem] rounded-b rounded-tr transition-all ease-in-out duration-200"><a class="text-white" href="{{route('admin.films.manage')}}">Films</a></li>
                    <li class="hover:bg-white hover:bg-opacity-10 px-2 p-[0.2rem] rounded-b rounded-tr transition-all ease-in-out duration-200"><a href="{{route('admin.seances.manage')}}" class="text-white">Séances</a></li>
                    <li class="hover:bg-white hover:bg-opacity-10 px-2 p-[0.2rem] rounded-b rounded-tr transition-all ease-in-out duration-200"><a href="" class="text-white">Gestion des employés</a></li>
                </ul>
            </div>
        </div>
        
        <div class="flex md:gap-4 lg:gap-8">
            <div class="flex md:gap-2 lg:gap-4">

                <div x-data="{dropdown : false}">
                    <svg @click="dropdown = !dropdown; console.log('hello')" viewBox="0 0 24 24" class="lg:w-[26px] md:w-[22px] transition-all ease-in-out duration-300 group hover:cursor-pointer" id="Layer_1" :class="dropdown ? 'rotate-90' : 'rotate-0'" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" class="fill-zinc-200"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:none;stroke-miterlimit:10;stroke-width:2px;}</style></defs><polygon class="cls-1 transition-all ease-in-out duration-300" :class="dropdown ? 'stroke-white' : 'stroke-zinc-200 group-hover:stroke-white'" points="17.2 3 6.8 3 1.61 12 6.8 21 17.2 21 22.39 12 17.2 3"></polygon><circle class="cls-1 transition-all ease-in-out duration-300" :class="dropdown ? 'stroke-white' : 'stroke-zinc-200 group-hover:stroke-white'" cx="12" cy="12" r="4"></circle></g></svg>


                    <div @click.away="dropdown = false" class=" z-0 h-auto absolute right-15 mt-3 w-[13.8rem] origin-top-right  rounded bg-zinc-950 border  border-zinc-500 bg-opacity-80 shadow-lg focus:outline-none backdrop-blur"  role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" x-show="dropdown"
                    x-transition:enter="transition ease-in-out duration-200" 
                    x-transition:enter-start="transform opacity-50 scale-y-0" 
                    x-transition:enter-end="transform opacity-100 scale-y-100" 
                    x-transition:leave="transition ease-in-out duration-150" 
                    x-transition:leave-start="transform opacity-100 scale-y-100" 
                    x-transition:leave-end="transform opacity-50 scale-y-0">
                        <div class=" hover:bg-white hover:bg-opacity-30 rounded" role="none">
                            <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-white hover:text-red-600" role="menuitem" tabindex="-1" id="menu-item-1">Me déconnecter</button>
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>
            
            <div class="flex gap-2 items-center group">
                <svg width="20" class="group-hover:translate-x-[20%] transition-all ease-in-out duration-300 pointer-events-none" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z" fill="#ffffff"></path> </g></svg>

                
                <a href="{{route('index')}}" class="flex items-center gap-2 group cursor-pointer text-white hover:underline" >Site web Solaris</a>
            </div>
        </div>
        
    </header>
    <x-loading-screen/>

    <main class=" mt-2 mx-[8px] bg-gray-50 dark:bg-zinc-800 h-full border-none rounded-t-md overflow-hidden flex-col relative">
        @yield('content')
    </main>

    <footer>

    </footer>
</body>
</html>