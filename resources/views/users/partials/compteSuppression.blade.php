<section class="bg-neutral-50 dark:bg-zinc-700 max-w-[1000px] px-6 md:px-16 rounded-md shadow pt-12 mb-24 pb-2">
    <div class="flex flex-col gap-1 w-full mb-10">
        <div class="flex items-center gap-2">
            <h1 class="text-3xl font-semibold dark:text-white">Supprimer mon compte</h1>
        </div>
        
        <p class="text-md dark:text-zinc-300 text-zinc-400">En supprimant votre compte, toutes vos données, avantages et abonnements seront effacées, mais les informations de réservations seront toujours disponibles par mail</p>
    </div>
    <div>
        <form method="POST" action="{{route('users.destroy')}}" class="pb-8">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white text-sm font-medium p-2 mx-auto rounded-md hover:bg-red-600 transition-all ease-in-out duration-300 border-b border-red-600">Supprimer mon compte</button>
        </form>
    </div>
</section>