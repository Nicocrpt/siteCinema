@extends('layouts.layoutAdmin')
@section('title' , 'Séances - Gérer les séances')

@section('content')
<style>

    

</style>
<x-admin.admin-seance-heading/>
<div class="h-full w-full flex flex-col gap-14" x-data="seanceManager()" x-init="init()">
    <section class=" flex calendar-container relative h-full w-full">
        <div class="w-[70%] h-full flex flex-col">
            <div class="w-full flex justify-center items-center pt-4">
                <div class="flex rounded overflow-hidden">

                    <button @click="filterEventsByRoom('1')" class="px-2 py-1  text-white hover:bg-red-600 hover:border-red-700 transition-all ease-in-out duration-200 border rounded-l" :class="salle == '1' ? 'bg-red-600 border-red-700' : 'bg-zinc-700 border-zinc-700'" data-room="1" >Salle 1</button>
                    <button @click="filterEventsByRoom('2')" class="px-2 py-1 text-white hover:bg-green-600 hover:border-green-700 transition-all ease-in-out duration-200 border" :class="salle == '2' ? 'bg-green-600 border-green-700' : 'bg-zinc-700 border-zinc-700'" data-room="2">Salle 2</button>
                    <button @click="filterEventsByRoom('3')" class="px-2 py-1 text-white hover:bg-sky-500 hover:border-sky-600 transition-all ease-in-out duration-200 border" :class="salle == '3' ? 'bg-sky-500 border-sky-600' : 'bg-zinc-700 border-zinc-700'" data-room="3">Salle 3</button>
                    <button @click="filterEventsByRoom('all')" class="px-2 py-1 text-white hover:bg-zinc-900 transition-all ease-in-out duration-200 border rounded-r hover:border-zinc-950" :class="salle == 'all' ? 'bg-zinc-900 border-zinc-950' : 'bg-zinc-700 border-zinc-700'" data-room="all">Toutes</button>
                </div>
            </div>
            <div id="calendar" class="h-[calc(100vh-9rem)] px-4 pt-4 pb-10">

            </div>
        </div>

        <div class="relative h-full bg-zinc-100 dark:bg-zinc-700 border-l-2 border-zinc-200 dark:border-zinc-600 min-w-[380px] w-[30%] flex">
            <div class="h-full w-full p-4 shrink-0">
                <form action="" class="">
                    @csrf
                    <select name="filter" id="filmFilter" class="w-full dark:bg-zinc-800 rounded border border-zinc-500 dark:text-white h-[2.2rem] p-0 px-2 mb-[0.95rem]">
                        <option value="all">Tous les films</option>
                        <option value="published">Déja à l'affiche</option>
                        <option value="unpublished">Non publiés</option>
                        <option value="upcoming">Prochainement</option>
                        <option value="archived">Archivé</option>
                    </select>
                    <input type="text" name="query" id="filmQuery" class="rounded w-full dark:bg-zinc-500 border-zinc-400 dark:text-white dark:placeholder:text-zinc-300" placeholder="Rechercher un film">
                </form>
                <div class="overflow-y-auto h-[calc(100vh-16.65rem)] w-full flex flex-col mt-6 border border-zinc-400 dark:border-zinc-500 rounded " id="filmsContainer">
                </div>
            </div>
            <div class="absolute h-full w-full p-1 bg-zinc-100 dark:bg-zinc-700 shrink-0 transition-all ease-in-out duration-300 delay-100 shadow-md overflow-visible" id="filmDetails" :class="detailView == false ? 'left-[100%]' : 'left-0'">

            </div>
        </div>
    </section>
</div>

<script defer>
    const films = @json($films)

    const filmFilter = document.getElementById('filmFilter');
    const filmQuery = document.getElementById('filmQuery');

    document.addEventListener('DOMContentLoaded', function() {
        queryMovies();
    })

    filmQuery.addEventListener('input', function() {
        queryMovies();
    })

    filmFilter.addEventListener('change', function() {
        queryMovies();
    })

    function queryMovies() {
        let url = "{{ route('admin.seances.getFilteredFilms') }}"
        url += '?filter=' + encodeURIComponent(filmFilter.value)
        url += '&query=' + encodeURIComponent(filmQuery.value)

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP ! statut : ${response.status}`);
            }
            return response.json(); // Traiter la réponse comme JSON
        })
        .then(films => {
            let filmContainer = document.getElementById('filmsContainer')
            filmContainer.innerHTML = ''
            films.forEach(film => {
                let heures = Math.floor((parseInt(film.duree)+30) / 60);
                let minutes = (parseInt(film.duree)+30) % 60;
                minutes = minutes.toString().padStart(2, '0');
                filmContainer.innerHTML += `
                    <div @click="injectMovieInfos($el.id) ; detailView = true" class="p-4 flex justify-between items-center gap-10 cursor-pointer ${films.indexOf(film)%2 == 0 ? 'bg-zinc-100 dark:bg-zinc-600 hover:bg-yellow-50 dark:hover:bg-zinc-500' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-yellow-50 dark:hover:bg-zinc-500'}" id="${film.id}">
                        <div class="px-2 py-1 bg-zinc-400 dark:bg-zinc-900 rounded flex gap-1 draggableElement transition-all ease-in-out duration-200" draggable="true" style="cursor: grab" data-title="${film.titre}" data-duration="${heures}:${minutes}:00" datacolor="" data-id="${film.id}">
                            <svg width="14" fill="#ffffff" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M600 1440c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240ZM600 720c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240ZM600 0c132.36 0 240 107.64 240 240S732.36 480 600 480 360 372.36 360 240 467.64 0 600 0Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240S1187.64 0 1320 0Z" fill-rule="evenodd"></path> </g></svg>
                            <p class="dark:text-white">${film.titre}</p>
                        </div>
                            
                        <p class="dark:text-white">${heures}h${minutes}</p>
                    </div>
                `
            });
        })
    }




</script>

@endsection