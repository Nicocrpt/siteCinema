@extends('layouts.layoutNavigation')
@section('title' , 'Films')
@section('content')



<div style="height: 100%; width: 100%" x-data="{contentFilm: false}">

    

    <div class="absolute md:fixed md:w-80 2xl:w-[32rem] w-full md:h-full h-64 top-0 bg-zinc-900  pt-14 gap-4 md:gap-10 shadow-md md:shadow-lg z-20 margin-0 transition-width ease-in-out duration-100">
        <div class="flex gap-4 h-full w-full md:flex-col">
            <img src="{{ $film->url_affiche }}" alt="" class="h-full w-36 md:w-full md:h-auto">
            <div class="flex flex-col mt-2 justify-evenly">
                <h1 class="text-xl font-semibold text-white">{{ $film->titre }}</h1>
                <div>
                    <p class="text-white text-xs">De :</p>
                    <p class="font-semibold">
                        @foreach ($film->realisateurs as $realisateur)
                            @if ($realisateur == $film->realisateurs->last())
                                <span class="text-white text-xs">{{ $realisateur->nom }}</span>
                            @else
                            <span class="text-white text-xs"> {{ $realisateur->nom . "," }}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <p></p>
                <div>
                    <p class="text-white text-xs">Avec :</p>
                    <p class="font-semibold">
                        @foreach ($film->acteurs as $acteur)
                            @if ($acteur == $film->acteurs->last())
                                <span class="text-white text-xs">{{ $acteur->nom }}</span>
                            @else
                            <span class="text-white text-xs"> {{ $acteur->nom }}, </span>
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class=" w-full mt-64 md:mt-14 h-16 flex md:pl-80 2xl:pl-[32rem]">
        <button @click="contentFilm = false" class="w-full h-full text-md font-semibold dark:text-white  transition-all ease-in-out duration-200" :class="contentFilm == true ? 'bg-neutral-300  shadow-inner-br dark:bg-neutral-700 rounded-br hover:bg-neutral-400 hover:dark:bg-neutral-500' : ''" :disabled="contentFilm == false">Informations</button>
        <button @click="contentFilm = true" class="w-full h-full text-md font-semibold   dark:text-white transition-all ease-in-out duration-200" :class="contentFilm == false ? 'bg-neutral-300 dark:bg-neutral-700 hover:bg-neutral-400 hover:dark:bg-neutral-500  shadow-inner-bl rounded-bl ' : ''">Seances</button>
    </div>
    
    <div x-show="contentFilm == false" class="md:pt-12 pt-10 px-4 gap-2 flex flex-col md:ml-80 2xl:ml-[32rem]">
        <div class="w-full h-[60vw]">
            <iframe src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen class="w-full h-full rounded-md" ></iframe>
        </div>
        
        <div class="h-[0.18rem] w-auto mt-14 mb-4 mx-1 bg-neutral-300 rounded-full dark:bg-neutral-500"></div>

        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-semibold dark:text-white">Synopsis</h1>
            <p class="dark:text-white text-sm">{{ $film->synopsis }}</p>
        </div>
        
        <div class="h-[0.18rem] w-auto mt-14 mb-4 mx-1 bg-neutral-300 dark:bg-neutral-500 rounded-full"></div>

        <div class="mx-4 pb-20">
            <img src="{{ $film->url_backdrop }}" alt="" class="rounded-lg shadow-md">
        </div>
    </div>

    {{-- <div class="h-[0.15rem] w-auto mt-10 mx-5 bg-neutral-300"></div> --}}
        
    <div x-show="contentFilm == true" class="mt-10 px-4 gap-2 flex flex-col pb-10 md:ml-80 2xl:ml-[32rem]">
        <h1 class="text-2xl font-semibold dark:text-white">Seances</h1>

        <div class="flex gap-3 flex-col">
            @foreach ($datesSeances as $dateSeance)
                <div>
                    @if($dateSeance == date('d/m/Y'))
                        <p class=" dark:text-white rounded-xl p-1 pl-2 pr-2">Aujourd'hui</p>
                    @else
                        <p class="my-5 text-lg dark:text-white font-semibold">{{$dateSeance}}</p>
                    @endif

                    <div class="flex gap-10 flex-wrap">
                        @foreach ($film->seances as $seance)
                            @if(strftime('%A %d %B', strtotime($seance->datetime_seance)) == $dateSeance)
                                <a href="{{ route('seances.show', $seance->reference)}}">
                                    <div class="flex flex-col justify-center items-center rounded bg-slate-400 p-1 px-2 hover:shadow-md gap-2 pb-2">
                                        <p class="dark:text-white font-semibold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
                                        <div class="flex justify-center items-center gap-2">
                                            @if($seance->dolby_atmos)
                                                <x-atmos-logo :width="25" :class="'fill-black dark:fill-white'"/>
                                            @endif
                                            @if($seance->dolby_vision)
                                                <x-vision-logo :width="25" :class="'fill-black dark:fill-white'"/>
                                            @endif
                                            @if($seance->vf || (!$seance->vf && $seance->film->langue == 'FR'))
                                                <p class="bg-slate-300 dark:text-white rounded px-1" title="Francais">VF</p>
                                            @else
                                                <p class="bg-slate-300 dark:text-white rounded px-1 " title="{{$seance->film->langue->langue}}">VO</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    
                </div>

                <div class="h-[0.10rem] w-auto mt-4 mx-5 bg-neutral-300 rounded-full"></div>
            @endforeach
  
        </div>
    </div>
    
         
</div>






@endsection

