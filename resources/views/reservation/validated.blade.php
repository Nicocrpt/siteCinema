@extends('layouts.layout')
@section('title' , 'Accueil')

@section('content')
<div class="flex flex-col items-center justify-center gap-10">
    <h1 class="text-3xl text-center m-10 font-bold">Merci pour votre Réservation ! </h1>
    <div class="grid grid-cols-3 w-1/3 m-auto border-2 border-black rounded-xl overflow-hidden bg-slate-200">
        <img src="{{$reservation->seance->film->url_affiche}}" alt="" class="w-full border-l border-t border-b border-r-4 border-black ">
        <div class="col-span-2 p-5">
            <p class="text-3xl font-bold">{{$reservation->seance->film->titre}}</p>
            <p class="text-2xl mt-5">Séance du {{ date('d/m/Y',strtotime($reservation->seance->datetime_seance)) }} à {{ date('H:i',strtotime($reservation->seance->datetime_seance)) }}</p>
                <div class="flex items-center mt-3">
                    <p class="text-3xl">Salle {{$reservation->seance->salle->id}}</p>
                    @if ($reservation->seance->dolby_atmos)
                        <img src="{{Storage::url('seanceAttributes/dolbyAtmos.png')}}" alt="" class="w-20 ml-5">  
                    @endif
                    @if ($reservation->seance->dolby_vision)    
                        <img src="{{Storage::url('seanceAttributes/dolbyVision.png')}}" alt="" class="w-20 ml-5"> 
                    @endif
                    @if ($reservation->seance->vf)
                        <p class="bg-slate-400 text-white rounded-xl p-1 pl-2 pr-2 ml-5">VF</p>
                    @else
                        <p class="bg-slate-400 text-white rounded-xl p-1 pl-2 pr-2 ml-5" title="{{$reservation->seance->film->langue->langue}}">VOST</p>
                    @endif
                </div>
                <div class="flex mt-5 text-xl">
                    <p><span class="font-bold">Place(s) réservée(s) :</span>
                        @foreach ($places as $place)
                            @if ($place === $places->last())
                                <span class="" id="">{{$place->rangee.$place->numero}}</span>
                            @else
                                <span>
                                    <span class="" id="">{{$place->rangee.$place->numero}}</span>
                                    <span>, </span>
                                </span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <p class="mt-5">ID de réservation : {{$reservation->reference}}</p>
        </div>
    </div>
    <p>Votre Réservation a bien été traitée, un email va vous être envoyé avec un QR Code à présenter à votre arrivée au cinéma</p>
    <div>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="{{route('index')}}">Retour à l'accueil</a>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="{{route('home', $reservation)}}">Accéder à mon compte</a>
    </div>
</div>
@endsection