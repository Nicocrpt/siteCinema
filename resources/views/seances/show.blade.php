@extends('layouts.layoutNavigation')
@section('title' , 'Seance')

@section('content')
<div style="height: 100%; width: 100%"  class="relative">

    

    <div style="min-height: 100vh" class="absolute min-w-96 w-full max-w-96 bg-zinc-900 py-6 pt-20 flex flex-col gap-10 shadow-lg shadow-black z-20 margin-0">
            <img src="{{ $seance->film->url_affiche }}" alt="">
            <h1 class="text-2xl text-center mt-2 font-semibold text-zinc-300">Séance du {{ date('d/m/Y',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
            <p class="text-xl text-center text-zinc-300">Salle {{$seance->salle->id}}</p>
    </div>
    
        {{-- Side Menu --}}
        

    <div class=" overflow-hidden overflow-y-auto h-[100vh] ml-96 transition-all ease-in-out duration-700 z-10">
        <div style="margin-top: 80px" class="relative mx-8">
           
            <div x-data="seats()" x-init="init()" class="px-10">


                <div>
                    <p class="text-xl text-center">Sieges séléctionnés : <span x-text="getAllSelected"></span></p>
                </div>
            
                <div class="flex justify-center">
                    <x-seat-selector :salle="$seance->salle"/>
                </div>
                
                <form action="{{route('seances.transfer', $seance->reference)}}" method="POST" class="flex flex-col items-center justify-center m-4">
                    @csrf
                    <input name="seats" type="hidden" x-model="getAllSelected">
                    @error('seats')
                        <p class="text-red-500 pb-4">{{$message}}</p>
                    @enderror
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Valider la selection</button>
                </form>
            </div>
            
        </div>    
    </div>       

        {{-- Main Content --}}
         
</div>

<script>
    window.occuped = @json($places)
</script>
 
@endsection



