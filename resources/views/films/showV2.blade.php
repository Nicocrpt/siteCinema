@extends('layouts.layoutNavigation')
@section('title' , $film->title)
@section('content')




<div style="height: 100%; width: 100%" x-data="filmShow()" x-init="init()" class="relative bg-neutral-50 dark:bg-zinc-800">

    
    {{-- Bannière Film --}}
    <div class="fixed md:fixed md:w-80 xl:w-[26rem] w-full top-0 left-0 bg-zinc-900  pt-14 gap-4 md:gap-10 shadow shadow-black md:shadow-lg z-20 margin-0 transition-width ease-in-out duration-100"
    :style="isSmallScreen ? `height: ${maxSize - ((maxSize - minSize) * (scrollState / scrollLimit))}rem` : `height: 100vh`">
        <div class="flex h-full w-full md:flex-col">
            <img src="{{ $film->url_affiche }}" alt="" class="h-full md:w-full md:h-auto w-auto">
            <div class="flex flex-col m-auto justify-evenly md:justify-start px-3 h-full">
                <h1 class="text-xl font-semibold text-zinc-300">{{ $film->titre }}</h1>
                <div class="flex flex-col gap-3">
                    <div class="flex flex-wrap items-center">
                        <p class="text-zinc-300 text-xs font-semibold">De : &ensp;</p>
                        @foreach ($film->realisateurs as $realisateur)
                            @if ($realisateur == $film->realisateurs->last())
                                <p class="text-zinc-300 text-xs">{{ $realisateur->nom }}</p>
                            @else
                            <p class="text-zinc-300 text-xs"> {{ $realisateur->nom . ", &ensp;" }}</p>
                            @endif
                        @endforeach
                    </div>
                    <div class="flex flex-wrap items-center">
                        <p class="text-zinc-300 font-semibold text-xs">Avec : &ensp;</p>
                        
                        @foreach ($film->acteurs as $acteur)
                            @if ($acteur == $film->acteurs->last())
                                <p class="text-zinc-300 text-xs">{{ $acteur->nom }}</p>
                            @else
                                <p class="text-zinc-300 text-xs"> {{ $acteur->nom }}, &ensp;</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="w-screen h-screen relative ">

        {{-- Boutons de navigation --}}
        <div class=" w-full h-auto flex md:pl-80 xl:pl-[26rem] md:mt-0 bg-neutral-50 dark:bg-zinc-800 flex-col transition-all ease-in-out duration-100"
        :style="isSmallScreen ? `margin-top: ${maxSize - ((maxSize - minSize) * (scrollState / scrollLimit))}rem` : ``">
            <div class="h-14 w-full bg-neutral-50 dark:bg-zinc-800 hidden md:block">
                <div class="h-14 w-full">

                </div>
            </div>
            <div class="flex w-full h-16">
                <button @click="contentFilm = false" class="w-full h-full text-md font-semibold dark:text-white  transition-all ease-in-out duration-200" :class="contentFilm == true ? 'bg-neutral-300  shadow-inner-br dark:bg-neutral-700 rounded-br hover:bg-neutral-400 hover:dark:bg-neutral-500' : ''" :disabled="contentFilm == false">Informations</button>
                <button @click="contentFilm = true" class="w-full h-full text-md font-semibold   dark:text-white transition-all ease-in-out duration-200" :class="contentFilm == false ? 'bg-neutral-300 dark:bg-neutral-700 hover:bg-neutral-400 hover:dark:bg-neutral-500  shadow-inner-bl rounded-bl ' : ''">Seances</button>
            </div>
            <div class="h-1 w-full">
                <div class="h-1 w-full shadow-2xl  dark:shadow-zinc-950"></div>
            </div>
            
        </div>
        
        {{-- Informations Film --}}
        <div x-show="contentFilm == false" class=" overflow-hidden overflow-y-auto md:pt-10 pt-10 px-4 gap-2 flex flex-col md:ml-80 xl:ml-[26rem] rounded-xl bg-neutral-50 dark:bg-zinc-800">
            <div class="w-full max-w-[1000px] aspect-[16/9]">
                <iframe src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen class="w-full h-full rounded-md" ></iframe>
            </div>
            
            <div class="max-w-[1000px] h-[0.18rem] w-auto mt-14 mb-4 mx-1 bg-neutral-300 rounded-full dark:bg-neutral-500"></div>
    
            <div class="flex flex-col gap-2 max-w-[1000px] ">
                <h1 class="text-2xl font-semibold dark:text-white">Synopsis</h1>
                <p class="dark:text-white text-sm">{{ $film->synopsis }}</p>
            </div>
            
            <div class="max-w-[1000px] h-[0.18rem] w-auto mt-14 mb-4 mx-1 bg-neutral-300 dark:bg-neutral-500 rounded-full"></div>
    
            <div class=" xl:w-[90%] mx-2 h-auto max-w-[1000px] rounded">
                <x-monoimage-slider :images="explode(',', $film->images)" />

                {{-- @foreach (explode(',', $film->images) as $image)
                    <div id="slide{{array_search($image, explode(',', $film->images))}}" class="carousel-item relative w-full">
                        <img
                        src="{{$image}}"
                        class="w-full" />
                        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                            <a href="#slide{{array_search($image, explode(',', $film->images)) != 0 ? array_search($image, explode(',', $film->images))-1 : array_search($image, explode(',', $film->images))}}" class="btn btn-circle">❮</a>
                            <a href="#slide{{array_search($image, explode(',', $film->images))+1}}" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    
        {{-- Seances Film --}}
        <div x-show="contentFilm == true" class="overflow-hidden overflow-y-auto pt-10  px-4 gap-2 flex flex-col pb-24 md:ml-80 2xl:ml-[32rem] bg-neutral-50 dark:bg-zinc-800">
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
                                        <div class="flex flex-col justify-center items-center rounded bg-slate-200 hover:bg-slate-300 dark:bg-slate-500 dark:hover:bg-slate-400 p-1 px-2 shadow gap-2 pb-2 transition-all ease-in-out duration-200 group">
                                            <p class="dark:text-white font-semibold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
                                            <div class="flex justify-center items-center gap-2">
                                                @if($seance->dolby_atmos)
                                                    <x-atmos-logo :width="25" :class="'fill-black dark:fill-white'"/>
                                                @endif
                                                @if($seance->dolby_vision)
                                                    <x-vision-logo :width="25" :class="'fill-black dark:fill-white'"/>
                                                @endif
                                                @if($seance->vf || (!$seance->vf && $seance->film->langue == 'FR'))
                                                    <p class="bg-slate-300 dark:text-white rounded px-1 dark:group-hover:bg-slate-500 transition-all ease-in-out duration-200" title="Francais">VF</p>
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
    
    
         
</div>






@endsection

