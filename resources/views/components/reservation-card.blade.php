<div class="reservationDisplay w-full flex flex-col gap-2 max-w-[800px] mb-16">
    <div class="flex justify-between items-center border-b-[1.5px] pb-3 border-zinc-300">
        <div class="flex gap-4 items-center">
            <h2 class="text-2xl font-semibold dark:text-white">Réservation &nbsp {{$reservation->reference}}</h2>
            <p class="text-zinc-400 dark:text-white text-xl">{{$reservation->created_at->format('d/m/Y')}}</p>
        </div>
        @if ($reservation->is_active)
            <div class="flex items-center" id="actions">
                <button class="px-3 hover:text-sky-600 transition-all ease-in-out duration-200 dark:text-white">Modifier</button>
                <form action="{{route('reservations.destroy', $reservation)}}" method="POST"  data-url="{{ route('reservations.destroy', $reservation) }}">
                    @csrf
                    @method('DELETE')
                    <button @click="onDeleteReservationClick($event)" x-ref="disableReservation" class=" text-black hover:text-red-600 px-3 border-l border-l-zinc-500 hidden">Annuler la Réservation</button>
                    <button @click="confirmModal = true" type="button" class=" text-black hover:text-red-600 px-3 border-l border-l-zinc-500 dark:text-white">Annuler la Réservation</button>
                </form>
            </div>
        @else
            <p class="text-lg text-gray-400 italic">Réservation annulée</p>
        @endif
    </div>

    <div class="flex gap-4 w-full my-1">
        <img src="{{$reservation->seance->film->url_affiche}}" alt="" class="w-1/6 rounded-sm {{$status}} imgResa">
        <div class="flex flex-col justify-start items-start w-full">
            <h1 class="text-2xl font-semibold dark:text-white {{$status ? 'text-zinc-600 dark:text-zinc-300' : ''}}">{{$reservation->seance->film->titre}}</h1>
            <div class="flex justify-center items-center h-[44px] gap-2">
                <p class="text-sm text-center text-zinc-300 bg-zinc-600 p-1 rounded px-2">Salle {{$reservation->seance->salle->id}}</p>
                @if ($reservation->seance->dolby_atmos)
                    <x-atmos-logo :width="30" :class="'fill-black dark:fill-white p-1 border border-black rounded'"/>  
                @endif
                @if ($reservation->seance->dolby_vision)    
                    <x-vision-logo :width="30" :class="'fill-black dark:fill-white p-1 border border-black rounded'"/>
                @endif
                @if ($reservation->seance->vf)
                    <p class="text-sm text-center text-zinc-300 bg-slate-500 p-1 rounded px-2 {{$status ? 'text-zinc-600 dark:text-zinc-300 bg-zinc-500' : ''}}">VF</p>
                @else
                    <p class="text-sm text-center text-zinc-300 bg-slate-500 p-1 rounded px-2 {{$status ? 'text-zinc-600 dark:text-zinc-300 bg-zinc-500' : ''}}" title="{{$reservation->seance->film->langue->langue}}">VOST</p>
                @endif
            </div>
            <div class="grid grid-cols-2 w-full mt-4">
                <div class="flex flex-col gap-2">
                    <h3 class="text-md font-semibold dark:text-white {{$status ? 'text-zinc-600 dark:text-zinc-300' : ''}}">Places réservées :</h3>
                    <div class="flex gap-2">
                        @foreach ($reservation->reservationlignes as $reservationLigne)
                            <form action="{{route('reservationlignes.destroy', $reservationLigne->id)}}" method="POST" class="flex shadow relative">
                                @csrf
                                @method('DELETE')
                                <p class="dark:text-white px-1 bg-zinc-300 rounded-sm z-10 {{$status ? 'text-zinc-600 dark:text-zinc-300 bg-zinc-500' : ''}}">{{$reservationLigne->place->rangee.$reservationLigne->place->numero}}</p>
                                <button @click="onDeleteLineClick($event)" class="px-1 h-full bg-red-500 rounded-r-sm hover:bg-red-600 text-white text-sm hidden">X</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </div>  
        </div>
    </div>
</div>






{{-- <div class="reservationDisplay relative grid grid-cols-4 p-2 border border-zinc-400 shadow-md bg-zinc-600 hover:bg-zinc-500 rounded-lg mb-5 transition-all ease-in-out duration-300" style="max-width: 1000px">
    <form action="{{route('reservations.destroy', $reservation)}}" method="POST" class="absolute top-0 right-0 p-2" data-url="{{ route('reservations.destroy', $reservation) }}">
        @csrf
        @method('DELETE')
        <button @click="onDeleteReservationClick($event)" id="deleteReservation" class="px-4 py-2 bg-red-500 rounded-md hover:bg-red-600">X</button>
    </form>
    <img class="col-span-1 rounded-md w-full" src="{{$reservation->seance->film->url_affiche}}" alt="">
    <div class="col-span-3 pl-5">
        <h1 class="text-xl font-semibold dark:text-white">{{$reservation->seance->film->titre}}</h1>
        <p class="dark:text-white" >{{$reservation->seance->datetime_seance}}</p>
        <p class="dark:text-white">référence : {{$reservation->reference}}</p>
        <div class="mt-4 flex flex-col w-full gap-2">
            @foreach ($reservation->reservationlignes as $reservationLigne)
                <form action="{{route('reservationlignes.destroy', $reservationLigne->id)}}" method="POST" class="flex justify-start items-center gap-2">
                    @csrf
                    @method('DELETE')
                    <p>{{$reservationLigne->place->rangee.$reservationLigne->place->numero}}</p>
                    <button @click="onDeleteLineClick($event)" class="px-2 py-1 h-full bg-red-500 rounded-md hover:bg-red-600">X</button>
                </form>
            @endforeach
        </div>
    </div>
</div> --}}