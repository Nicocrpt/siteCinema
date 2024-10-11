@extends('layouts.layout')
@section('title' , 'Accueil')

@section('content')
    <div class="flex-col items-center justify-center">
        <h1 class="text-3xl text-center m-10 font-bold">Résumé de votre selection</h1>

        <div class="grid grid-cols-6 shadow-inner border-solid border-2 border-gray-300 m-auto w-1/2 h-1/2 p-4 rounded-xl">
            <img src="{{$seance->film->url_affiche}}" alt="" class="col-span-2 rounded-xl">
            <div class="col-span-4 flex flex-col p-5 pl-10">
                <p class="text-4xl font-bold">{{$seance->film->titre}}</p>
                <p class="text-2xl mt-5">Séance du {{ date('d/m/Y',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</p>
                <div class="flex mt-5 text-xl">
                    <p><span class="font-bold">Place(s) Réservée(s) :</span>
                        @foreach ($places as $place)
                            @if ($place === end($places))
                            {{ $place}}
                            @else
                            {{ $place . ', '}}
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class=" mt-10 space-x-4">
                    <form action="{{route('reservations.store')}}" method="POST">
                        <input type="hidden" name="places" id="places" value="{{ implode(',', $places)}}">
                        <input type="hidden" name="seance" id="seance" value="{{ $seance->id }}">
                        @csrf
                        <button class="
                        font-bold
                        text-red-500 
                        hover:before:bg-red-500
                        border-red-500 
                        relative h-[50px] w-40
                        overflow-hidden 
                        border-2 border-red-500 
                        bg-white p-2
                        rounded-full
                        shadow shadow-gray-500/50
                        transition-all before:absolute 
                        before:bottom-0 before:left-0 
                        before:top-0 before:z-0 before:h-full before:w-0 
                        before:bg-red-500 before:transition-all
                        before:duration-500 
                        hover:text-white
                        hover:before:left-0 hover:before:w-full
                        "><span class="relative z-10" type="submit">Je réserve !</span></button>
                    </form>
                      
                </div>
            </div>
        </div>
        
    </div>
@endsection