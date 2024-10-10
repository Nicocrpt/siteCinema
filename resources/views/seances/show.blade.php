@extends('layouts.layout')
@section('title' , 'Seance')

@section('content')
    <div>
        <h1 class="text-3xl text-center m-10 font-bold">{{$seance->film->titre}} - séance du {{ date('d/m/Y',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</h1>
        <p class="text-xl text-center">Salle {{$seance->salle->id}}</p>
        <p class="text-xl text-center">Sieges séléctionnés : </p>
    </div>

    <div class="flex justify-center">
        <x-seat-selector :salle="$seance->salle"/>
    </div>
    

@endsection