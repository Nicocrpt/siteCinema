@extends('layouts.layout')
@section('title' , 'Seance')

@section('content')
    <div x-data="seats()" x-init="init()">


        <div>
            <h1 class="text-3xl text-center m-10 font-bold">{{$seance->film->titre}} - séance du {{ date('d/m/Y',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
            <p class="text-xl text-center">Salle {{$seance->salle->id}}</p>
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
    <script>
        window.occuped = @json($places)
    </script>
@endsection