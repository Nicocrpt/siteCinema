@extends('layouts.layoutAdmin')
@section('title' , 'Films - Gérer les films')

@section('content')
<x-admin.admin-film-heading/>
@if (session('success'))
    <div id="success" class="absolute top-[3.25rem] right-1 bg-green-600 border border-green-700 text-white p-1 flex justify-center items-center rounded transition-all ease-in-out duration-300 -translate-y-[120%]">
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="h-full pb-48 mx-auto px-4">
    <div class="min-w-[1010px] max-w-[1010px] 2xl:max-w-[1410px] mx-auto h-full">
        <form class="w-full flex justify-start items-center gap-2 mt-6" id="queryFilmsForm">
            @csrf
            <input type="text" name="query" id="query" class="rounded w-72 bg-white dark:bg-zinc-600 dark:focus:bg-zinc-500 border border-zinc-500 dark:text-white dark:placeholder:text-zinc-300" placeholder="Rechercher un film">
            <select name="filter" id="filter" class="rounded bg-zinc-200 dark:bg-zinc-900 border border-zinc-500 dark:border-zinc-600 text-black dark:text-zinc-100 w-42 cursor-pointer">
                <option value="all">Tous les films</option>
                <option value="published">Déja à l'affiche</option>
                <option value="unpublished">Non publiés</option>
                <option value="upcoming">Prochainement</option>
                <option value="archived">Archivé</option>
            </select>
            {{-- <button type="submit" id="submitBtn" class="border border-zinc-600 bg-zinc-900 hover:bg-cyan-600 text-white  transition-all ease-in-out duration-200 rounded py-2 px-4">Rechercher</button> --}}
        </form>
        <div class="w-full flex max-h-[calc(100vh-16rem)] flex-wrap gap-2 mt-4 overflow-y-auto bg-zinc-100 border border-zinc-400 dark:border-zinc-500 dark:bg-zinc-600 rounded p-2" id="filmsList">
            @foreach ($films as $film)
            
                <div class="relative group w-48 overflow-hidden rounded shadow-sm" x-data="{miniMenu: false, estFavori: {{ $film->est_favori ? '1' : '0' }}}" x-init="document.querySelectorAll('.menu').forEach(el => el.classList.remove('hidden'))"/>
                    <svg width="22" class="favoriteLabel absolute hover:backdrop-blur-[1.5px] z-50 top-2 left-2 pointer-events-none" :class="estFavori ? 'fill-yellow-300 dark:fill-yellow-400' : 'fill-zinc-300 dark:fill-zinc-600 opacity-60'" viewBox="0 0 64 64"  xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M45.35 6.1709H19.41C16.8178 6.17618 14.3333 7.20827 12.5003 9.04123C10.6674 10.8742 9.63528 13.3587 9.62999 15.9509V52.2709C9.6272 53.3655 9.92973 54.4392 10.5036 55.3713C11.0775 56.3034 11.9 57.057 12.8787 57.5474C13.8573 58.0377 14.9533 58.2454 16.0435 58.1471C17.1337 58.0488 18.1748 57.6484 19.05 56.9909L31.25 47.8509C31.5783 47.6074 31.9762 47.4759 32.385 47.4759C32.7938 47.4759 33.1917 47.6074 33.52 47.8509L45.71 56.9809C46.5842 57.6387 47.6246 58.0397 48.7142 58.1387C49.8038 58.2378 50.8994 58.0311 51.8779 57.5418C52.8565 57.0525 53.6793 56.3001 54.2537 55.3689C54.8282 54.4378 55.1317 53.365 55.13 52.2709V15.9509C55.1247 13.3587 54.0926 10.8742 52.2597 9.04123C50.4267 7.20827 47.9422 6.17618 45.35 6.1709Z"></path> </g>
                    </svg>
                    <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                    <img src="{{$film->url_affiche}}" alt="" class="w-48 z-10 border border-zinc-400 dark:border-zinc-500 rounded">
                    </a>
                    <div @click="window.location.href = '{{route('admin.films.edit', $film->id)}}'" class="absolute top-0 left-0 h-full w-full bg-black hover:backdrop-blur-[1.5px] group-hover:bg-opacity-50 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                        <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                            <p :class="miniMenu ? 'opacity-0' : 'opacity-100'" class="text-white font-semibold text-lg text-center transition-all ease-in-out duration-150 delay-150 p-1">{{$film->titre}}</p>
                            <svg @click.stop="miniMenu = true" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                        </div> 
                    </div>
                    <div @mouseleave="miniMenu = false" :class="miniMenu ? 'opacity-100 flex items-center justify-center' : 'opacity-0 pointer-events-none hidden'" class="menu absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-60 backdrop-blur-[5px] bg-opacity-0 z-30 transition-all ease-in-out duration-300 rounded group cursor-default">
                        <svg @click.stop="miniMenu = false" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white cursor-pointer" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                        <ul @click.away="miniMenu = false" class="h-fit w-fit m-auto flex flex-col justify-center items-center gap-2">
                            <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-all ease-in-out duration-300 cursor-default" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">
                                <form action="" class="favoriteForm">
                                    @csrf
                                    <input type="text" class="hidden filmId" value="{{$film->id}}">
                                    <div class="flex w-full justify-end cursor-default">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <span class="mr-3 text-sm font-medium text-white cursor-default">Favori ? </span>
                                            <input @change="updateFavorite($el); estFavori = !estFavori" type="checkbox" value="" id="favoriteState" class="sr-only peer" {{$film->est_favori ? 'checked' : ''}}>
                                            <div class=" cursor-pointer relative w-11 h-6 bg-zinc-400 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-zinc-400 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600"></div>
                                        </label>
                                    </div> 
                                </form>
                            </li>
                            <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-transform ease-in-out duration-300 delay-50" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-[120%]'">Publier le film</li>
                            <a href="{{ route('admin.films.edit', $film->id) }}"><li  class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-transform ease-in-out duration-300 delay-100" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">Voir les détails</li></a>
                        </ul>
                    </div> 
                </div>

            @endforeach
        </div>
    </div>
    <div class="!w-[100%] !p-0 !m-0 bg-zinc-950  shadow-none z-0 absolute bottom-0 left-0">
        <div class="w-full !h-2 rounded-b bg-zinc-50 dark:bg-zinc-800">
        </div>
        <div class="flex items-center justify-center h-8 w-full">
            <p class="text-zinc-300 text-[0.7rem]">Copyright © Nicolas Carpita 2025 - All Rights Reserved</p>
        </div>
    </div>
