@extends('layouts.layoutNavigation')
@section('title' , 'Séances')

@section('content')
    <div class="w-full h-full">
        <div class="flex justify-center overflow-hidden">
            <x-date-caroussel class=""/>
        </div>
        
        <div class="flex flex-col items-center">
            @foreach ($films as $film)
            <x-seances-film-card :film="$film"/>
        @endforeach
        </div>
    </div>
    
    
@endsection