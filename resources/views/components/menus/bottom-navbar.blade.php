<div class="fixed bottom-0 w-full left-0 bg-neutral-950 bg-opacity-90 h-[4.5rem] z-30 md:hidden backdrop-blur-md shadow-lg" >
    <ul class="flex justify-center items-center h-full w-full py-1 px-1 gap-1 ">
        <li class="h-full w-full hover:bg-neutral-900 opacity-80 rounded-md">
            <a href="{{route('index')}}" class="text-[0.65rem] {{$filmPage == 'Accueil' ? 'text-white' : 'text-neutral-400'}} font-semibold flex flex-cols items-center justify-center h-full w-full">
                <div class="flex flex-col-reverse items-center justify-start gap-1 h-full p-2">
                    <p class="">Accueil</p>
                    <svg class="{{$filmPage == 'Accueil' ? 'fill-white' : 'fill-neutral-400'}}" viewBox="0 0 16 16" width="25px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z"></path> </g></svg>
                    
                </div>
            </a>
        </li>

        <li class="h-full w-full hover:bg-neutral-900 opacity-80 rounded-md">
            <a href="{{route('films.index')}}" class="text-[0.65rem] {{$filmPage == 'Films' ? 'text-white' : 'text-neutral-400'}} font-semibold flex flex-cols items-center justify-center h-full w-full">
                <div class="flex flex-col-reverse items-center justify-start gap-1 h-full p-2">
                    <p class="" >Films</p>
                    <svg class="{{$filmPage == 'Films' ? 'stroke-white' : 'stroke-neutral-400'}}" viewBox="0 0 24 24" width="30px" xmlns="http://www.w3.org/2000/svg" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 5V19M17 5V19M3 8H7M17 8H21M3 16H7M17 16H21M3 12H21M6.2 20H17.8C18.9201 20 19.4802 20 19.908 19.782C20.2843 19.5903 20.5903 19.2843 20.782 18.908C21 18.4802 21 17.9201 21 16.8V7.2C21 6.0799 21 5.51984 20.782 5.09202C20.5903 4.71569 20.2843 4.40973 19.908 4.21799C19.4802 4 18.9201 4 17.8 4H6.2C5.0799 4 4.51984 4 4.09202 4.21799C3.71569 4.40973 3.40973 4.71569 3.21799 5.09202C3 5.51984 3 6.07989 3 7.2V16.8C3 17.9201 3 18.4802 3.21799 18.908C3.40973 19.2843 3.71569 19.5903 4.09202 19.782C4.51984 20 5.07989 20 6.2 20Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </div>
            </a>
        </li>

        <li class="h-full w-full hover:bg-neutral-900 opacity-80 rounded-md">
            <a href="{{route('seances.index')}}" class="text-[0.65rem] {{$filmPage == 'Séances' ? 'text-white' : 'text-neutral-400'}} font-semibold flex flex-cols items-center justify-center h-full w-full">
                <div class="flex flex-col-reverse items-center justify-start gap-1 h-full p-2">
                    <p>Séances</p>
                    {{-- <svg width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0079 19.0029L14.0137 17C14.0137 16.4477 14.4625 16 15.0162 16C15.5698 16 16.0187 16.4477 16.0187 17V18.9765C16.0187 19.458 16.0187 19.6988 16.1731 19.8464C16.3275 19.9941 16.5637 19.984 17.0362 19.964C18.8991 19.8852 20.0437 19.6332 20.8504 18.8284C21.6591 18.0218 21.911 16.8766 21.9894 15.0105C22.005 14.6405 22.0128 14.4554 21.9437 14.332C21.8746 14.2085 21.5987 14.0545 21.0469 13.7463C20.4341 13.4041 20.0199 12.7503 20.0199 12C20.0199 11.2497 20.4341 10.5959 21.0469 10.2537C21.5987 9.94554 21.8746 9.79147 21.9437 9.66803C22.0128 9.54458 22.005 9.35954 21.9894 8.98947C21.911 7.12339 21.6591 5.97823 20.8504 5.17157C19.9727 4.29604 18.6952 4.0748 16.5278 4.0189C16.2482 4.01169 16.0187 4.23718 16.0187 4.51618V7C16.0187 7.55228 15.5698 8 15.0162 8C14.4625 8 14.0137 7.55228 14.0137 7L14.0064 4.49855C14.0056 4.22298 13.7814 4 13.5052 4H9.99502C6.21439 4 4.32407 4 3.14958 5.17157C2.34091 5.97823 2.08903 7.12339 2.01058 8.98947C1.99502 9.35954 1.98724 9.54458 2.05634 9.66802C2.12545 9.79147 2.40133 9.94554 2.95308 10.2537C3.56586 10.5959 3.98007 11.2497 3.98007 12C3.98007 12.7503 3.56586 13.4041 2.95308 13.7463C2.40133 14.0545 2.12545 14.2085 2.05634 14.332C1.98724 14.4554 1.99502 14.6405 2.01058 15.0105C2.08903 16.8766 2.34091 18.0218 3.14958 18.8284C4.32407 20 6.21438 20 9.99502 20H13.0054C13.4767 20 13.7124 20 13.8591 19.8541C14.0058 19.7081 14.0065 19.4731 14.0079 19.0029ZM16.0187 13V11C16.0187 10.4477 15.5698 10 15.0162 10C14.4625 10 14.0137 10.4477 14.0137 11V13C14.0137 13.5523 14.4625 14 15.0162 14C15.5698 14 16.0187 13.5523 16.0187 13Z" fill="#ffffff"></path> </g></svg> --}}
                    <svg viewBox="0 0 24 24" width="30px" class="{{$filmPage == 'Séances' ? 'stroke-white' : 'stroke-neutral-400'}} fill-transparent" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 7V12L10.5 14.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </div>
            </a>
            
        </li>

        <li class="h-full w-full hover:bg-neutral-900 opacity-80 rounded-md">
            <a href="{{Auth::check() ? route('home') : route('login')}}" class="text-[0.65rem] {{$filmPage == 'Mon compte' ? 'text-white' : 'text-neutral-400'}} font-semibold flex flex-cols items-center justify-center h-full w-full">
                <div class="flex flex-col-reverse items-center justify-start gap-1 h-full p-2">
                    <p class="font-[600]">Compte</p>
                    <svg class="{{$filmPage == 'Mon compte' ? 'fill-white' : 'fill-neutral-400'}}" width="30px" height="30" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg"  stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 3C9.56586 3 7.59259 4.95716 7.59259 7.37143C7.59259 9.7857 9.56586 11.7429 12 11.7429C14.4341 11.7429 16.4074 9.7857 16.4074 7.37143C16.4074 4.95716 14.4341 3 12 3Z" ></path> <path d="M14.601 13.6877C12.8779 13.4149 11.1221 13.4149 9.39904 13.6877L9.21435 13.7169C6.78647 14.1012 5 16.1783 5 18.6168C5 19.933 6.07576 21 7.40278 21H16.5972C17.9242 21 19 19.933 19 18.6168C19 16.1783 17.2135 14.1012 14.7857 13.7169L14.601 13.6877Z" ></path> </g></svg>
                    
                </div>
            </a>
        </li>
    </ul>
</div>