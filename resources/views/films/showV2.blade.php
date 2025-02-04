@extends('layouts.layoutNavigation')
@section('title' , $film->title)
@section('content')




<div style="height: 100%; width: 100%" x-data="filmShow()" x-init="init()" class="relative bg-zinc-50 dark:bg-zinc-800">

    {{-- Fullscreen Image --}}
    <div class="fixed !h-screen !w-screen top-0 left-0 bg-black bg-opacity-90 backdrop-blur-md flex justify-center items-center px-2" style="z-index: 1000" x-show="fullscreenImage" >
        <div class="w-full h-full relative flex justify-center items-center">
            <button @click="fullscreenImage = false; document.querySelector('.solaris').classList.remove('preventScrollWhenModal');" id="exitBtn" class="absolute top-5 right-2 text-white rounded-full font-bold hover:bg-slate-200 hover:bg-opacity-20 transition-all ease-in-out duration-300 p-2"><svg class="h-6 w-6 hover:opacity-90 opacity-70 font-bold" fill="white" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512.481 421.906L850.682 84.621c25.023-24.964 65.545-24.917 90.51.105s24.917 65.545-.105 90.51L603.03 512.377 940.94 850c25.003 24.984 25.017 65.507.033 90.51s-65.507 25.017-90.51.033L512.397 602.764 174.215 940.03c-25.023 24.964-65.545 24.917-90.51-.105s-24.917-65.545.105-90.51l338.038-337.122L84.14 174.872c-25.003-24.984-25.017-65.507-.033-90.51s65.507-25.017 90.51-.033L512.48 421.906z"></path></g></svg></button>
            <div @click.away="fullscreenImage = false; document.querySelector('.solaris').classList.remove('preventScrollWhenModal');" class="max-w-[1800px] md:w-[98%] lg:w-[85%] xl:w-[75%] m-auto" x-ref="fullscreen">
                <x-carousels.monoimageSlider :images="explode(',', $film->images)"/>
            </div>
            
        </div>
    </div>
    
    {{-- Bannière Film --}}
    <div class="fixed md:w-80 2xl:w-[26rem] w-full md:h-screen top-0 left-0 pt-14 bg-zinc-900  gap-4 md:gap-10 shadow shadow-zinc-900 md:shadow-lg z-20 margin-0 overflow-hidden"
    :style="isSmallScreen ? `height: ${maxSize - ((maxSize - minSize) * (scrollState / scrollLimit))}rem` : `height: 100vh`">
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
        <div class="xl:flex md:ml-[20rem] 2xl:ml-[26rem] xl:pt-14 h-full relative xl:mb-12 bg-[#efeff2] xl:bg-zinc-50 dark:bg-zinc-800" :class="fullscreenImage ? 'overflow-hidden fixed' : ''">
                <div class="w-full h-full xl:flex md:ml- max-w-[72rem] mx-auto">
                {{-- Boutons de navigation --}}
                    <div class="xl:hidden w-full max-md:!mx-0 max-md:px-2 h-auto flex xl:pl-[26rem] md:mt-14 flex-col transition-all ease-in-out duration-300 max-md:fixed sticky top-[184px] md:!top-[56px] z-[8]">
                        {{-- <div class="w-full md:hidden" :style="isSmallScreen ? `height: ${maxSize - ((maxSize - minSize) * (scrollState / scrollLimit))}rem` : ``">
                        </div> --}}
                        <div class="flex w-full h-[4.5rem] md:h-20 bg-zinc-100/90  dark:bg-zinc-700/30 bg-opacity-80 backdrop-blur">
                            <button @click="window.scrollTo({top: 0, behavior: 'smooth'}) ;contentFilm = false" class="w-full h-full text-lg xxs:text-2xl font-semibold dark:text-white transition-color ease-in-out duration-300" :class="contentFilm ? 'dark:text-zinc-200/60 hover:dark:text-zinc-50/80 text-zinc-600/40 hover:text-zinc-950/60' : 'dark:text-white'" :disabled="contentFilm == false">Informations</button>
                            <button @click="window.scrollTo({top: 0, behavior: 'smooth'}) ;contentFilm = true; " class="w-full h-full text-lg xxs:text-2xl font-semibold   dark:text-white transition-color ease-in-out duration-300" :class="!contentFilm ? 'dark:text-zinc-200/60 hover:dark:text-zinc-50/80 text-zinc-600/40 hover:text-zinc-950/60' : 'dark:text-white'">Seances</button>
                        </div>
                        
                        
                    </div>

                    {{-- Informations Film --}}
                    <div x-show="contentFilm == false || is2xlScreen == true " class="bg-transparent xl:border-0 ml-2 mr-2 md:mx-0 mt-0 xl:mr-0 xl:my-2 flex flex-col  xl:ml-0 xl:items-center xl:w-full"
                    x-transition:enter="transition linear duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition linear duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                        <div class="min-h-[calc(100vh-128px)] xl:min-h-full pt-6 px-4 pb-4 md:pb-2 w-full md:px-auto bg-zinc-50 dark:bg-[#2d2d33] xl:dark:bg-transparent xl:max-w-[55rem] xl:mx-auto xl:px-6 max-md:rounded max-md:pt-[20rem]">
                            <div x-data="{exist: '{{ $film->url_trailer ?? 'none'}}'}" class="md:max-w-[52rem] xl:max-w-full md:w-full aspect-[16/9] xl:w-[100%] mx-auto" :class="exist == 'none' ? 'hidden' : ''">
                                <h1 class="text-2xl font-semibold dark:text-white mb-4">Trailer</h1>
                                <iframe src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen class="w-full h-full rounded border dark:border-zinc-600" ></iframe>
                            </div>
                            
                            <div class=" md:max-w-[52rem] xl:max-w-full h-[0.15rem] md:w-full mt-12 mb-4 bg-zinc-300 dark:bg-zinc-700 opacity-40 rounded-full mx-auto"></div>
                    
                            <div class="flex flex-col gap-2 w-[auto] xl:w-[100%] md:max-w-[52rem] xl:max-w-full mx-auto">
                                <h1 class="text-2xl font-semibold dark:text-white">Synopsis</h1>
                                <p class="dark:text-white text-sm font-thin">{{ $film->synopsis }}</p>
                            </div>
                            
                            <div class=" h-[0.15rem] md:w-full mt-12 mb-4 bg-zinc-300 dark:bg-zinc-700 opacity-40 rounded-full md:max-w-[52rem] xl:max-w-full mx-auto"></div>
                    
                            <div class="md:w-full mx-auto xl:w-[100%] h-auto rounded md:max-w-[52rem] xl:max-w-full">
                                <h1 class="text-2xl font-semibold dark:text-white mb-4">Gallerie</h1>
                                <div class="p-[0.1rem] rounded border dark:border-zinc-600">
                                    <x-carousels.monoimageSlider :images="explode(',', $film->images)" x-ref="imgSrc"/>
                                </div>
                                
                            </div>

                            <div class="mt-8 mb-12 rounded border dark:border-zinc-700 dark:bg-zinc-600/50 p-4 bg-zinc-100 xl:hidden block">
                                <div class="m-1 rounded">
                                    <div class="flex items-center justify-center gap-4 w-fit mb-4">
                                        <svg class="size-[1.2rem] fill-black dark:fill-white" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M3,16c-0.1,0-0.3,0-0.4-0.1c-0.2-0.1-0.4-0.3-0.5-0.6l-1.4-3.8C0.4,10.8,0.5,10,0.8,9.3C1.1,8.6,1.7,8,2.5,7.7l20.7-7.5 l0,0c0.8-0.3,1.6-0.2,2.3,0.1C26.2,0.6,26.7,1.2,27,2l1.4,3.8c0.1,0.2,0.1,0.5,0,0.8C28.2,6.8,28,6.9,27.8,7L3.3,15.9 C3.2,16,3.1,16,3,16z"></path> </g> <g> <path d="M30,20v-4c0-0.6-0.4-1-1-1H3c-0.6,0-1,0.4-1,1v4H30z"></path> <path d="M2,22v7c0,1.7,1.3,3,3,3h22c1.7,0,3-1.3,3-3v-7H2z"></path> </g> </g></svg>
                                        <h1 class="text-xl font-semibold dark:text-white">L'avis du Solaris</h1>
                                    </div>
                                    <p class="font-thin text-sm dark:text-white italic">
                                        Perfect Blue de Satoshi Kon est un chef-d'œuvre troublant qui brouille brillamment la frontière entre réalité et illusion. Ce thriller psychologique explore la descente aux enfers de Mima, une idole pop reconvertie en actrice, confrontée à l’obsession de ses fans et à sa propre perte d’identité. À travers une mise en scène virtuose et un montage hallucinant, Kon plonge le spectateur dans une paranoïa oppressante, questionnant la célébrité, l’aliénation et la construction de soi. Avec une tension maîtrisée et une narration éclatée, Perfect Blue reste un film culte, puissant et terrifiant, qui continue d’influencer le cinéma contemporain.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <x-footer class="xl:hidden"/> 
                    </div>

                    {{-- Seances Film --}}
                    <div x-show="contentFilm == true || is2xlScreen == true " class="xl:sticky top-[64px] md:min-w-[26rem] xl:w-[40%] xl:max-w-[50rem]  md:min-h-[calc(100vh-130px)]  xl:m-2 xl:ml-0 xl:mb-0 xl:pr-2 md:mx-0 parent xl:h-fit h-full"
                    x-transition:enter="transition linear duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition linear duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                        <div class="min-h-[calc(100vh)] xl:min-h-full h-fit dark:bg-[#2d2d33] xl:dark:bg-transparent bg-zinc-50 max-md:rounded xl:sticky top-[64px] xl:w-full w-auto m-2 md:mx-0 mb-0 mt-0 px-10 pt-10 pb-20 xl:p-4 max-md:pt-80">
                            <div class="h-full w-full">
                                <div class=" z-20 hidden xl:block">
                                    <div class="h-2 w-full dark:bg-zinc-800 bg-zinc-50"></div>
                                    <h1 class="hidden xl:block px-2 text-2xl font-semibold dark:text-white pt-1 pb-3 border-b-2 dark:border-zinc-600 rounded-tr">Seances</h1>
                                </div>
                                
                
                                <div class="flex gap-2 px-4 flex-col pt-2 pb-3 border-l-2 dark:border-zinc-600">
                                    @if (count($datesSeances) > 0)
                                        @foreach ($datesSeances as $dateSeance)
                                            <div class="border-b dark:border-zinc-700 pb-2 xl:w-[95%] {{ $loop->last ? 'border-b-0' : ''}}">
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
                                    @else
                                        <p class="dark:text-zinc-400 text-zinc-400 italic">Aucune seance pour ce film</p>
                                    @endif
                        
                                </div>
                            </div>
                        </div>
                        <x-footer class="xl:hidden"/>  
                    </div>

                </div>

            </div>
            <div class="md:ml-[20rem] 2xl:ml-[26rem] mt-8 mb-24 xl:block hidden">
                <div class=" max-w-[72rem] mx-auto">
                    <div class="mx-6 rounded border dark:border-zinc-700 dark:bg-zinc-600/50 p-4 bg-zinc-100">
                        <div class="flex items-center justify-center gap-4 w-fit mb-4">
                            <svg class="size-[1.2rem] fill-black dark:fill-white" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M3,16c-0.1,0-0.3,0-0.4-0.1c-0.2-0.1-0.4-0.3-0.5-0.6l-1.4-3.8C0.4,10.8,0.5,10,0.8,9.3C1.1,8.6,1.7,8,2.5,7.7l20.7-7.5 l0,0c0.8-0.3,1.6-0.2,2.3,0.1C26.2,0.6,26.7,1.2,27,2l1.4,3.8c0.1,0.2,0.1,0.5,0,0.8C28.2,6.8,28,6.9,27.8,7L3.3,15.9 C3.2,16,3.1,16,3,16z"></path> </g> <g> <path d="M30,20v-4c0-0.6-0.4-1-1-1H3c-0.6,0-1,0.4-1,1v4H30z"></path> <path d="M2,22v7c0,1.7,1.3,3,3,3h22c1.7,0,3-1.3,3-3v-7H2z"></path> </g> </g></svg>
                            <h1 class="text-xl font-semibold dark:text-white">L'avis du Solaris</h1>
                        </div>
                        
                        <p class="font-thin dark:text-white italic">
                            Perfect Blue de Satoshi Kon est un chef-d'œuvre troublant qui brouille brillamment la frontière entre réalité et illusion. Ce thriller psychologique explore la descente aux enfers de Mima, une idole pop reconvertie en actrice, confrontée à l’obsession de ses fans et à sa propre perte d’identité. À travers une mise en scène virtuose et un montage hallucinant, Kon plonge le spectateur dans une paranoïa oppressante, questionnant la célébrité, l’aliénation et la construction de soi. Avec une tension maîtrisée et une narration éclatée, Perfect Blue reste un film culte, puissant et terrifiant, qui continue d’influencer le cinéma contemporain.
                        </p>
                    </div>
                    
                </div>
            </div>
        <x-footer class="md:pl-[20rem] 2xl:pl-[26rem] border-t dark:border-zinc-700 dark:bg-zinc-900/60 bg-zinc-100" x-show="is2xlScreen == true"/>
    </div>
    
    
         
</div>






@endsection

