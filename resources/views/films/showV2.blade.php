@extends('layouts.layoutNavigation')
@section('title' , $film->title)
@section('content')




<div style="height: 100%; width: 100%" x-data="filmShow()" x-init="init()" class="relative bg-zinc-50 dark:bg-zinc-800">

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
        <div class="h-full md:max-h-[630px] 2xl:max-h-[780px] w-full flex md:block relative">
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
        <div class="xl:flex 2xl:ml-[26rem] xl:pt-14 h-full relative xl:mb-12 bg-[#efeff2] xl:bg-zinc-50 dark:bg-zinc-800" :class="fullscreenImage ? 'overflow-hidden fixed' : ''">

                {{-- Boutons de navigation --}}
                <div class="xl:hidden w-full h-auto flex md:pl-80 xl:pl-[26rem] md:mt-14 bg-[#efeff2]  dark:bg-zinc-800 flex-col transition-all ease-in-out duration-100 sticky top-[192px] md:top-[56px] pb-2 z-[8]"
                :style="isSmallScreen ? `margin-top: 12rem` : ``">
                    
                    <div class="flex w-full h-16">
                        <button @click="contentFilm = false" class="w-full h-full text-md font-semibold dark:text-white  transition-all ease-in-out duration-200" :class="contentFilm == true ? 'bg-zinc-300  shadow-inner-br dark:bg-zinc-700 rounded-br hover:bg-zinc-400 hover:dark:bg-zinc-500' : ''" :disabled="contentFilm == false">Informations</button>
                        <button @click="contentFilm = true" class="w-full h-full text-md font-semibold   dark:text-white transition-all ease-in-out duration-200" :class="contentFilm == false ? 'bg-zinc-300 dark:bg-zinc-700 hover:bg-zinc-400 hover:dark:bg-zinc-500  shadow-inner-bl rounded-bl ' : ''">Seances</button>
                    </div>
                    
                    
                </div>

                {{-- Informations Film --}}
                <div x-show="contentFilm == false || is2xlScreen == true " class="bg-transparent xl:border-0 ml-2 mr-2 mt-0 xl:mr-0 xl:my-2 flex flex-col md:ml-[20.5rem] 2xl:ml-0 xl:items-center xl:w-full">
                    <div class="min-h-[calc(100vh-128px)] xl:min-h-full pt-6 px-4 pb-4 md:pb-2 w-full md:px-auto bg-zinc-50 dark:bg-[#2d2d33] xl:dark:bg-transparent xl:max-w-[55rem] xl:mx-auto xl:px-6 rounded">
                        <div x-data="{exist: '{{ $film->url_trailer ?? 'none'}}'}" class="md:max-w-[52rem] xl:max-w-full md:w-full aspect-[16/9] xl:w-[100%] mx-auto" :class="exist == 'none' ? 'hidden' : ''">
                            <h1 class="text-2xl font-semibold dark:text-white mb-4">Trailer</h1>
                            <iframe src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen class="w-full h-full rounded" ></iframe>
                        </div>
                        
                        <div class=" md:max-w-[52rem] xl:max-w-full h-[0.15rem] md:w-full mt-12 mb-4 bg-zinc-300 dark:bg-zinc-700 opacity-40 rounded-full mx-auto"></div>
                
                        <div class="flex flex-col gap-2 w-[auto] xl:w-[100%] md:max-w-[52rem] xl:max-w-full mx-auto">
                            <h1 class="text-2xl font-semibold dark:text-white">Synopsis</h1>
                            <p class="dark:text-white text-sm font-thin">{{ $film->synopsis }}</p>
                        </div>
                        
                        <div class=" h-[0.15rem] md:w-full mt-12 mb-4 bg-zinc-300 dark:bg-zinc-700 opacity-40 rounded-full md:max-w-[52rem] xl:max-w-full mx-auto"></div>
                
                        <div class="md:w-full mx-auto xl:w-[100%] h-auto rounded md:max-w-[52rem] xl:max-w-full">
                            <h1 class="text-2xl font-semibold dark:text-white mb-4">Gallerie</h1>
                            <x-carousels.monoimageSlider :images="explode(',', $film->images)" x-ref="imgSrc"/>
                        </div>

                        <div class="md:pl-[20rem] 2xl:pl-[26rem] mt-8 border p-1 rounded dark:border-zinc-700 dark:bg-zinc-600/50 md:hidden block">
                            <div class="m-1 rounded">
                                <h1 class="text-xl font-semibold mb-4 dark:text-white">L'avis du Solaris</h1>
                                <p class="font-thin text-sm dark:text-white italic">
                                    Perfect Blue de Satoshi Kon est un chef-d'œuvre troublant qui brouille brillamment la frontière entre réalité et illusion. Ce thriller psychologique explore la descente aux enfers de Mima, une idole pop reconvertie en actrice, confrontée à l’obsession de ses fans et à sa propre perte d’identité. À travers une mise en scène virtuose et un montage hallucinant, Kon plonge le spectateur dans une paranoïa oppressante, questionnant la célébrité, l’aliénation et la construction de soi. Avec une tension maîtrisée et une narration éclatée, Perfect Blue reste un film culte, puissant et terrifiant, qui continue d’influencer le cinéma contemporain.
                                </p>
                            </div>
                        </div>
                    </div>
                    <x-footer class="xl:hidden"/> 
                </div>

                {{-- Seances Film --}}
                <div x-show="contentFilm == true || is2xlScreen == true " class="xl:sticky top-[64px] md:min-w-[26rem] xl:w-[40%] xl:max-w-[50rem]  md:ml-[20rem] md:min-h-[calc(100vh-130px)]  xl:m-2 xl:ml-0 xl:mb-0 xl:pr-2 bg-transparent xl:h-fit h-full">
                    <div class="min-h-[calc(100vh-224px)] xl:min-h-full h-fit dark:bg-[#2d2d33] xl:dark:bg-transparent bg-zinc-50 rounded sticky top-[64px] xl:w-full w-auto m-2 mb-0 mt-0 px-10 pt-10 pb-20 xl:p-4">
                        <div class="h-full w-full">
                            <div class=" z-20 hidden xl:block">
                                <div class="h-2 w-full dark:bg-zinc-800 bg-zinc-50"></div>
                                <h1 class="hidden xl:block px-2 text-2xl font-semibold dark:text-white dark:bg-zinc-600 bg-zinc-100 py-1 border-b-2 border-l-2 dark:border-zinc-600 rounded-tr">Seances</h1>
                            </div>
                            
            
                            <div class="flex gap-2 px-4 flex-col pt-2 border-l-2 dark:border-zinc-600">
                                @foreach ($datesSeances as $dateSeance)
                                    <div class="border-b dark:border-zinc-700 pb-2 xl:w-[80%] {{ $loop->last ? 'border-b-0' : ''}}">
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
                    </div>
                    <x-footer class="xl:hidden"/>  
                </div>
        </div>
        <div class="md:pl-[20rem] 2xl:pl-[26rem] mt-8 mb-24 md:block hidden">
            <div class="m-1 rounded border p-4 dark:border-zinc-700 dark:bg-zinc-600/50 ml-8 mr-[6.5rem]">
                <h1 class="text-xl font-semibold mb-4 dark:text-white">L'avis du Solaris</h1>
                <p class="font-thin dark:text-white italic">
                    Perfect Blue de Satoshi Kon est un chef-d'œuvre troublant qui brouille brillamment la frontière entre réalité et illusion. Ce thriller psychologique explore la descente aux enfers de Mima, une idole pop reconvertie en actrice, confrontée à l’obsession de ses fans et à sa propre perte d’identité. À travers une mise en scène virtuose et un montage hallucinant, Kon plonge le spectateur dans une paranoïa oppressante, questionnant la célébrité, l’aliénation et la construction de soi. Avec une tension maîtrisée et une narration éclatée, Perfect Blue reste un film culte, puissant et terrifiant, qui continue d’influencer le cinéma contemporain.
                </p>
            </div>
        </div>
        <x-footer class="md:pl-[20rem] 2xl:pl-[26rem] border-t dark:border-zinc-700 dark:bg-zinc-900 bg-zinc-100" x-show="is2xlScreen == true"/>
    </div>
    
    
         
</div>






@endsection

