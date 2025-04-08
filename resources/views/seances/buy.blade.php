@extends('layouts.layoutNavigation')
@section('title' , 'Tarifs')

@section('content')
<div style="height: 100%; width: 100%"  class="relative bg-zinc-50 dark:bg-zinc-800" x-data="selectPrices()">

    <x-modals.guest-modal/>

    <div class="fixed md:fixed md:w-80 xl:w-[26rem] w-full h-44 md:h-screen top-0 left-0 pt-14 bg-zinc-900  gap-4 md:gap-10 shadow shadow-black md:shadow-sm z-20 margin-0 overflow-hidden">
            <div class="h-full md:max-h-[620px] xl:max-h-[760px] w-full flex md:block relative">
                <img src="{{ $seance->film->url_affiche }}" alt="" class="h-full md:w-full md:h-auto w-auto flex-shrink">
                <div class="flex flex-col py-4 w-[94%] md:ml-[3%] md:mr-[3%] md:my-3 bg-zinc-900 bg-opacity-70 justify-evenly md:justify-start px-4 flex-grow overflow-hidden md:absolute md:bottom-0 backdrop-blur rounded-md">
                    <h1 class="text-lg text-center mt-2 font-semibold text-zinc-300">Séance du {{ date('d/m',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
                    <div class="flex md:flex-col gap-10 justify-center items-center">
                        <div class="flex justify-center items-center h-[44px] gap-2">
                            <p class="text-sm md:text-lg text-center text-zinc-300 bg-zinc-600 p-1 rounded px-2">Salle {{$seance->salle->id}}</p>
                            @if ($seance->dolby_atmos)
                                <x-assets.atmos-logo :width="35" :class="'fill-white'"/>  
                            @endif
                            @if ($seance->dolby_vision)    
                                <x-assets.vision-logo :width="35" :class="'fill-white'"/>
                            @endif
                            @if ($seance->vf)
                                <p class="text-sm md:text-lg text-center text-zinc-300 bg-slate-500 p-1 rounded px-2">VF</p>
                            @else
                                <p class="text-sm md:text-lg text-center text-zinc-300 bg-slate-500 p-1 rounded px-2" title="{{$seance->film->langue->langue}}">VOST</p>
                            @endif
                        </div> 
                        
                    </div>
                    
                </div>
            </div>
            
    </div>
    
        {{-- Side Menu --}}
        

    <div class="relative overflow-hidden overflow-y-auto h-[100vh] md:ml-80 xl:ml-[26rem] z-10 shadow-lg">
        <div class="mt-[176px] md:pt-[56px] md:my-auto relative">
            <div class="h-16 w-full dark:text-white bg-zinc-100/90 dark:bg-zinc-700/30 bg-opacity-80 backdrop-blur fixed top-[176px] md:top-[56px] z-20 flex justify-between items-center px-6">
                <h1 class="text-xl md:text-2xl font-semibold">Tarifs</h1>

                <div class="flex gap-2 justify-center md:hidden">
                    <p class="text-xl dark:text-white">Total :</p>
                    <p class="text-xl font-bold dark:text-white"><span class="font-bold total"> 0</span>€</p>
                </div>
            </div>
            
           
            <div class="flex items-center w-full justify-center px-6" x-data="seats()">
            
                <div class="mx-1 mt-16 md:mt-24 w-full max-w-[700px] md:m-auto block mb-1 pt-2 pb-6 md:shadow-inner rounded md:border md:dark:border-zinc-700 md:dark:bg-zinc-700/10">
                    <div class=" flex flex-col p-3 justify-center items-center">
                        <div class="flex gap-2 items-center">
                            <p class="text-2xl md:text-4xl text-center dark:text-white font-bold">{{$seance->film->titre}}</p>
                        </div>
                        
                        
                        <div class="flex mt-4 md:mt-10 text-xl flex-col gap-2 md:gap-2 justify-center items-center">
                            <p><span class="font-semibold text-sm md:text-lg dark:text-white">{{count($places)}} Place(s) selectionnée(s) :</span></p>
                            <div class="flex flex-wrap gap-1 justify-center items-center">
                                @foreach ($places as $place)
                                    <p class="place{{array_search($place, $places)}} p-1 rounded bg-slate-300 border border-slate-600 dark:border-zinc-400 dark:bg-slate-500 dark:text-white text-sm" id="place{{array_search($place, $places)}}">{{$place}}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class=" mt-6 md:mt-12 w-full px-3">     
                            <form action="{{route('reservations.store')}}" method="POST" class="flex flex-col gap-1 md:gap-6" id="reservationForm">
                                <input type="email" class="hidden" name="email" id="email" value="" :disabled="user ? true : false">
                                <input type="hidden" name="prices" id="prices" :value="totalArray">
                                <input type="hidden" name="places" id="places" value="{{ implode(',', $places)}}">
                                <input type="hidden" name="seance" id="seance" value="{{ $seance->id }}">
            
                                <div class="flex mb-2 justify-between gap-4 w-full items-center xxs:w-[22rem] mx-auto">
                                    <p id="labelSTD" class="md:text-xl dark:text-white">Tarif normal (9,00 €)</p>
                                    <div class="flex gap-2 h-12">
                                        <button @click="updateValueSTD" id="minusSTD" type="button" class="size-12 bg-gray-300 px-3 text-xl font-bold rounded border border-zinc-400">
                                            <svg class="pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12L18 12" stroke="#000000" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                        <input id="priceSTD" type="text" name="TarifNormal" id="TarifNormal" value="0" class="size-12 text-center text-xl dark:text-white dark:bg-zinc-500 font-semibold rounded-sm border-zinc-700 px-2" readonly>
                                        <button @click="updateValueSTD" id="plusSTD" type="button" class="size-12 bg-yellow-500 dark:bg-yellow-600 border border-zinc-400 px-3 text-xl font-bold rounded">
                                            <svg class="pointer-events-none" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                    </div>
                                    
                                </div>

                                <div class="flex mb-4 md:mb-2 justify-between gap-4 w-full items-center xxs:w-[22rem] mx-auto">
                                    <div class="flex items-center">
                                        <p id="labelET" class="md:text-xl dark:text-white">Tarif étudiant (6,00 €)</p>
                                        {{-- <div x-data="{ visible: false }">
                                            <svg @click="visible = !visible" @mouseleave="setTimeout(() => { visible = false }, 500)" class="cursor-pointer" viewBox="0 0 24 24" width="20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#clip0_429_11160)"> <circle cx="12" cy="11.9999" r="9" stroke="#292929" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></circle> <rect x="12" y="8" width="0.01" height="0.01" stroke="#292929" stroke-width="3.75" stroke-linejoin="round"></rect> <path d="M12 12V16" stroke="#292929" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> <defs> <clipPath id="clip0_429_11160"> <rect width="24" height="24" fill="white"></rect> </clipPath> </defs> </g></svg>
                                            <x-modals.tool-tip :toolTip="'un justificatif vous sera demandé à l\'entrée du cinéma'" />
                                        </div>    --}}
                                    </div>
                                    
                                    <div class="flex gap-2 h-12 items-center">
                                        <button @click="updateValueET" id="minusET" type="button" class="bg-gray-300 size-12 text-xl font-bold rounded flex justify-center items-center border border-zinc-400">
                                            <svg class="pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12L18 12" stroke="#000000" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                        <input id="priceET" type="text" name="TarifEtudiant" id="TarifEtudiant" value="0" class="size-12  text-center text-xl dark:text-white dark:bg-zinc-500 font-semibold rounded-sm border-zinc-700 px-2"  readonly>
                                        <button @click="updateValueET" id="plusET" type="button" class="bg-yellow-500 dark:bg-yellow-600 border border-zinc-400 size-12 text-xl font-bold rounded flex justify-center items-center">
                                            <svg class="pointer-events-none stroke-white" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                    </div>
                                    
                                </div>
                                <p class="text-center text-xs md:text-sm italic font-light dark:text-zinc-300 text-zinc-700">Pour le tarif étudiant, un justificatif vous sera demandé à l'entrée du cinéma.</p>
                                @csrf
                            </form>
                            
                              
                        </div>
                    </div>
                    <div class="hidden gap-2 justify-center md:flex mt-10">
                        <p class="text-xl dark:text-white">Total :</p>
                        <p class="text-xl font-bold dark:text-white"><span class="font-bold total"> 0</span>€</p>
                    </div>
                </div>
                
            </div>
            
        </div>
        <button class="
            w-full
            xl:ml-[26rem]
            md:ml-80
            z-10
            shadow-lg
            fixed
            bottom-0
            left-0
            xl:w-[calc(100vw-26rem)]
            md:w-[calc(100vw-20rem)]
            text-xl
            font-semibold
            dark:bg-green-700 bg-green-600 hover:bg-green-500 dark:hover:bg-green-600  text-white
            h-16
            "
            @click="console.log(user); user ? document.getElementById('reservationForm').submit() : guestModal = true"
            type="submit" :disabled="places != 0"
            x-show="places == 0"
            x-transition:enter="transition transform ease-out duration-200" 
            x-transition:enter-start="transition opacity-0 transform translate-y-[100%]" 
            x-transition:enter-end="transform opacity-100 translate-y-0"
            x-transition:leave="transition transform ease-in duration-200"
            x-transition:leave-start="transition opacity-100 transform translate-y-0" 
            x-transition:leave-end="transition opacity-0 transform translate-y-[100%]"
            >
            Je réserve !
        </button>    
        
    </div>       

   
</div>

<script>
    window.selectedPlaces = @json($places);
    window.user = @json(Auth::check())
</script>

@endsection


