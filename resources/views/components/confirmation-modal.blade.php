<div class="w-full h-full fixed top-0 left-0 flex justify-center items-center z-20" x-show="confirmModal" x-transition:enter="transition-all ease-in-out duration-300" x-transition:leave="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:leave-end="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave-start="opacity-100">
    <div class="p-4 flex flex-col gap-2 items-center justify-center bg-white rounded" @click.away="confirmModal = false">
        <p class="text-lg font-semibold">Etes vous sur de vouloir {{$content}}</p>
        <div class="flex gap-2 justify-center items-center">
            <button @click="confirmModal = false" class="p-1 bg-zinc-300 rounded">Renoncer</button>
            <button @click="confirmModal = false; setTimeout(() => {$refs.{{$action}}.click()}, 500)" class="p-1 bg-red-500 rounded hover:bg-red-600">Confirmer</button>
        </div>
    </div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
<script>
    window.action = @json($action);
</script>