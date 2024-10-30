@extends('layouts.layoutNavigation')
@section('title' , 'Seance')

@section('content')
<div class="h-full w-full relative" x-data="seats()" x-init="init()" >

    {{-- :class="seats.length/4 <= 1 ? 'md:max-h-[740px]' : seats.length/4 <= 2 ? 'md:max-h-[800px]' : seats.length/4 <= 3 ? 'md:max-h-[900px]' : 'md:max-h-[1200px]'" --}}

    <div class="fixed md:fixed md:w-80 xl:w-[26rem] w-full h-44 md:h-screen top-0 left-0 pt-14 bg-zinc-900  gap-4 md:gap-10 shadow shadow-black md:shadow-lg z-20 margin-0 overflow-hidden">
            <div class="h-full md:max-h-[800px] xl:max-h-[920px] w-full flex md:block relative" >
                <img id="imageAffiche" src="{{ $seance->film->url_affiche }}" alt="" class="h-full md:w-full md:h-auto w-auto flex-shrink">
            
                <div class="flex flex-col py-4 w-[92%] md:ml-[4%] md:mr-[4%] md:my-[4%] bg-zinc-900 bg-opacity-70 justify-evenly md:justify-start px-4 flex-grow overflow-hidden md:absolute md:bottom-0 backdrop-blur rounded-md md:h-72 xl:h-64">
                    <h1 class="md:text-xl text-center mt-2 font-semibold text-zinc-300">Séance du {{ date('d/m',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
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
                    <div class="flex-col justify-center items-center md:mt-8 hidden md:flex gap-2">
                        <p class="md:text-xl text-center text-zinc-300">Sieges séléctionnés : </p>
                        <div class="flex justify-center gap-1 flex-wrap mx-4 h-auto">
                            <template x-for="seat in seats" :key="seat" class="">
                                <span x-text="seat" class="rounded bg-stone-950 text-white shadow-sm flex py-1 px-2 border border-zinc-900"></span>
                            </template>
                        </div> 
                    </div>
                </div>
            </div>
            
    </div>
    
        {{-- Side Menu --}}
        

    <div class=" overflow-hidden overflow-y-auto h-[100vh] md:ml-80 2xl:ml-[26rem] z-10 pt-48 md:pt-32">
           
            <div class="px-2">

                <div class="flex justify-center aspect-ratio-[16/9] m-auto sm:w-[75%] md:w-[90%] md: ">
                    <x-seat-selector :salle="$seance->salle"/>
                </div>
                
                <div class="flex flex-col justify-start items-center md:mt-20 mt-4 h-[44px] md:hidden  gap-2">
                    <p class="md:text-xl text-center dark:text-white">Sieges séléctionnés : </p>
                    <div class="flex justify-center gap-1 flex-wrap p-2 pb-40">
                        <template x-for="seat in seats" :key="seat" class="">
                            <span x-text="seat" class="rounded bg-stone-300 dark:bg-stone-950 dark:text-white shadow-sm flex py-1 px-2 border dark:border-zinc-900 border-stone-400"></span>
                        </template>
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
            2xl:pl-[26rem]
            z-10
            shadow-lg
            fixed
            bottom-[4.5rem]
            md:bottom-0
            left-0
            w-full
            text-xl
            font-semibold
            h-16
            transition-all
            duration-300
            ease-in-out
            dark:bg-green-700 bg-green-600 hover:bg-green-500 dark:hover:bg-green-600 text-white
            "
            {{-- :class="seats.length == 0 ? '' : 'dark:bg-green-700 bg-green-600 hover:bg-green-500 dark:hover:bg-green-600 text-white opacity-100'" --}}
            x-show="seats.length > 0"
            type="submit" :disabled="seats.length == 0"
            {{-- x-init="$el.classList.remove('opacity-0')" --}}
            x-transition:enter="transition transform ease-out duration-200" 
            x-transition:enter-start="transition opacity-0 transform translate-y-[100%]" 
            x-transition:enter-end="transform opacity-100 translate-y-0"
            x-transition:leave="transition transform ease-in duration-200"
            x-transition:leave-start="transition opacity-100 transform translate-y-0" 
            x-transition:leave-end="transition opacity-0 transform translate-y-[100%]" >
            Je valide ma séléction
        </button>   
    </form>
         
</div>

<script>
    window.occuped = @json($places)
</script>
 
@endsection



