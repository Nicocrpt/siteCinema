@extends('layouts.layout')
@section('title' , 'Accueil')

@section('content')
    <div class="mt-10 ml-40 mr-40">
        <div>
            <h1 class="main-title ml-10 mb-20">Les films à l'affiche</h1>
            <div>
                <div>
                    <img src="{{ $films[0]->url_affiche }}" alt="" class="w-96 rounded-3xl">
                </div>
            </div>
        </div>
        


    </div>
@endsection