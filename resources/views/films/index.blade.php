<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>films</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div>
        <a href="{{ route('home')}}" class="p-3 bg-slate-100 rounded-xl hover:bg-amber-100 m-5">mon compte</a>
        <h1 class="text-3xl text-center m-10 font-bold">Films</h1>
        <div style="display: flex; flex-wrap : wrap ;flex-direction: row; align-items: center; justify-content: center; gap: 20px">
            @foreach ($films as $film)
                <div class="film" >
                    <a href="{{ route('film.show', $film->slug) }}"><img src="{{ $film->url_affiche }}" alt="" style="width: 200px ; border-radius: 10px" class="hover:border-solid hover:border-green-500 hover:border-2"></a>
                </div>
            @endforeach
        </div>
    </div>


</body>
</html>