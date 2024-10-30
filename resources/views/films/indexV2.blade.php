@extends('layouts.layoutNavigation')
@section('title' , 'Films')
@section('content')
<div class="h-full w-full relative" x-data="{searchBar : false}">

    {{-- Side Menu --}}
    <div class="fixed md:fixed md:w-80 xl:w-[26rem] w-full overflow-hidden h-28 md:h-screen top-0 left-0 pt-14 bg-zinc-900 md:gap-10 shadow shadow-black md:shadow-lg z-20 margin-0 flex md:flex-col">
            
            <ul class="w-full my-10 md:flex flex-col gap-4 hidden">
                <li class="text-zinc-300 hover:text-white w-full h-full px-6 py-2 text-2xl hover:bg-zinc-800 bg-opacity-70">
                    <a>
                        <p>A l'affiche</p>
                    </a>
                </li>
                <li class="text-zinc-300 hover:text-white w-full h-full px-6 py-2 text-2xl hover:bg-zinc-800 bg-opacity-70">Prochainement</li>
                <li class="text-zinc-300 hover:text-white w-full h-full px-6 py-2 text-2xl hover:bg-zinc-800 bg-opacity-70">Spécial</li>
            </ul>
            <div class="w-full flex items-center justify-between mx-2">
                <div class=" w-[55%] hover:w-full transition-all ease-in-out duration-300 flex justify-center items-center flex-shrink-0">
                    <form action="" class="w-full">
                        <div class="w-full rounded-md shadow-sm flex flex-row-reverse justify-between overflow-hidden bg-white dark:bg-zinc-700 pl-2 h-10">
                            <svg class="w-[42px] h-[42px] md:w-10 md:h-10 p-2 bg-transparent  cursor-pointer transition-all ease-in-out duration-300 fill-neutral-500" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M497.938,430.063l-126.914-126.91C389.287,272.988,400,237.762,400,200C400,89.719,310.281,0,200,0 C89.719,0,0,89.719,0,200c0,110.281,89.719,200,200,200c37.762,0,72.984-10.711,103.148-28.973l126.914,126.91 C439.438,507.313,451.719,512,464,512c12.281,0,24.563-4.688,33.938-14.063C516.688,479.195,516.688,448.805,497.938,430.063z M64,200c0-74.992,61.016-136,136-136s136,61.008,136,136s-61.016,136-136,136S64,274.992,64,200z"></path> </g> </g></svg>
                            <input type="text" class="text-lg text-neutral-300 placeholder:text-neutral-300 bg-transparent font-base w-full border-none focus:ring-0 focus:outline-none p-0 z-30" placeholder="Recherchez un film">
                        </div>
                        
                    </form>
                </div>
                <div class="mx-2 md:mt-8 h-full flex justify-center items-center flex-shrink-0">
                    <form action="" class="w-full flex justify-center">
                        <select name="" id="" class="text-lg h-10 text-neutral-300 bg-neutral-400 px-2 font-base w-full border-none focus:ring-0 focus:outline-none z-30 rounded-md shadow-sm border-2 border-neutral-300">
                            <option value="Selectionnez">Genres</option>
                            @foreach ($genres as $genre)
                                <option value="{{$genre->nom}}">{{$genre->nom}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            
    </div>
    
        
        

    <div class=" overflow-hidden overflow-y-auto h-[100vh] md:ml-80 lg:ml-[26rem] z-10 pt-36 md:pt-32 relative px-2">
        
        
        {{-- <div class="flex z-20 w-full ">
            

            <svg @click="searchBar = !searchBar" class="w-[42px] h-[42px] md:w-10 md:h-10 p-2 cursor-pointer transition-all ease-in-out duration-300  fill-neutral-900 dark:fill-white hover:bg-neutral-300 hover:bg-opacity-40 rounded-md" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M497.938,430.063l-126.914-126.91C389.287,272.988,400,237.762,400,200C400,89.719,310.281,0,200,0 C89.719,0,0,89.719,0,200c0,110.281,89.719,200,200,200c37.762,0,72.984-10.711,103.148-28.973l126.914,126.91 C439.438,507.313,451.719,512,464,512c12.281,0,24.563-4.688,33.938-14.063C516.688,479.195,516.688,448.805,497.938,430.063z M64,200c0-74.992,61.016-136,136-136s136,61.008,136,136s-61.016,136-136,136S64,274.992,64,200z"></path> </g> </g></svg>
        </div> --}}
        
        {{-- <div x-show="searchBar" x-transition:enter="ease-out duration-300 transform delay-100" x-transition:enter-start="opacity-0 translate-x-[100%]" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-[100%]">
            <form action="" class="w-full mt-2 px-2 mb-4">
                <div class="w-full rounded-md shadow-sm border border-neutral-300 flex overflow-hidden bg-white dark:bg-neutral-400">
                    <svg class="w-[42px] h-[42px] md:w-10 md:h-10 p-2 bg-transparent  cursor-pointer transition-all ease-in-out duration-300 fill-neutral-200" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M497.938,430.063l-126.914-126.91C389.287,272.988,400,237.762,400,200C400,89.719,310.281,0,200,0 C89.719,0,0,89.719,0,200c0,110.281,89.719,200,200,200c37.762,0,72.984-10.711,103.148-28.973l126.914,126.91 C439.438,507.313,451.719,512,464,512c12.281,0,24.563-4.688,33.938-14.063C516.688,479.195,516.688,448.805,497.938,430.063z M64,200c0-74.992,61.016-136,136-136s136,61.008,136,136s-61.016,136-136,136S64,274.992,64,200z"></path> </g> </g></svg>
                    <input type="text" class="text-lg text-neutral-300 bg-transparent font-base w-full border-none focus:ring-0 focus:outline-none p-0 z-30" placeholder="film, genre...">
                </div>
                
            </form>
        </div> --}}
        
        <div class="transition-height ease-in-out duration-300 md:pt-44 w-full">
            <p class="text-xl font-semibold dark:text-white mb-4 mx-2 transition-all ease-in-out duration-300">À l'affiche</p>
            <div class="pb-20 flex flex-wrap sm:justify-start justify-evenly sm:gap-4 gap-auto m-auto">
                @foreach ($films as $film)
                    <div class="flex items-center justify-center max-w-[200px] w-[48%] my-2" >
                        <a href="{{ route('film.show', $film->slug) }}"><img src="{{ $film->url_affiche }}" alt="" class="hover:border-solid hover:border-green-500 hover:border-2 rounded-md border border-neutral-400 dark:border-neutral-600 shadom-md"></a>
                    </div>
                @endforeach
            </div>
        </div>
            

        
    </div>       


         
</div>


@endsection