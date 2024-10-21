@extends('layouts.layoutNavigation')
@section('title' , 'Seance')

@section('content')
<div style="height: 100%; width: 100%"  class="relative" x-data="seats()" x-init="init()" >

    

    <div class="fixed md:absolute md:min-h-[100vh] md:min-w-80 h-44 w-full md:max-w-80 bg-zinc-900 pt-14 flex md:flex-col md:gap-10 shadow-lg md:shadow-black z-20 margin-0">
            <img src="{{ $seance->film->url_affiche }}" alt="" class="md:w-full md:h-auto w-auto h-full">
            <div class="flex flex-col gap-3 justify-center items-center w-full">
                <h1 class="md:text-xl text-center mt-2 font-semibold text-zinc-300">Séance du {{ date('d/m/Y',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
                <div class="flex md:flex-col gap-10 justify-center items-center">
                    <div class="flex justify-center items-center h-[44px] gap-2 sm:gap-5">
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
                <div class="flex flex-col justify-center items-center md:mt-20 h-[44px] hidden md:block">
                    <p class="md:text-xl text-center text-white">Sieges séléctionnés : </p>
                    <div class="flex justify-start gap-1 max-w-[150px] overflow-x-auto overflow-y-hidden">
                        <template x-for="seat in seats" :key="seat" class="">
                            <span x-text="seat" class="rounded bg-slate-300 border-2 border-slate-600 dark:border-zinc-400 dark:bg-slate-500 dark:text-white shadow-sm flex"></span>
                        </template>
                    </div> 
                </div>
            </div>
            
    </div>
    
        {{-- Side Menu --}}
        

    <div class=" overflow-hidden overflow-y-auto h-[100vh] md:ml-80 transition-all ease-in-out duration-700 z-10">
        <div class="relative mx-8 mt-56">
           
            <div class="px-10">


                
            
                <div class="flex justify-center">
                    <x-seat-selector :salle="$seance->salle"/>
                </div>
                
            </div>
            
        </div>    
    </div>       

    <form action="{{route('seances.transfer', $seance->reference)}}" method="POST" class="fixed bottom-0 left-0 w-full h-16 items-center justify-center">
        @csrf
        <input name="seats" type="hidden" x-model="getAllSelected">
        {{-- @error('seats')
            <p class="text-red-500 pb-4">{{$message}}</p>
        @enderror --}}
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
            transition-all
            duration-300
            ease-in-out
            "
            :class="seats.length == 0 ? 'bg-gray-300 opacity-0' : 'dark:bg-green-700 bg-green-600 hover:bg-green-500 dark:hover:bg-green-600  text-white'"
            type="submit" :disabled="seats.length == 0">
            Je valide ma séléction
        </button>   
    </form>
         
</div>

<script>
    window.occuped = @json($places)
</script>
 
@endsection



