@extends('layouts.layoutNavigation')
@php
    $contactTitle = "Le solaris - A propos"
@endphp
@section('title')
    {{$contactTitle}}
@endsection

@section('content')
<div class="h-full bg-zinc-100 dark:bg-zinc-900 w-full">
    <section class="min-h-[calc(100vh-144px)] bg-zinc-50 dark:bg-zinc-800 mx-2 rounded px-2 pt-[128px] flex justify-center">
        <div class="w-[60rem]">
            <h1 class="text-3xl font-semibold dark:text-white mb-4">Où sommes nous ?</h1>
            <p class="dark:text-white">Le Solaris se trouve en périphérie d'Avignon, dans la zone Courtine.</p>
            <h2 class="text-lg font-semibold mt-3 mb-1">Adresse</h2>
            <p>Parc activités de Courtine, 250 Rue du 12 Régiment de Zouaves, 84000 Avignon</p>
            <div id="map" class="w-full aspect-[16/9] my-8">   
            </div>
            <h1 class="text-3xl font-semibold dark:text-white mb-4">Nous contacter</h1>
            <p class="dark:text-white">Pour toute question, remarque ou demande spécifique, vous pouvez nous contacter par mail (cinema@solaris.fr) ou directement via le formulaire ci-dessous :</p>

            <form action="" class="my-6 flex flex-col gap-4 w-full mb-20">
                <div class="flex gap-4 w-full">                    
                    <input name="prenom" placeholder="Prénom" type="text" class="dark:bg-zinc-700 dark:text-white rounded w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500">
                    <input name="nom" placeholder="Nom" type="text" class="dark:bg-zinc-700 dark:text-white rounded w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500"">
                </div>
                <input type="text" name="email" placeholder="Email" class="dark:bg-zinc-700 dark:text-white rounded w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500">
                <textarea name="message" id="" placeholder="Ecrivez votre message..." class="dark:bg-zinc-700 dark:text-white rounded min-h-64 max-h-64 w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500"></textarea>


                <div class="w-full flex justify-end items-center">
                    <button type="submit" class="bg-zinc-900 hover:bg-zinc-800 text-white py-2 px-4 rounded">Envoyer</button>
                </div>               
            </form>
        </div>
        
        
    </section>
    <x-footer class="w-full"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script>
        var map = L.map('map').setView([43.92949508876509, 4.778549811682282], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'}).addTo(map);
        var marker = L.marker([43.92949508876509, 4.778549811682282]).addTo(map);
    </script>
</div>
@endsection