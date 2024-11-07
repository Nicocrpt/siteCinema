<div class=" absolute -top-[0.85rem] right-0 flex justify-center items-center z-20" x-show="confirmModal" x-transition:enter="transition-all transform ease-in-out duration-200" x-transition:leave="transition-all transform ease-in-out duration-200" x-transition:enter-start="opacity-0 scale-0 translate-y-[-80%] translate-x-[25%]" x-transition:leave-end="opacity-0 scale-0 translate-y-[-80%] translate-x-[25%]" x-transition:enter-end="opacity-100 scale-100 translate-y-0 translate-x-0" x-transition:leave-start="opacity-100 scale-100 translate-y-0 translate-x-0">
    <div class="absolute bottom-full left-3/4 -translate-x-1/2 rotate-180 border-8 border-transparent border-t-zinc-900"></div>
    <div class="p-3 flex flex-col gap-2 items-center justify-center bg-zinc-900 shadow rounded-md" @click.away="confirmModal = false">
        <p class="text-xs font-semibold text-white">Etes vous sur de vouloir {{$content}}</p>
        <div class="flex gap-2 justify-center items-center">
            <button @click="confirmModal = false" class="p-1 bg-zinc-700 rounded text-xs text-white">Renoncer</button>
            <button @click="confirmModal = false; setTimeout(() => {$refs.disableReservation.click()}, 500)" class="p-1 bg-zinc-100 text-xs rounded hover:bg-red-500 hover:text-white transition-all ease-in-out duration-200">Confirmer</button>
        </div>
    </div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
