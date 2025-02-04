@extends('layouts.layoutNavigation')
@section('title' , 'Réservation validée')

@section('content')
<div class="gap-5 my-auto h-full w-full bg-zinc-50 dark:bg-zinc-800 min-h-[calc(100vh-0px)]">
    <div class="h-16 w-full dark:text-white bg-zinc-100/90 dark:bg-zinc-700/30 bg-opacity-80 backdrop-blur fixed top-[56px] z-20 flex justify-between items-center px-6">
        <h1 class="text-xl md:text-2xl font-semibold">Merci pour votre Réservation ! </h1>

    </div>

    <div class="w-full flex-col items-center justify-center pt-48 z-20">
        <div class="flex justify-center md:gap-4 max-w-[50rem] mx-auto">
            <img src="{{$reservation->seance->film->url_affiche}}" alt="" class="h-64 md:grid-col-1">
            <div class="flex flex-col gap-4 h-full md:grid-col-2 col-span-2">
                <p class="text-xl md:text-3xl font-bold dark:text-white">{{$reservation->seance->film->titre}}</p>
                <div class="flex gap-2">
                    <p class="text-base md:text-xl dark:text-white">Séance du {{ date('d/m',strtotime($reservation->seance->datetime_seance)) }} à {{ date('H:i',strtotime($reservation->seance->datetime_seance)) }}</p>
                    <p class="text-sm text-center text-white bg-zinc-900 p-1 rounded px-2">Salle {{$reservation->seance->salle->id}}</p>
                    <p class="text-sm text-zinc-100 bg-slate-500 p-1 rounded px-2 text-center">{{$reservation->seance->vf == 1 ? 'VF' : 'VO'}}</p>
                        <div class="p-1 px-[0.3rem] -pb-[0.1rem] bg-sky-800 rounded">
                            <svg class="fill-white w-[20px]" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Dolby icon</title><path d="M24,20.352V3.648H0v16.704H24z M18.433,5.806h2.736v12.387h-2.736c-2.839,0-5.214-2.767-5.214-6.194S15.594,5.806,18.433,5.806z M2.831,5.806h2.736c2.839,0,5.214,2.767,5.214,6.194s-2.374,6.194-5.214,6.194H2.831V5.806z"></path></g></svg>
                        </div> 


                </div>
                
                <div class="mt-4">
                    <div class="flex items-center gap-2">
                        <p><span class=" dark:text-white">Place(s) réservée(s) :</span></p>
                        <div class="flex justify-center gap-1 flex-wrap">
                            @foreach ($places as $place)
                                    <p class=" p-1 rounded bg-slate-300 border border-slate-600 dark:border-zinc-400 dark:bg-slate-500 dark:text-white text-xs">{{$place->rangee.$place->numero}}</p>
                            @endforeach
                        </div>  
                    </div>
                    <p class="mt-24 dark:text-white text-sm">ID de réservation : {{$reservation->reference}}</p>
                </div>

            </div>
        </div>
        
        
    </div>
    <p class="text-center dark:text-white text-sm px-2 mt-12 font-light" >un email va vous être envoyé avec un QR Code à présenter à votre arrivée au cinéma.</p>
    <p class="text-center dark:text-white text-sm px-2 -mt-2 font-light pb-24">Vous pouvez également retrouver votre billet dans votre espace personnel</p>
    <div class="fixed bottom-0 w-full grid grid-cols-2 h-16">
        <a type="button" class="bg-sky-700 hover:bg-sky-600 text-white border-r border-r-sky-900 text-center transition-all ease-in-out duration-300 flex justify-center items-center" href="{{route('index')}}" class="py-2 px-4">Retour à l'accueil</a>
        <a type="button" class="bg-sky-700 hover:bg-sky-600 text-white py-2 px-4 border-l border-l-sky-900 transition-all ease-in-out duration-300 flex justify-center items-center" href="{{route('home')}}" class="">Accéder à mon compte</a>
    </div>
</div>
@endsection