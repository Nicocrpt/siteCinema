@extends('layouts.layoutUser')
@section('title' , 'Votre compte a bien été supprimé')

@section('content')

<div class="mt-24 md:mx-auto mx-2 max-w-[1000px] bg-neutral-50 dark:bg-zinc-700 rounded-md shadow pt-12 pb-6 px-6 md:px-16 h-96 relative">
    <h1 class="text-4xl font-semibold dark:text-white mb-4">Votre compte a bien été supprimé !</h1>
    <p class="text-zinc-400">Cependant, pas de panique, vos réservations restent valable et vous trouverez leurs informations ainsi que les e-billets sur votre boîte mail !</p>
    <a href="{{route('index')}}" class="absolute bottom-5 right-5 text-md text-white w-fit p-2 px-3  rounded-md bg-cyan-600 hover:bg-cyan-500  transition-all ease-in-out duration-200 cursor-pointer mt-6 shadow-sm">Retour à l'accueil</a>
</div>

@endsection