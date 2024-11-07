<section class="bg-neutral-50 dark:bg-zinc-700 max-w-[1000px] px-6 md:px-16 rounded-md shadow pt-12 pb-2">
    <div class="flex flex-col gap-1 w-full mb-10">                       
        <h1 class="text-3xl font-semibold dark:text-white">Réservations</h1>
        <p class="text-md dark:text-zinc-300 text-zinc-400">Consultez, modifiez ou annulez vos réservations</p>
    </div>  

    <div class="transition-all ease-in-out duration-300 max-h-full">
        @if ($user->reservations->count() > 0)
            @foreach ($user->reservations->sortByDesc('created_at')->take(2) as $reservation)
                @if ($reservation->is_active)
                    <x-cards.reservation-card :reservation="$reservation" :status="null" />
                @else
                    <x-cards.reservation-card :reservation="$reservation" :status="'grayscale'" />
                @endif
            @endforeach
            <div id="load-more-content">

            </div>
            <div id="loadMoreButton" class="h-14 p-1">
                <a @click="loadMoreReservations()" class="flex justify-center font-medium items-center p-2 w-[80%] md:w-96 mx-auto rounded-md hover:bg-gray-100 dark:hover:bg-zinc-500 mb-4 hover:shadow-sm cursor-pointer transition-all ease-in-out duration-300 border border-zinc-50 hover:border-zinc-200 dark:border-zinc-700 dark:hover:border-zinc-400" :class="{{ $user->reservations->count()}} <= skip ? 'hidden' : 'block'">
                    <p class="dark:text-white flex items-center justify-center gap-4" >Voir Plus</p>
                </a>
            </div>

        @else
            <p class="text-md dark:text-gray-100 text-zinc-700 italic font-medium pt-4 pb-8">Aucune réservation enregistrée</p>
        @endif
    </div>
</section>