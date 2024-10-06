<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="{{ route('home')}}">mon compte</a>
        <h1>Films</h1>
        <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; gap: 20px">
            @foreach ($films as $film)
                <div class="film" >
                    <a href="{{ route('film.show', $film->slug) }}"><img src="{{ $film->url_affiche }}" alt="" style="width: 200px ; border-radius: 10px"></a>
                </div>
            @endforeach
        </div>
    </div>


</body>
</html>