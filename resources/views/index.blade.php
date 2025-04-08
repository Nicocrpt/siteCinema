@extends('layouts.layout')
@section('title' , 'Accueil')



@section('content')
        <div :class="open ? 'overflow-hidden' : ''">
            <x-carousels.filmBanner :films="$films->where('est_favori', 1)" id="banniere"/>
            <div class=" h-full md:mx-[0.42rem] md:mt-2 mx-[0.22rem] mt-1">
                {{-- <div class="index-content transition-all ease-in-out duration-[0.75s] "></div> --}}
            {{-- <x-film-card :films="$films->where('est_favori', 1)"/> --}}
                <div class="py-24 rounded bg-zinc-50 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-bold dark:text-white ml-[2%]">Films à l'affiche</h1>
                        <a href="{{ route('films.index') }}" class="underline text-xs dark:text-white">Voir tous les films</a>
                    </div>
                    
                    {{-- <x-films-caroussel :films="$films"/> --}}
                    <x-carousels.films-slider :films="$films->where('statut_id', 1)"/>
                </div>


                <div class=" pb-24 rounded bg-zinc-50 dark:bg-zinc-900">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-bold dark:text-white ml-[2%]">Prochainement au cinéma</h1>
                        <a href="{{ route('films.index') }}" class="underline text-xs dark:text-white">Voir toutes les prochaines sorties</a>
                    </div>
                    
                    {{-- <x-films-caroussel :films="$films"/> --}}
                    <x-carousels.films-slider :films="$films->where('statut_id', 3)"/>
                </div>

            </div>  
        </div>
              
       
        
        
@endsection