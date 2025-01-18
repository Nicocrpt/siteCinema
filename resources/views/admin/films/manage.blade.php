@extends('layouts.layoutAdmin')
@section('title' , 'Films - Gérer les films')

@section('content')
<x-admin.admin-film-heading/>

<div class="overflow-y-auto h-full pb-48 mx-auto pt-8 ">
    <div class="max-w-[1000px] mx-auto">
        <form class="w-full flex justify-start items-center gap-2" id="queryFilmsForm">
            @csrf
            <input type="text" name="query" id="query" class="rounded w-72 bg-white dark:bg-zinc-600 dark:focus:bg-zinc-500 border border-zinc-500 dark:text-white dark:placeholder:text-zinc-300" placeholder="Rechercher un film">
            <select name="filter" id="filter" class="rounded bg-zinc-200 dark:bg-zinc-400 border border-zinc-500 text-black dark:text-zinc-100">
                <option value="" selected>Tous</option>
                <option value="1">A l'affiche</option>
                <option value="0">En attente</option>
                <option value="2">Prochainement</option>
                <option value="3">Anciens</option>
            </select>
            <button type="submit" class="border border-zinc-600 bg-zinc-900 hover:bg-cyan-600 text-white  transition-all ease-in-out duration-200 rounded py-2 px-4">Rechercher</button>
        </form>
        <div class="w-full flex flex-wrap gap-2 mt-4">
            @foreach ($films as $film)
            <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                <div class="relative group w-48 overflow-hidden rounded border border-zinc-600 shadow-sm">
                    <img src="{{$film->url_affiche}}" alt="" class="w-48 z-10">
                    <div class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-50 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                        <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                            <p class="text-white font-semibold text-lg text-center">{{$film->titre}}</p>
                            <svg class="absolute top-1 right-3 rotate-90" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z" fill="#ffffff"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z" fill="#ffffff"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z" fill="#ffffff"></path> </g></svg>
                        </div>  
                    </div>
                </div>
            </a>
            @endforeach
        </div>

    </div>

</div>

@endsection