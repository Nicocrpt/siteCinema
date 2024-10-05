<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="display:grid; grid-template-columns: 1fr 3fr">
        <img src="{{ $film->url_affiche }}" alt="" style="width: 500px ; border-radius: 10px">
        <div>
            <h1>{{ $film->titre }}</h1>
            <p>Réalisateur : {{ $film->realisateur }}</p>
            <p>Pays : 
                @foreach ($film->pays as $country)
                    @if ($country === $film->pays->last())
                        {{ $country->nom}}
                    @else
                        {{ $country->nom . ', '}}
                    @endif
                @endforeach</p>
            <p> durée :{{$duration}}</p>
            <p>{{ $film->annee }}</p>   
            <p>{{ $film->synopsis }}</p>
            <a href="{{ route('films.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Retour</a>
        </div>
    </div>
</body>
</html>