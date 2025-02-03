@extends('layouts.layoutNavigation')
@section('title' , 'Séances')

@section('content')
    <div x-data="seancesPage()" class="h-full bg-zinc-100 dark:bg-zinc-900 relative w-full">
        <div class="fixed top-0 w-full">
            <section class="w-full !h-[4rem] bg-zinc-100 dark:bg-zinc-900 mt-[56px] flex items-center justify-center relative">
                <button class="hover:bg-zinc-200 dark:hover:bg-zinc-800 p-2 rounded mt-2" @click="prev()" :class="today >= firstDate ? 'pointer-events-none' : ''">
                    <svg width="18px" :class="today >= firstDate ? 'fill-zinc-300 dark:fill-zinc-600' : 'fill-black dark:fill-white'"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                </button>
                <div class="!overflow-hidden min-w-[16rem] max-w-[16rem] xxs:min-w-[20rem] xxs:max-w-[20rem] xs:min-w-[28rem] xs:max-w-[28rem] sm:min-w-[35rem] sm:max-w-[35rem] mx-[0.15rem] md:mx-4 py-2 h-full relative rounded" id="slider">
                    <div class=" h-full flex ease-in-out duration-700 rounded-full" :style="`transform: translateX(${translation}rem);`" id="dateContainer">
        
                    </div>
                </div>
                <button class="hover:bg-zinc-200 dark:hover:bg-zinc-800 p-2 rounded mt-2" @click="next()">
                    <svg class="fill-black dark:fill-white" width="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                </button>
            </section>

        </div>
        <section class="min-h-screen bg-zinc-50 dark:bg-zinc-800 mx-2 rounded pt-16 px-2">
            <div class="mx-auto lg:w-[50rem] md:w-[45rem] py-12">
                <h1 id="longDay" class="text-2xl font-semibold dark:text-white"></h1>
                <div id="seancesContainer" class=" mx-auto flex flex-col gap-2 pt-10 w-full transition-opacity ease-in-out duration-300">

                </div>
            </div>
            
        </section>
        <x-footer class="w-full"/>
    </div>
    {{-- <x-cards.seances-film-card :film="$film"/> --}}
    <script>
        const films_php = @json($films);
    </script>
@endsection