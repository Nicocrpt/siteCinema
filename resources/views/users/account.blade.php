@extends('layouts.layout')
@section('title' , 'Mon compte')

@section('content')
    <h1>Hello {{$user->prenom}}</h1>
    @foreach ($user->reservations as $reservation)
        <h3>{{$reservation->reference}}, {{$reservation->seance->datetime_seance}}, {{$reservation->id}}</h3>
        <p>{{$reservation->seance->film->titre}}</p>
        <div>
            @foreach ($reservation->reservationlignes as $ligne)
                <p>{{$ligne->place->rangee . $ligne->place->numero}}</p>
                
            @endforeach
        </div>
    @endforeach
    
    <div class="mt-10">
        <form action="{{ route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-10">
                Se deconnecter
            </button>
        </form>
        
    </div>
    
@endsection