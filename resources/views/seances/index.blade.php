@extends('layouts.layout')
@section('title' , 'Accueil')

@section('content')
    <div class="flex justify-center">
        <x-date-caroussel/>
    </div>
    
    <div class="flex flex-col items-center">
        @foreach ($films as $film)
        <x-seances-film-card :film="$film"/>
    @endforeach
    </div>
    
@endsection