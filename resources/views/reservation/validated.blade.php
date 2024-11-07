@extends('layouts.layoutNavigation')
@section('title' , 'Réservation validée')

@section('content')
<div class="flex flex-col items-center justify-center gap-5 my-auto">
    <h1 class="text-xl md:text-3xl text-center pt-24 md:my-auto mb-0 font-bold dark:text-white">Merci pour votre Réservation ! </h1>
    <div class=" md:max-w-[80%] lg:max-w-[60%] xl:max-w-[50%] 2xl:max-w-[40%] w-full overflow-hidden flex-col items-center justify-center border-zinc-400 border-y-2 md:border-2 dark:bg-zinc-600   dark:border-zinc-500 bg-stone-300 md:rounded-lg my-auto">
        <div class="flex items-center justify-start border-b-2 dark:border-zinc-500 border-zinc-400 dark:bg-zinc-700 bg-zinc-300 md: gap-4">
            <img src="{{$reservation->seance->film->url_affiche}}" alt="" class="h-52 md:h-96 md:grid-col-1">
            <div class="flex flex-col gap-4  justify-center items-center h-full m-auto md:grid-col-2 col-span-2">
                <p class="text-xl md:text-3xl font-bold dark:text-white">{{$reservation->seance->film->titre}}</p>
                <p class="text-base md:text-2xl dark:text-white">Séance du {{ date('d/m',strtotime($reservation->seance->datetime_seance)) }} à {{ date('H:i',strtotime($reservation->seance->datetime_seance)) }}</p>
                <div class="flex justify-center items-center h-[44px] gap-2">
                    <p class="text-sm md:text-lg text-center text-zinc-300 bg-zinc-600 p-1 rounded px-2">Salle {{$reservation->seance->salle->id}}</p>
                    @if ($reservation->seance->dolby_atmos)
                        <x-assets.atmos-logo :width="35" :class="'fill-white'"/>  
                    @endif
                    @if ($reservation->seance->dolby_vision)    
                        <x-assets.vision-logo :width="35" :class="'fill-white'"/>
                    @endif
                    @if ($reservation->seance->vf)
                        <p class="text-sm md:text-lg text-center text-zinc-100 bg-slate-500 p-1 rounded px-2">VF</p>
                    @else
                        <p class="text-sm md:text-lg text-center text-zinc-100 bg-slate-500 p-1 rounded px-2" title="{{$reservation->seance->film->langue->langue}}">VOST</p>
                    @endif
                </div> 
            </div>
        </div>
        
        <div class="flex flex-col gap-1 md:col-span-2 p-2 items-center justify-center bg-zinc-200 dark:bg-zinc-600">
            
                <div class="flex flex-col md:flex-row text-lg gap-2 justify-center items-center">
                    <p><span class="font-semibold dark:text-white">Place(s) réservée(s) :</span></p>
                    <div class="flex justify-center gap-1 flex-wrap">
                        @foreach ($places as $place)
                                <p class=" p-1 rounded bg-slate-300 border-2 border-slate-600 dark:border-zinc-400 dark:bg-slate-500 dark:text-white shadow-sm">{{$place->rangee.$place->numero}}</p>
                        @endforeach
                    </div>  
                </div>
                <p class="mt-3 dark:text-white text-sm">ID de réservation : {{$reservation->reference}}</p>
        </div>
    </div>
    <p class="text-center dark:text-white px-2 mb-20" >un email va vous être envoyé avec un QR Code à présenter à votre arrivée au cinéma.</p>
    <div class="fixed bottom-0 w-full grid grid-cols-2 h-16">
        <a type="button" class="bg-cyan-700 hover:bg-cyan-600 text-white border-r border-r-cyan-900 text-center transition-all ease-in-out duration-300" href="{{route('index')}}" class="py-2 px-4">Retour à l'accueil</a>
        <a type="button" class="bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 transition-all ease-in-out duration-300" href="{{route('home')}}" class="">Accéder à mon compte</a>
    </div>
</div>
@endsection