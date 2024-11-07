@extends('layouts.layoutNavigation')
@section('title' , 'Séances')

@section('content')
    <div class="w-full h-full mt-24 ">
        <h1 class="text-3xl font-bold mx-4 mb-4">Nos Séances</h1>
        <div class="flex flex-col items-center pb-24">
            @foreach ($films as $film)
            <x-cards.seances-film-card :film="$film"/>
        @endforeach
        </div>
    </div>
    
    
@endsection