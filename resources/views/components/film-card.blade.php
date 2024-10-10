

<a href="{{route('film.show', $film->slug)}}" class="block">
    <div class="flex-none bg-cover bg-center bg-no-repeat h-120 rounded-xl hover:rounded-3xl w-4/5 p-10 grid grid-cols-2 transition-all ease-in-out duration-700 shadow-md" style="background-image: url({{ $film->url_backdrop}})">
        <div>
            <h1 class="text-5xl font-bold text-white">{{ $film->titre }}</h1>
            <p class="text-white text-xl">{{$film->realisateurs[0]->nom}}</p>
        </div>
        <div class="flex justify-end items-end">
            <p class="text-white text-2xl text-right italic ">{{$film->tagline}}</p>
        </div>
    </div>
</a>