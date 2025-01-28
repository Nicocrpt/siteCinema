@extends('layouts.layoutNavigation')
@section('title' , $film->title)
@section('content')




<div style="height: 100%; width: 100%" x-data="filmShow()" x-init="init()" class="relative bg-neutral-50 dark:bg-zinc-800">

    {{-- Fullscreen Image --}}
    <div class="fixed !h-screen !w-screen top-0 left-0 bg-black bg-opacity-90 backdrop-blur-md flex justify-center items-center px-2" style="z-index: 1000" x-show="fullscreenImage">
        <div class="w-full h-full relative flex justify-center items-center">
            <button @click="fullscreenImage = false" id="exitBtn" class="absolute top-5 right-2 text-white rounded-full font-bold hover:bg-slate-200 hover:bg-opacity-20 transition-all ease-in-out duration-300 p-2"><svg class="h-6 w-6 hover:opacity-90 opacity-70 font-bold" fill="white" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512.481 421.906L850.682 84.621c25.023-24.964 65.545-24.917 90.51.105s24.917 65.545-.105 90.51L603.03 512.377 940.94 850c25.003 24.984 25.017 65.507.033 90.51s-65.507 25.017-90.51.033L512.397 602.764 174.215 940.03c-25.023 24.964-65.545 24.917-90.51-.105s-24.917-65.545.105-90.51l338.038-337.122L84.14 174.872c-25.003-24.984-25.017-65.507-.033-90.51s65.507-25.017 90.51-.033L512.48 421.906z"></path></g></svg></button>
            <div class="max-w-[1800px] md:w-[98%] lg:w-[85%] xl:w-[75%] m-auto" x-ref="fullscreen">
                <x-carousels.monoimageSlider :images="explode(',', $film->images)"/>
            </div>
            
        </div>
    </div>
    
    {{-- Bannière Film --}}
    <div class="fixed md:w-80 2xl:w-[26rem] w-full md:h-screen top-0 left-0 pt-14 bg-zinc-900  gap-4 md:gap-10 shadow shadow-zinc-900 md:shadow-lg z-20 margin-0 overflow-hidden"
    :style="isSmallScreen ? `height: 12rem` : `height: 100vh`">
        <div class="h-full md:max-h-[630px] xl:max-h-[780px] w-full flex md:block relative">
            <img id="imageAffiche" src="{{ $film->url_affiche }}" alt="" class="h-full md:w-full md:h-auto w-auto flex-shrink">
            <div class="flex flex-col py-4 w-[92%] md:ml-[4%] md:mr-[4%] md:my-[4%] bg-zinc-900 bg-opacity-70 justify-evenly md:justify-start px-4 flex-grow overflow-hidden md:absolute md:bottom-0 md:h-auto backdrop-blur rounded-md">
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


    {{-- Contenu page --}}
    <div class="w-auto h-full">
        <div class="xl:flex 2xl:pl-[26rem] xl:pt-14 xl:gap-2 h-full relative xl:pb-24" :class="fullscreenImage ? 'overflow-hidden fixed' : ''">

                {{-- Boutons de navigation --}}
                <div class="xl:hidden w-full h-auto flex md:pl-80 xl:pl-[26rem] md:mt-14 bg-neutral-50 dark:bg-zinc-800 flex-col transition-all ease-in-out duration-100"
                :style="isSmallScreen ? `margin-top: 12rem` : ``">
                    
                    <div class="flex w-full h-16">
                        <button @click="contentFilm = false" class="w-full h-full text-md font-semibold dark:text-white  transition-all ease-in-out duration-200" :class="contentFilm == true ? 'bg-neutral-300  shadow-inner-br dark:bg-neutral-700 rounded-br hover:bg-neutral-400 hover:dark:bg-neutral-500' : ''" :disabled="contentFilm == false">Informations</button>
                        <button @click="contentFilm = true" class="w-full h-full text-md font-semibold   dark:text-white transition-all ease-in-out duration-200" :class="contentFilm == false ? 'bg-neutral-300 dark:bg-neutral-700 hover:bg-neutral-400 hover:dark:bg-neutral-500  shadow-inner-bl rounded-bl ' : ''">Seances</button>
                    </div>
                    
                    
                </div>

                {{-- Informations Film --}}
                <div x-show="contentFilm == false || is2xlScreen == true " class="gap-2 flex  flex-col md:ml-80 2xl:ml-0 xl:items-center rounded-xl bg-neutral-50 dark:bg-zinc-800 xl:w-full">
                    <div class="min-h-[calc(100vh-224px)] xl:min-h-full pt-10 px-4 md:pb-8 pb-24 md:max-w-[50rem] md:mx-auto  xl:max-w-[55rem] xl:mx-auto xl:px-6">
                        <div x-data="{exist: '{{ $film->url_trailer ?? 'none'}}'}" class="md:w-full aspect-[16/9] xl:w-[100%] mx-auto" :class="exist == 'none' ? 'hidden' : ''">
                            <iframe src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen class="w-full h-full rounded" ></iframe>
                        </div>
                        
                        <div class=" h-[0.18rem] w-auto xl:w-full mt-14 mb-4 mx-1 bg-neutral-300 rounded-full dark:bg-neutral-500"></div>
                
                        <div class="flex flex-col gap-2 w-[auto] xl:w-[95%] ">
                            <h1 class="text-2xl font-semibold dark:text-white">Synopsis</h1>
                            <p class="dark:text-white text-sm">{{ $film->synopsis }}</p>
                        </div>
                        
                        <div class=" h-[0.18rem] w-auto xl:w-full mt-14 mb-4 mx-1 bg-neutral-300 dark:bg-neutral-500 rounded-full"></div>
                
                        <div class="md:w-full mx-auto xl:w-[100%] h-auto rounded">
                            <x-carousels.monoimageSlider :images="explode(',', $film->images)" x-ref="imgSrc"/>
                        </div>
                    </div>
                    <x-footer class="xl:hidden"/> 
                </div>

                {{-- Seances Film --}}
                <div x-show="contentFilm == true || is2xlScreen == true " class="xl:sticky top-[56px] md:min-w-[26rem] xl:w-[40%] xl:max-w-[50rem] gap-2 md:ml-80  xl:ml-0 bg-neutral-50 dark:bg-zinc-800 xl:h-fit h-full">
                    <div class="min-h-[calc(100vh-256px)] xl:min-h-full mt-10 h-fit border-l-2 dark:border-neutral-600 relative xl:w-full w-[90%] mx-auto">
                        <h1 class=" px-2 text-2xl mb-2 font-semibold dark:text-white sticky top-[56px] dark:bg-zinc-800 bg-zinc-50 z-10 py-1 border-b-2 dark:border-neutral-600 xl:w-[80%]">Seances</h1>
            
                        <div class="flex gap-2 px-4 flex-col">
                            @foreach ($datesSeances as $dateSeance)
                                <div class="border-b dark:border-neutral-700 pb-2 xl:w-[80%] {{ $loop->last ? 'border-b-0' : ''}}">
                                    @if($dateSeance == date('d/m/Y'))
                                        <p class=" dark:text-white font-semibold my-2">Aujourd'hui</p>
                                    @else
                                        <p class="my-2 dark:text-white font-semibold">{{$dateSeance}}</p>
                                    @endif
                
                                    <div class="flex gap-4 flex-wrap text-sm">
                                        @foreach ($film->seances as $seance)
                                            @if(strftime('%A %d %B', strtotime($seance->datetime_seance)) == $dateSeance)
                                                <x-cards.seance-link :seance="$seance" />
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                </div>
                

                            @endforeach
                
                        </div>
                    </div>
                    <x-footer class="xl:hidden"/>  
                </div>
        </div>
        <x-footer class="md:pl-[20rem] 2xl:pl-[26rem]" x-show="is2xlScreen == true"/>
    </div>
    
    
         
</div>






@endsection

