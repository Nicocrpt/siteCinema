@extends('layouts.layoutNavigation')
@section('title' , 'Films')
@section('content')
<div class="h-full bg-zinc-100 dark:bg-zinc-900 relative w-full">
    <div class="fixed top-0 w-full">
        <section class="w-full !h-[4rem] bg-zinc-100 dark:bg-zinc-900 mt-[56px] flex items-center justify-center gap-2 relative">
            <input type="text" placeholder="Rechercher un film" class=" bg-zinc-50 dark:bg-zinc-700 placeholder:text-zinc-500 text-white px-4 rounded-md">
            <select name="" id="" class="rounded-md dark:bg-zinc-800 dark:text-zinc-300">
                <option value="">Genres</option>
                @foreach ($genres as $genre)
                    <option value="{{$genre->nom}}">{{$genre->nom}}</option>
                @endforeach
            </select>
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
    <section x-data="{forthComing: false}" class="min-h-screen bg-zinc-50 dark:bg-zinc-800 mx-2 rounded px-2 pt-24">
        <div class="mx-auto w-[70rem] py-12">
            <div class="w-full h-16 flex items-center justify-center gap-10 mt-8">
                <button @click="forthComing = false" id="longDay" class="text-2xl font-semibold transition-all ease-in-out duration-300" :class="forthComing ? 'dark:text-zinc-500 hover:dark:text-zinc-400' : 'dark:text-white'">A l'affiche</button>                
                <button @click="forthComing = true" id="longDay" class="text-2xl font-semibold transition-all ease-in-out duration-300" :class="forthComing ? 'dark:text-white' : 'dark:text-zinc-500 hover:dark:text-zinc-400'">Prochainement</button>
            </div>
            
            <div id="filmsContainer" class=" mx-auto flex flex-wrap gap-2 pt-10">
                @foreach($films as $film)
                    <div class="flex items-center justify-center max-w-[200px] w-[48%]" >
                        <a href="{{ route('film.show', $film->slug) }}"><img src="{{ $film->url_affiche }}" alt="" class=" rounded-md hover:ring-2 ring-neutral-400 dark:border-neutral-600 shadom-md transition-all ease-in-out duration-300"></a>
                    </div>
                @endforeach
            </div>
        </div>
        
    </section>
    <x-footer class="w-full"/>
</div>


@endsection