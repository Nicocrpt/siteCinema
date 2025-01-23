@extends('layouts.layoutAdmin')
@section('title' , 'Admin Panel')

@section('content')
<div class="h-12 w-full border-b-2 border-zinc-150 dark:border-zinc-700 shadow-xs p-4 px-6 lg:px-8 bg-zinc-100 dark:bg-zinc-900 flex  items-center">
    <div class="flex w-full items-center justify-between">
        <div class="flex gap-4 items-center">
            <a href="{{route('admin.films.manage')}}">
                <svg width="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="fill-black dark:fill-white"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M0 0h48v48H0z" fill="none"></path> <g id="Shopicon"> <path d="M10,22v2c0,7.72,6.28,14,14,14s14-6.28,14-14s-6.28-14-14-14h-6.662l3.474-4.298l-3.11-2.515L10.577,12l7.125,8.813 l3.11-2.515L17.338,14H24c5.514,0,10,4.486,10,10s-4.486,10-10,10s-10-4.486-10-10v-2H10z"></path> </g> </g></svg>
            </a>
            <h1 class="font-semibold dark:text-white text-lg">{{$film->titre}}</h1>
        </div>
        <h1 class="font-semibold dark:text-white text-md">Id TMDB : {{$film->tmdb_id}}</h1>
    </div>
    <button type="submit" class="ml-6 w-44 bg-green-600 hover:bg-green-700 rounded py-[0.10rem] text-white border border-green-800">
        Mettre à jour le film
    </button>
</div>

<div class="overflow-y-auto h-full pt-8 pb-48 w-full">
    <div class="max-w-[900px] mx-auto">
        
    </div>
</div>

@endsection