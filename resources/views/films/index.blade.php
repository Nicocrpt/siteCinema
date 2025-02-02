@extends('layouts.layoutNavigation')
@section('title' , 'Films')
@section('content')
<div x-data="filmsPage()" class="h-full bg-zinc-100 dark:bg-zinc-900 w-full">
    <div class="fixed top-0 w-full z-20">
        <section class="w-full !h-[4rem] bg-zinc-100 dark:bg-zinc-900 mt-[56px] flex items-center justify-center gap-2 relative px-2">
            <input id="nameQuery" type="text" placeholder="Rechercher un film" class=" bg-zinc-50 dark:bg-zinc-700 placeholder:text-zinc-500 dark:text-white px-4 rounded-md max-xs:w-[70%] xs:w-[22rem]">
            <select name="" id="genreQuery" class="rounded-md dark:bg-zinc-800 dark:text-zinc-300 max-xs:min-w-[6.5rem]">
                <option value="">Genres</option>
                @foreach ($genres as $genre)
                    <option value="{{$genre->nom}}">{{$genre->nom}}</option>
                @endforeach
            </select>
            <button @click="getFilteredFilms()" type="button" class="size-10 px-2 py-1 bg-zinc-800/90 hover:bg-zinc-800 dark:bg-zinc-50 dark:hover:bg-zinc-200 text-white dark:text-black rounded transition-all ease-in-out duration-200 shrink-0">
                <svg viewBox="0 0 24 24" class="stroke-white dark:stroke-black fill-none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </button>
        </section>
        <div class="h-4 w-full bg-transparent flex flex-col justify-start">
            <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-900"></div>
            <div class="h-2 w-full flex justify-between">
                <div class="flex relative">  
                    <div class="h-full w-4 bg-zinc-100 dark:bg-zinc-900 asbolute left-0"></div>
                    <div class="h-full w-2 rounded-tl absolute left-2 bg-zinc-50 dark:bg-zinc-800"></div>
                </div>
                <div class="flex relative">
                    <div class="h-full w-4 bg-zinc-100 dark:bg-zinc-900 absolute right-0"></div>
                    <div class="h-full w-2 rounded-tr absolute right-2 bg-zinc-50 dark:bg-zinc-800"></div>
                </div>
                
            </div>
        </div>
    </div>
    <section class="min-h-screen bg-zinc-50 dark:bg-zinc-800 mx-2 rounded px-2 pt-[128px] relative">
        <div class="mx-auto w-full max-w-[1192px] xs:px-2 lg:px-6 py-12">
            <div class="w-full px-4 h-20 fixed top-[116px] left-0 z-10 flex items-center justify-center ">
                <div class="w-full h-full flex items-center justify-center gap-2 sm:gap-10 mt-2 bg-zinc-50 dark:bg-zinc-700/30 rounded-b bg-opacity-80 dark:bg-opacity-70 backdrop-blur-[10px]">
                    <div class="h-full flex justify-center items-center">
                        <button @click="window.scrollTo({top: 0, behavior: 'smooth'}) ; forthComing = false" id="longDay" class="text-xl xxs:text-2xl py-2 pl-4 rounded font-semibold transition-all ease-in-out duration-300 flex group" :class="forthComing ? 'dark:text-zinc-200/60 hover:dark:text-zinc-50/80 text-zinc-600/40 hover:text-zinc-950/60' : 'dark:text-white'">
                            A l'affiche
                        </button>
                        <div class="h-[42px] flex items-start">
                            <span id="availableCount" class="text-xs text-white size-[16px] rounded transition-all ease-in-out duration-300 text-center ml-2 mt-1 bg-yellow-500 dark:bg-yellow-600 ring-[0.5px] ring-zinc-400/70" :class="!forthComing ? 'opacity-100' : 'opacity-60'"></span>
                        </div>
                    </div>
                    
                    <div class="h-full flex justify-center items-center">
                        <button @click="window.scrollTo({top: 0, behavior: 'smooth'}) ; forthComing = true;" id="longDay" class="text-xl xxs:text-2xl py-2 pl-4 rounded font-semibold transition-all ease-in-out duration-300 flex group" :class="forthComing ? 'dark:text-white' : 'text-zinc-600/40 hover:text-zinc-950/60 dark:text-zinc-200/60 hover:dark:text-zinc-50/80'">
                            Prochainement     
                        </button>
                        <div class="h-[42px] flex items-start pr-4">
                            <span id="forthcomingCount" class="text-xs text-white size-[16px] rounded transition-all ease-in-out duration-300 text-center ml-2 mt-1 bg-slate-600 dark:bg-slate-600 ring-[0.5px] ring-zinc-400/70" :class="forthComing ? 'opacity-100' : 'opacity-60'"></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="h-full w-full mt-12 !relative" id="filmsContainer">
                <div id="availableContainer" x-show="!forthComing" class="absolute top-0 left-0 px-1 w-full mx-auto flex flex-wrap gap-[2%] xs:gap-[1.4%] sm:gap-[1%] lg:gap-[1.25%] pt-2"
                x-transition:enter="delay-100 transition linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                </div>

                <div id="forthcomingContainer" x-show="forthComing" class="absolute top-0 left-0 w-full mx-auto flex flex-wrap gap-[2%] xs:gap-[1.4%] sm:gap-[1%] pt-2"
                x-transition:enter="delay-100 transition linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                </div>
            </div>
        </div>
        
    </section>
    <x-footer class="w-full"/>
</div>


@endsection