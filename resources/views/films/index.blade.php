@extends('layouts.layout')
@section('title' , 'Films')
@section('content')
    <div>
            
        <h1 class="text-3xl text-center m-10 font-bold">Films</h1>
        <div style="display: flex; flex-wrap : wrap ;flex-direction: row; align-items: center; justify-content: center; gap: 20px">
            @foreach ($films as $film)
                <div class="film" >
                    <a href="{{ route('film.show', $film->slug) }}"><img src="{{ $film->url_affiche }}" alt="" style="width: 200px ; border-radius: 10px" class="hover:border-solid hover:border-green-500 hover:border-2"></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection