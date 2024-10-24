@extends('layouts.layoutNavigation')
@section('title' , 'Films')
@section('content')
    <div class="flex flex-col mt-32 mx-10">
            
        <h1 class="text-4xl font-bold">Nos Films</h1>
        <p class="text-xl font-semibold dark:text-white my-4">À l'affiche</p>
        <div style="display: flex; flex-wrap : wrap ;flex-direction: row; align-items: center; justify-content: start; gap: 20px">
            @foreach ($films as $film)
                <div class="film flex flex-col items-center justify-center max-w-[200px]" >
                    <a href="{{ route('film.show', $film->slug) }}"><img src="{{ $film->url_affiche }}" alt="" style="width: 200px ; border-radius: 10px" class="hover:border-solid hover:border-green-500 hover:border-2"></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection