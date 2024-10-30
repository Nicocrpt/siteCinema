<div class="flex bg-zinc-300 dark:bg-zinc-700 shadow-md overflow-hidden mx-[4%] md:px-5 my-2 w-[92%] md:h-52 h-40 gap-4 rounded-md">
    <img src="{{$film->url_affiche}}" alt="" class="h-full w-auto">
    <div class="col-span-7 flex flex-col justify-between items-start gap-14 my-4">
        <p><span class="md:text-2xl text-lg font-bold dark:text-white">{{$film->titre}}</p>
        <div class="flex gap-4">
            @foreach ($film->seances as $seance)
                <x-seance-link :seance="$seance"/>
            @endforeach
        </div>
    </div>
</div>