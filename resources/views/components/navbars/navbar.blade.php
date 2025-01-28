<div class="flex items-center pl-2 {{$background}}">
    <x-menus.menu-hamb/>
    <nav class="lg:mx-5 mx-2 md:mx-3 w-full flex justify-between items-center h-14 navigation {{$background}} md:flex-row flex-row-reverse">
        <div class="flex items-center md:gap-4 lg:gap-10 gap-5 md:flex-row flex-row-reverse ">
            <a cursor="pointer" @click="open = true" class="{{$search == 'true' ? 'block' : 'hidden'}}">
                <svg class="w-[42px] h-[42px] md:w-10 md:h-10 p-2 rounded-md hover:bg-slate-300 hover:bg-opacity-40 cursor-pointer transition-all ease-in-out duration-300" fill="#ffffff" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M497.938,430.063l-126.914-126.91C389.287,272.988,400,237.762,400,200C400,89.719,310.281,0,200,0 C89.719,0,0,89.719,0,200c0,110.281,89.719,200,200,200c37.762,0,72.984-10.711,103.148-28.973l126.914,126.91 C439.438,507.313,451.719,512,464,512c12.281,0,24.563-4.688,33.938-14.063C516.688,479.195,516.688,448.805,497.938,430.063z M64,200c0-74.992,61.016-136,136-136s136,61.008,136,136s-61.016,136-136,136S64,274.992,64,200z"></path> </g> </g></svg>
            </a>
            <svg width="35" fill="#ffffff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <rect x="189.861" y="99.214" width="33.071" height="15.925"></rect> <rect x="41.034" y="231.5" width="66.143" height="15.925"></rect> <rect x="123.718" y="264.572" width="57.872" height="15.925"></rect> <rect x="189.861" y="305.913" width="49.607" height="15.925"></rect> <path d="M437.019,74.98C388.667,26.628,324.379,0,256,0S123.333,26.628,74.98,74.98C26.628,123.333,0,187.62,0,256 s26.628,132.668,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.019-74.981S512,324.379,512,255.999 S485.371,123.333,437.019,74.98z M491.452,208.745l-148.83,148.032c5.619-13.095,10.117-26.626,13.454-40.49l129.822-129.824 C488.099,193.778,489.957,201.211,491.452,208.745z M480.156,169.681L361.111,288.726c1.249-9.849,1.93-19.826,2.038-29.894 l108.525-108.526C474.786,156.64,477.624,163.099,480.156,169.681z M463.821,135.638L362.477,236.982 c-0.607-8.363-1.619-16.646-3.025-24.832l93.511-93.51C456.834,124.165,460.449,129.839,463.821,135.638z M443.291,105.788 l-87.752,87.751c-1.812-7.252-3.944-14.412-6.389-21.464l81.155-81.156C434.86,95.721,439.183,100.686,443.291,105.788z M418.97,79.732l-76.089,76.087c-2.726-6.398-5.726-12.691-8.985-18.869l70.053-70.053 C409.106,70.946,414.112,75.232,418.97,79.732z M390.945,57.378l-65.226,65.225c-3.484-5.683-7.202-11.254-11.154-16.7 l59.215-59.215C379.638,49.993,385.359,53.565,390.945,57.378z M358.956,38.988l-54.22,54.22 c-4.193-5.072-8.581-9.977-13.149-14.708l47.761-47.761C346.002,33.199,352.547,35.942,358.956,38.988z M322.377,25.187 l-42.205,42.205c-4.864-4.448-9.895-8.711-15.08-12.775l34.712-34.711C307.434,21.304,314.964,23.067,322.377,25.187z M253.372,15.957c0.876-0.01,1.75-0.032,2.628-0.032c8.093,0,16.125,0.4,24.075,1.187l-27.958,27.958 c-5.547-3.82-11.239-7.422-17.06-10.797L253.372,15.957z M229.419,17.388l-9.014,9.014c-4.059-2.014-8.172-3.92-12.33-5.714 C215.107,19.271,222.228,18.175,229.419,17.388z M86.241,425.757c-1.55-1.55-3.071-3.12-4.574-4.705h124.726v-15.925H67.838 C34.199,362.852,15.925,310.832,15.925,256c0-51.31,16.003-100.154,45.622-140.86h111.774V99.214H74.174 c3.845-4.446,7.867-8.775,12.066-12.974c27.18-27.18,59.734-47.029,95.261-58.579c46.764,15.227,88.687,45.317,118.25,84.955 c19.363,25.963,33.036,55.002,40.593,85.814H107.177v15.925H343.67c2.369,13.625,3.582,27.539,3.582,41.645 c0,0.103-0.003,0.204-0.003,0.306h-58.178v15.925h57.636c-0.807,12.205-2.518,24.237-5.123,36.023l-0.13,0.13l0.084,0.084 c-7.261,32.708-21.356,63.518-41.783,90.909c-29.565,39.643-71.49,69.737-118.257,84.962 C145.973,472.788,113.421,452.938,86.241,425.757z M254.538,496.057c-15.781-0.093-31.325-1.694-46.465-4.747 c40.653-17.534,76.778-45.763,103.574-81.267l182.83-181.845c0.996,8.686,1.527,17.474,1.58,26.339L254.538,496.057z M425.757,425.757c-23.694,23.694-51.474,41.812-81.743,53.725l135.469-135.469C467.57,374.285,449.452,402.064,425.757,425.757z M489.7,311.274L311.273,489.699c-10.868,2.549-21.964,4.349-33.222,5.368l217.016-217.016 C494.048,289.311,492.248,300.404,489.7,311.274z"></path> </g> </g> </g> </g></svg>
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
                    <a href="{{route('admin.films.manage')}}" class="flex items-center gap-2 group cursor-pointer text-white hover:underline" >Solaris Manager</a>
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

