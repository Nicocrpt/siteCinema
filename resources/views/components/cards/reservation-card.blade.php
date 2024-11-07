<div class="reservationDisplay w-full flex flex-col gap-1 md:gap-2 mb-16 transition-all ease-in-out duration-300 overflow-hidden" x-data="{ confirmModal: false }">
    <div class="flex justify-between items-center border-b-[1.5px] pb-2 border-zinc-300 ">
        <div class="flex gap-4 items-center">
            <h2 class="text-sm md:text-2xl font-semibold dark:text-white">Réservation &nbsp {{$reservation->reference}}</h2>
            <p class="hidden md:block text-[0.7rem] text-zinc-400 dark:text-white md:text-xl">{{$reservation->created_at->format('d/m/Y')}}</p>
        </div>
        <div class="flex gap-4 items-center">
            @if ($reservation->is_active)
                <div class="flex items-center" id="actions">
                    {{-- <button class="px-3 hover:text-sky-600 transition-all ease-in-out duration-200 dark:text-white">Modifier</button> --}}
                    <form action="{{route('reservations.destroy', $reservation)}}" method="POST"  data-url="{{ route('reservations.destroy', $reservation) }}">
                        @csrf
                        @method('DELETE')
                        <button @click="onDeleteReservationClick($event)" x-ref="disableReservation" class="text-sm md:text-base  text-black hover:text-red-600 px-3 border-l border-l-zinc-500 hidden">Annuler la Réservation</button>
                        <button @click="confirmModal = true" type="button" class=" text-black text-sm hover:text-red-600 px-3 border-l border-l-zinc-500 dark:text-white">Annuler la Réservation</button>
                    </form>
                </div>
            @else
                <p class="text-xs md:text-lg text-gray-400 italic">Réservation annulée</p>
            @endif

        </div>
        
    </div>

    <div class="flex gap-4 w-full my-1 relative h-32 md:h-48">
        <x-modals.confirmation-modal :content="'annuler cette réservation ?'" :action="'disableReservation'" />
        <img src="{{$reservation->seance->film->url_affiche}}" alt="" class="h-full w-auto rounded-sm filter {{$status}}  transition-all ease-in-out duration-200 imgResa">
        <div class="flex flex-col justify-start gap-[0.15rem] items-start w-full">
            <h1 class="text-md md:text-2xl font-semibold dark:text-white {{$status ? 'text-zinc-500 dark:text-zinc-300' : ''}} transition-all ease-in-out duration-200">{{$reservation->seance->film->titre}}</h1>
            <div class="flex justify-center items-center md:h-[44px] gap-2">
                <p class="text-[0.5rem] md:text-sm text-center text-zinc-300  p-1  rounded px-2 {{$status ? 'text-zinc-300 dark:text-zinc-300 dark:bg-zinc-500 bg-zinc-400' : 'bg-zinc-600'}} transition-all ease-in-out duration-200 salleResa">Salle {{$reservation->seance->salle->id}}</p>
                @if ($reservation->seance->dolby_atmos)
                    <x-assets.atmos-logo :width="30" :class="'fill-black dark:fill-white p-1 border border-black rounded'"/>  
                @endif
                @if ($reservation->seance->dolby_vision)    
                    <x-assets.vision-logo :width="30" :class="'fill-black dark:fill-white p-1 border border-black rounded'"/>
                @endif
                @if ($reservation->seance->vf)
                    <p class="text-[0.5rem] md:text-sm text-center text-zinc-300 bg-slate-500 p-1 rounded px-2 {{$status ? 'text-zinc-500 dark:text-zinc-300 dark:bg-zinc-500 bg-zinc-300' : ''}} transition-all ease-in-out duration-200 language" >VF</p>
                @else
                    <p class="text-[0.5rem] md:text-sm text-center text-zinc-300 bg-slate-500 p-1 rounded px-2 {{$status ? 'text-zinc-500 dark:text-zinc-300 dark:bg-zinc-500 bg-zinc-300' : ''}} transition-all ease-in-out duration-200 language" title="{{$reservation->seance->film->langue->langue}}">VOST</p>
                @endif
            </div>
            
            <div class="md:grid grid-cols-2 w-full mt-2 md:mt-4">
                <div class="flex flex-col md:gap-2">
                    <h3 class="text-[0.7rem] md:text-md font-semibold dark:text-white {{$status ? 'text-zinc-500 dark:text-zinc-300' : ''}} transition-all ease-in-out duration-200">Places réservées :</h3>
                    <div class="flex flex-wrap gap-1 md:gap-2">
                        @foreach ($reservation->reservationlignes as $reservationLigne)
                            <form action="{{route('reservationlignes.destroy', $reservationLigne->id)}}" method="POST" class="flex shadow relative">
                                @csrf
                                @method('DELETE')
                                <p class="text-xs md:text-base dark:text-white px-1 py-[0.1rem] bg-zinc-300 rounded-sm z-10 {{$status ? 'text-zinc-400 dark:text-zinc-300 dark:bg-zinc-500' : ''}} transition-all ease-in-out duration-200 placesID">{{$reservationLigne->place->rangee.$reservationLigne->place->numero}}</p>
                                <button @click="onDeleteLineClick($event)" class="px-1 h-full bg-red-500 rounded-r-sm hover:bg-red-600 text-white text-sm hidden">X</button>
                            </form>
                        @endforeach
                    </div>

                </div>
                <div class="hidden md:block">
                    <h3 class="text-xs md:text-md font-semibold dark:text-white {{$status ? 'text-zinc-500 dark:text-zinc-300' : ''}} transition-all ease-in-out duration-200">Informations</h3>
                    <p class="text-[0.4rem] md:text-base txt dark:text-white {{$status ? 'text-gray-400' : ''}} transition-all ease-in-out duration-200">Date de la séance : {{$reservation->seance->datetime_seance}}</p>
                    <p class="text-[0.4rem] md:text-base txt dark:text-white {{$status ? 'text-gray-400' : ''}} transition-all ease-in-out duration-200">Prix payé : {{$reservation->reservationlignes->sum('prix')}} €</p>
                </div>
            </div>  

            
        </div>
        {{-- <div class="absolute bottom-0 right-0 h-12 w-36 border-r border-b border-zinc-300 rounded-br"></div> --}}
    </div>
    <div class="md:hidden">
        <h3 class="text-xs md:text-md font-semibold dark:text-white {{$status ? 'text-zinc-500 dark:text-zinc-300' : ''}} transition-all ease-in-out duration-200">Informations</h3>
        <p class="text-[0.6rem] md:text-base txt dark:text-white {{$status ? 'text-gray-400' : ''}} transition-all ease-in-out duration-200">Date de la séance : {{$reservation->seance->datetime_seance}}</p>
        <p class="text-[0.6rem] md:text-base txt dark:text-white {{$status ? 'text-gray-400' : ''}} transition-all ease-in-out duration-200">Prix payé : {{$reservation->reservationlignes->sum('prix')}} €</p>
    </div>
    
</div>  
