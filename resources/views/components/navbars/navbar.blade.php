<div class="flex items-center pl-2 {{$background}}">
    <x-menus.menu-hamb/>
    <nav class="lg:mx-5 mx-2 md:mx-3 w-full flex justify-between items-center h-14 navigation {{$background}} md:flex-row flex-row-reverse">
        <div class="flex items-center md:gap-4 lg:gap-10 gap-5 md:flex-row flex-row-reverse ">
            <a cursor="pointer" @click="open = true" class="{{$search == 'true' ? 'block' : 'hidden'}}">
                <svg class="w-[42px] h-[42px] md:w-10 md:h-10 p-2 rounded-md hover:bg-slate-300 hover:bg-opacity-40 cursor-pointer transition-all ease-in-out duration-300" fill="#ffffff" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M497.938,430.063l-126.914-126.91C389.287,272.988,400,237.762,400,200C400,89.719,310.281,0,200,0 C89.719,0,0,89.719,0,200c0,110.281,89.719,200,200,200c37.762,0,72.984-10.711,103.148-28.973l126.914,126.91 C439.438,507.313,451.719,512,464,512c12.281,0,24.563-4.688,33.938-14.063C516.688,479.195,516.688,448.805,497.938,430.063z M64,200c0-74.992,61.016-136,136-136s136,61.008,136,136s-61.016,136-136,136S64,274.992,64,200z"></path> </g> </g></svg>
            </a>
            <svg
                 fill="#ffffff" @click="rotation += 180" class="w-[40px] transition-all ease-in-out duration-[1.5s] cursor-pointer" :style="'transform: rotate(' + rotation + 'deg)'" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.002 512.002" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M255.998,120.138c-74.914,0-135.862,60.948-135.862,135.862s60.948,135.862,135.862,135.862S391.86,330.914,391.86,256 S330.912,120.138,255.998,120.138z M255.998,376.138c-66.244,0-120.138-53.894-120.138-120.138s53.894-120.138,120.138-120.138 S376.136,189.756,376.136,256S322.242,376.138,255.998,376.138z"></path> <rect x="248.132" width="15.723" height="104.004"></rect> <rect x="204.41" y="77.295" transform="matrix(0.1737 0.9848 -0.9848 0.1737 270.5177 -152.095)" width="42.967" height="15.723"></rect> <rect x="147.778" y="97.896" transform="matrix(0.5 0.866 -0.866 0.5 176.2168 -93.7057)" width="42.967" height="15.723"></rect> <rect x="101.628" y="136.626" transform="matrix(-0.766 -0.6428 0.6428 -0.766 124.5386 334.3051)" width="42.966" height="15.723"></rect> <rect x="85.111" y="175.186" transform="matrix(0.342 -0.9397 0.9397 0.342 -123.6348 216.775)" width="15.723" height="42.968"></rect> <rect x="61.036" y="248.134" width="42.966" height="15.723"></rect> <rect x="71.491" y="307.47" transform="matrix(-0.9397 0.342 -0.342 -0.9397 288.1874 579.851)" width="42.968" height="15.723"></rect> <rect x="101.599" y="359.634" transform="matrix(-0.7661 0.6428 -0.6428 -0.7661 453.5869 569.907)" width="42.969" height="15.724"></rect> <rect x="161.387" y="384.747" transform="matrix(0.866 0.5 -0.5 0.866 225.7961 -30.199)" width="15.723" height="42.967"></rect> <rect x="217.994" y="405.378" transform="matrix(-0.9848 -0.1736 0.1736 -0.9848 374.1774 886.4498)" width="15.723" height="42.966"></rect> <rect x="264.622" y="418.964" transform="matrix(-0.1737 -0.9848 0.9848 -0.1737 -84.5358 782.7211)" width="42.966" height="15.723"></rect> <rect x="321.241" y="398.39" transform="matrix(-0.5 -0.866 0.866 -0.5 162.268 906.1877)" width="42.967" height="15.723"></rect> <rect x="367.381" y="359.643" transform="matrix(0.766 0.6428 -0.6428 0.766 327.2243 -163.9794)" width="42.966" height="15.723"></rect> <rect x="397.539" y="307.477" transform="matrix(0.9397 0.342 -0.342 0.9397 133.1127 -124.2909)" width="42.968" height="15.723"></rect> <rect x="407.996" y="248.134" width="42.966" height="15.723"></rect> <rect x="397.536" y="188.819" transform="matrix(0.9397 -0.342 0.342 0.9397 -41.9979 155.1646)" width="42.968" height="15.723"></rect> <rect x="367.429" y="136.621" transform="matrix(0.7661 -0.6428 0.6428 0.7661 -1.8874 283.7811)" width="42.969" height="15.724"></rect> <rect x="334.886" y="84.276" transform="matrix(-0.866 -0.5 0.5 -0.866 586.6924 368.7268)" width="15.723" height="42.967"></rect> <rect x="278.258" y="63.66" transform="matrix(0.9848 0.1736 -0.1736 0.9848 19.126 -48.3792)" width="15.723" height="42.966"></rect> <rect x="134.216" y="56.443" transform="matrix(0.342 0.9397 -0.9397 0.342 182.959 -132.6761)" width="104.004" height="15.723"></rect> <rect x="72.871" y="91.866" transform="matrix(0.6428 0.766 -0.766 0.6428 120.9948 -60.0334)" width="104.001" height="15.723"></rect> <rect x="27.325" y="146.135" transform="matrix(0.866 0.5 -0.5 0.866 87.6282 -19.0312)" width="104.002" height="15.723"></rect> <rect x="3.086" y="212.716" transform="matrix(0.9848 0.1737 -0.1737 0.9848 39.1517 -6.2158)" width="104.004" height="15.723"></rect> <rect x="3.111" y="283.559" transform="matrix(0.9848 -0.1737 0.1737 0.9848 -49.7819 14.0032)" width="104.004" height="15.723"></rect> <rect x="27.32" y="350.131" transform="matrix(0.866 -0.5 0.5 0.866 -168.3728 87.6254)" width="104.002" height="15.723"></rect> <rect x="72.853" y="404.42" transform="matrix(0.6428 -0.766 0.766 0.6428 -271.2199 242.9003)" width="104.001" height="15.723"></rect> <rect x="178.378" y="395.687" transform="matrix(-0.9397 -0.342 0.342 -0.9397 208.1387 932.0757)" width="15.723" height="104.004"></rect> <rect x="248.132" y="407.998" width="15.723" height="104.004"></rect> <rect x="273.774" y="439.845" transform="matrix(-0.342 -0.9397 0.9397 -0.342 16.4819 906.9549)" width="104.004" height="15.723"></rect> <rect x="335.101" y="404.425" transform="matrix(-0.6428 -0.766 0.766 -0.6428 320.1168 973.8383)" width="104.001" height="15.723"></rect> <rect x="380.676" y="350.147" transform="matrix(-0.866 -0.5 0.5 -0.866 628.3762 884.394)" width="104.002" height="15.723"></rect> <rect x="449.052" y="239.404" transform="matrix(0.1737 -0.9848 0.9848 0.1737 90.5708 690.757)" width="15.723" height="104.004"></rect> <rect x="404.887" y="212.739" transform="matrix(-0.9848 0.1737 -0.1737 -0.9848 945.1505 358.4856)" width="104.004" height="15.723"></rect> <rect x="380.671" y="146.14" transform="matrix(-0.866 0.5 -0.5 -0.866 884.3768 71.0287)" width="104.002" height="15.723"></rect> <rect x="335.129" y="91.848" transform="matrix(-0.6428 0.766 -0.766 -0.6428 712.3632 -132.7443)" width="104.001" height="15.723"></rect> <rect x="317.909" y="12.304" transform="matrix(0.9397 0.342 -0.342 0.9397 41.6369 -107.5362)" width="15.723" height="104.004"></rect> </g> </g> </g> </g>
            </svg>
            <ul class="lg:space-x-6 md:space-x-4 md:flex hidden">
                <li class="navBar-li"><a href="{{ route('index') }}">Accueil</a></li>
                <li class="navBar-li"><a href="{{ route('films.index') }}">Films</a></li>
                <li class="navBar-li"><a href="{{ route('seances.index') }}">Seances</a></li>
                <li class="navBar-li"><a href="">Contact</a></li>
            </ul>
        </div>
        
        @if (Auth::check())
            <div class="relative md:inline-block hidden">
                @if(Auth::user()->is_admin)
                <div class="flex gap-2 items-center group">
                    <svg width="20" class="group-hover:translate-x-[20%] transition-all ease-in-out duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z" fill="#ffffff"></path> </g></svg>
                    <a href="{{route('admin.index')}}" class="flex items-center gap-2 group cursor-pointer text-white hover:underline" >Solaris Manager</a>
                </div>
                @else
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
                            <div class="mt-1 hover:bg-white hover:bg-opacity-30 rounded" role="none">
                                <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-white hover:text-red-500" role="menuitem" tabindex="-1" id="menu-item-1">Me déconnecter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
        @else
        <div class=" items-center lg:gap-4 md:gap-1 md:flex hidden">
            <a href="{{ route('login')}}" class="navBar-account flex items-center gap-2 group" >
                Se connecter
            </a>
            <div class="h-4 border-r-[0.5px] border-zinc-100 rounded-full"></div>
            <a href="{{ route('register')}}" class="navBar-account flex items-center gap-2 group" >
                S'inscire
            </a>
        </div>
        @endif
    
        <div class="flex items-center justify-center gap-3 md:hidden">
            {{-- <img width="35px" src="{{Storage::url('assets/mainLogo.png')}}" alt=""> --}}
            <p class="text-xl text-white font-base">Le Solaris</p>
        </div>
        
    </nav>
</div>

