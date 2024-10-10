<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>film - {{$film->titre}}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div style="display:grid; grid-template-columns: 1fr 3fr; gap: 20px" class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 m-3 rounded-2xl">
        <img src="{{ $film->url_affiche }}" alt="" style="width: 500px ; border-radius: 10px">
        <div>
            <h1 class="text-3xl mb-5 p-3">{{ $film->titre }}</h1>
            <p>Réalisateur : 
                @foreach ($film->realisateurs as $realisateur)
                    @if ($realisateur === $film->realisateurs->last())
                        {{ $realisateur->nom}}
                    @else
                        {{ $realisateur->nom . ', '}}
                    @endif
                @endforeach
            </p>
            <p>Pays : 
                @foreach ($film->pays as $country)
                    @if ($country === $film->pays->last())
                        {{ $country->nom}}
                    @else
                        {{ $country->nom . ', '}}
                    @endif
                @endforeach</p>
            <p>Genre(s) : @foreach ($film->genres as $genre)
                @if ($genre === $film->genres->last())
                        {{ $genre->nom}}
                    @else
                        {{ $genre->nom . ', '}}
                    @endif
                
            @endforeach</p>
            <p> durée :{{$duration}}</p>
            <p>{{ $film->date_sortie }}</p> 
            <img src="{{ENV('HOST') . $film->certification->url_logo }}" alt="" class="rounded w-6"></p>  
            <p class="mb-10 mt-10">{{ $film->synopsis }}</p>
            <iframe width="560" height="315" src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen style="border-radius: 10px; shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]"></iframe>
            <div class="pt-10 pb-10">
                <h1 class="pb-5 text-xl">Séances</h1>
                <div class="flex gap-10">
                    @if ($film->seances->count() > 0)
                        @foreach ($film->seances as $seance)
                            <a href="{{ route('seances.show', $seance->id)}}"><div class="flex flex-col justify-center items-center bg-amber-100 rounded-xl p-2">
                                <p class="text-slate-600 font-bold">{{ date('d',strtotime($seance->datetime_seance)) }}</p>
                                <p class="text-slate-600 font-bold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
                            </div></a>
                        @endforeach
                    @else
                        <p><i>Aucune seance disponible</i></p>
                    @endif
                </div>
            </div>
            <a href="{{ route('films.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Retour</a>
        </div>
    </div>
</body>
</html>