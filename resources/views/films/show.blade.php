<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="display:grid; grid-template-columns: 1fr 3fr; gap: 20px">
        <img src="{{ $film->url_affiche }}" alt="" style="width: 500px ; border-radius: 10px">
        <div>
            <h1>{{ $film->titre }}</h1>
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
            <p>{{ $film->annee }}</p>   
            <p>{{ $film->synopsis }}</p>
            <iframe width="560" height="315" src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen style="border-radius: 10px; shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]"></iframe>
            <a href="{{ route('films.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Retour</a>
        </div>
    </div>
</body>
</html>