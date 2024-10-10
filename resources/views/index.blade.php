@extends('layouts.layout')
@section('title' , 'Accueil')

@section('content')
    <div class="mt-10 ml-40 mr-40">
        <div>
            <h1 class="main-title ml-10 mb-20">Les films à l'affiche</h1>
            <div class="overflow-x-auto .hide-scroll">
                <div class="flex gap-5">
                    @foreach ($films->take(3) as $film)
                        <x-film-card :film="$film"/>
                    @endforeach  
                </div>
            </div>
            
        </div>
        


    </div>
@endsection