@extends('layouts.layoutNavigation')
@section('title' , 'Accueil')

@section('content')
<div style="height: 100%; width: 100%"  class="relative" x-data="selectPrices()">

    

    <div class="fixed md:min-h-[100vh] md:min-w-80 h-44 w-full md:max-w-80 bg-zinc-900 pt-14 flex md:flex-col md:gap-10 shadow-lg md:shadow-black z-20 margin-0">
            
            <img src="{{ $seance->film->url_affiche }}" alt="" class="md:w-full md:h-auto w-auto h-full">
            <div class="flex flex-col gap-3 justify-center items-center w-full">
                <h1 class="text-lg text-center mt-2 font-semibold text-zinc-300">Séance du {{ date('d/m',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
                <div class="flex md:flex-col gap-10 justify-center items-center">
                    <div class="flex justify-center items-center h-[44px] gap-2">
                        <p class="text-sm md:text-lg text-center text-zinc-300 bg-zinc-600 p-1 rounded px-2">Salle {{$seance->salle->id}}</p>
                        @if ($seance->dolby_atmos)
                            <x-atmos-logo :width="35" :class="'fill-white'"/>  
                        @endif
                        @if ($seance->dolby_vision)    
                            <x-vision-logo :width="35" :class="'fill-white'"/>
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
    
        {{-- Side Menu --}}
        

    <div class="relative overflow-hidden overflow-y-auto h-[100vh] md:ml-80 transition-all ease-in-out duration-700 z-10 shadow-lg">
        <div class="mx-3 mt-48">
           
            <div class="flex-col items-center justify-center" x-data="seats()">
                <h1 class="md:text-3xl text-2xl text-center m-5 md:m-10 font-bold dark:text-white">Selectionnez vos tarifs</h1>
            
                <div class="border-gray-300 border-2 dark:bg-zinc-600   dark:border-zinc-500 bg-stone-300  rounded-md shadow-sm mt-1 w-full md:max-w-[700px] md:m-auto block mb-24">
                    <div class=" flex flex-col p-5 justify-center items-center">
                        <div class="flex gap-2 items-center">
                            <p class="text-2xl md:text-4xl dark:text-white font-bold">{{$seance->film->titre}}</p>
                            <img src="{{Storage::url($seance->film->certification->url_logo)}}" alt="" class="w-10">
                        </div>
                        
                        
                        <div class="flex mt-5 text-xl flex-col gap-2 md:gap-2 justify-center items-center">
                            <p><span class="font-semibold md:text-lg text-base dark:text-white">{{count($places)}} Place(s) selectionnée(s) :</span></p>
                            <div class="flex flex-wrap gap-1 justify-center items-center">
                                @foreach ($places as $place)
                                    <p class="place{{array_search($place, $places)}} p-1 rounded bg-slate-300 border-2 border-slate-600 dark:border-zinc-400 dark:bg-slate-500 dark:text-white shadow-sm" id="place{{array_search($place, $places)}}">{{$place}}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class=" mt-8 space-x-4">
                            
                            <form action="{{route('reservations.store')}}" method="POST" class="flex flex-col gap-1 md:gap-5" id="reservationForm">
                                <input type="hidden" name="places" id="places" value="{{ implode(',', $places)}}">
                                <input type="hidden" name="seance" id="seance" value="{{ $seance->id }}">
            
                                <div class="grid grid-cols-2 mb-3 justify-center items-center">
                                    <p id="labelSTD" class="md:text-xl dark:text-white p-2 pr-6">Tarif normal (9,00 €)</p>
                                    <div class="flex gap-2 h-12">
                                        <button @click="updateValueSTD" id="minusSTD" type="button" class="bg-gray-300 px-3 text-xl font-bold rounded-full">
                                            <svg class="pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12L18 12" stroke="#000000" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                        <input id="priceSTD" type="text" name="TarifNormal" id="TarifNormal" value="0" class="w-12 text-center text-xl dark:text-white dark:bg-zinc-500 font-semibold rounded-md border-zinc-700 px-2" readonly>
                                        <button @click="updateValueSTD" id="plusSTD" type="button" class="bg-cyan-500 px-3 text-xl font-bold rounded-full">
                                            <svg class="pointer-events-none" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                    </div>
                                    
                                </div>

                                <div class="grid grid-cols-2 mb-3 justify-center items-center">
                                    <p id="labelET" class="md:text-xl dark:text-white p-2 pr-6">Tarif étudiant (6,00 €)</p>
                                    <div class="flex gap-2 h-12">
                                        <button @click="updateValueET" id="minusET" type="button" class="bg-gray-300 px-3 text-xl font-bold rounded-full">
                                            <svg class="pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12L18 12" stroke="#000000" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                        <input id="priceET" type="text" name="TarifEtudiant" id="TarifEtudiant" value="0" class="w-12 text-center text-xl dark:text-white dark:bg-zinc-500 font-semibold rounded-md border-zinc-700 px-2"  readonly>
                                        <button @click="updateValueET" id="plusET" type="button" class="bg-cyan-500 px-3 text-xl font-bold rounded-full">
                                            <svg class="pointer-events-none" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </button>
                                    </div>
                                    
                                </div>
                                
                                
                                <div class="flex mt-5 gap-2 justify-center">
                                    <p class="text-xl dark:text-white">Total :</p>
                                    <p class="text-xl ml-2 font-bold dark:text-white"><span id="total" class="font-bold"> 0</span>€</p>
                                </div>
                 
                                @csrf
                            </form>
                              
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>       

    <button class="
        md:pl-80
        z-10
        shadow-lg
        fixed
        bottom-0
        left-0
        w-full
        text-xl
        font-semibold
        bg-gray-400
        text-gray-500

        h-16
        transition-colors
        duration-300
        ease-in-out
        "
        @click="document.getElementById('reservationForm').submit()"
        :class="places != 0 ? 'bg-gray-300' : 'dark:bg-green-700 bg-green-600 hover:bg-green-500 dark:hover:bg-green-600  text-white'"
        type="submit" :disabled="places != 0">
        Je réserve !
    </button>       
         
</div>

<script>
    window.selectedPlaces = @json($places);
</script>

@endsection