</div>

<script>
    const query = document.getElementById('query')
    const filter = document.getElementById('filter')

    filter.addEventListener('change', function () {
        queryMovies()
    })
    query.addEventListener('input', function () {
        queryMovies()
    })

    // btn.addEventListener('click', function(event) {
    // })

    function queryMovies() {
        event.preventDefault()
        url = "{{ route('admin.seances.getFilteredFilms') }}"
        url += '?filter=' + encodeURIComponent(filter.value)
        url += '&query=' + encodeURIComponent(query.value)
        console.log(url)

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
            const filmList = document.getElementById('filmsList')
            filmList.innerHTML = ''
            films.forEach(film => {
                console.log(film.est_favori)
                filmList.innerHTML += `
                    <div class="relative group w-48 overflow-hidden rounded shadow-sm" x-data="{miniMenu: false, estFavori: ${ film.est_favori ? '1' : '0' }}" x-init="document.querySelectorAll('.menu').forEach(el => el.classList.remove('hidden'))"/>
                    <svg wire:click="updateFilm(${film.id})" width="22" class="absolute hover:backdrop-blur-[1.5px] pointer-events-none z-50 top-2 left-2" :class="estFavori ? 'fill-yellow-400' : 'fill-zinc-300 dark:fill-zinc-600 opacity-60'" viewBox="0 0 64 64"  xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M45.35 6.1709H19.41C16.8178 6.17618 14.3333 7.20827 12.5003 9.04123C10.6674 10.8742 9.63528 13.3587 9.62999 15.9509V52.2709C9.6272 53.3655 9.92973 54.4392 10.5036 55.3713C11.0775 56.3034 11.9 57.057 12.8787 57.5474C13.8573 58.0377 14.9533 58.2454 16.0435 58.1471C17.1337 58.0488 18.1748 57.6484 19.05 56.9909L31.25 47.8509C31.5783 47.6074 31.9762 47.4759 32.385 47.4759C32.7938 47.4759 33.1917 47.6074 33.52 47.8509L45.71 56.9809C46.5842 57.6387 47.6246 58.0397 48.7142 58.1387C49.8038 58.2378 50.8994 58.0311 51.8779 57.5418C52.8565 57.0525 53.6793 56.3001 54.2537 55.3689C54.8282 54.4378 55.1317 53.365 55.13 52.2709V15.9509C55.1247 13.3587 54.0926 10.8742 52.2597 9.04123C50.4267 7.20827 47.9422 6.17618 45.35 6.1709Z"></path> </g>
                    </svg>
                        <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                        <img src="${film.url_affiche}" alt="" class="w-48 z-10 border border-zinc-400 rounded">
                        </a>
                        <div class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-50 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                            <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                                <p class="text-white font-semibold text-lg text-center">${film.titre}</p>
                                <svg @click.stop="miniMenu = true" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                            </div> 
                        </div>
                        <div @mouseleave="miniMenu = false" :class="miniMenu ? 'opacity-100 flex items-center justify-center' : 'opacity-0 pointer-events-none hidden'" class="menu absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-60 backdrop-blur-[5px] bg-opacity-0 z-30 transition-all ease-in-out duration-300 rounded group cursor-default">
                            <svg @click.stop="miniMenu = false" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                            <ul @click.away="miniMenu = false" class="h-fit w-fit m-auto flex flex-col justify-center items-center gap-2">
                                <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-all ease-in-out duration-300 cursor-default" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">
                                    <form action="" class="favoriteForm">
                                        @csrf
                                        <input type="text" class="hidden filmId" value="${film.id}">
                                        <div class="flex w-full justify-end cursor-default">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <span class="mr-3 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-default">Favori ? </span>
                                                <input @change="updateFavorite($el); estFavori = !estFavori" type="checkbox" value="" id="favoriteState" class="sr-only peer" ${film.est_favori ? 'checked' : ''}>
                                                <div class=" cursor-pointer relative w-11 h-6 bg-zinc-400 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-zinc-400 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600"></div>
                                            </label>
                                        </div> 
                                    </form>
                                </li>
                                <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-transform ease-in-out duration-300 delay-50" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-[120%]'">Publier le film</li>
                                <a href="{{ route('admin.films.edit', $film->id) }}"><li  class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-transform ease-in-out duration-300 delay-100" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">Voir les détails</li></a>
                            </ul>
                        </div> 
                    </div>
                `
                })

        })
    }

    setTimeout(() => {
        const alert = document.getElementById('success');
        if (alert) {
            alert.classList.remove('-translate-y-[120%]');
            alert.classList.add('translate-y-0');
            setTimeout(() => {
                alert.classList.remove('translate-y-0');
                alert.classList.add('-translate-y-[120%]');
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        }
    }, 300);


    function updateFavorite(element) {
        let url = "{{route('admin.films.updateFavorite')}}"
        const form = element.closest('.favoriteForm')
        const input = form.querySelector('.filmId')

        fetch(url, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value 
            },
            body: JSON.stringify({
                'favoriteState': element.checked,
                'id': input.value
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP ! statut : ${response.status}`);
            }
        })

    }

        

</script>

@endsection