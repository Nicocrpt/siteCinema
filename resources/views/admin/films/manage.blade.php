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
    <div class="md:max-w-[800px] lg:max-w-[1010px] 2xl:max-w-[1412px] mx-auto h-full">
        <form class="w-full flex justify-start items-center gap-2 mt-6" id="queryFilmsForm">
            @csrf
            <input type="text" name="query" id="query" class="rounded w-72 bg-white dark:bg-zinc-600 dark:focus:bg-zinc-500 border border-zinc-500 dark:text-white dark:placeholder:text-zinc-300" placeholder="Rechercher un film">
            <select name="filter" id="filter" class="rounded bg-zinc-200 dark:bg-zinc-400 border border-zinc-500 text-black dark:text-zinc-100 w-42">
                <option value="all">Tous les films</option>
                <option value="published">Déja à l'affiche</option>
                <option value="unpublished">Non publiés</option>
                <option value="upcoming">Prochainement</option>
                <option value="archived">Archivé</option>
            </select>
            {{-- <button type="submit" id="submitBtn" class="border border-zinc-600 bg-zinc-900 hover:bg-cyan-600 text-white  transition-all ease-in-out duration-200 rounded py-2 px-4">Rechercher</button> --}}
        </form>
        <div class="w-full flex max-h-[calc(100vh-14rem)] flex-wrap gap-2 mt-4 overflow-y-auto bg-zinc-100 border border-zinc-400 dark:border-zinc-500 dark:bg-zinc-600 rounded p-2" id="filmsList">
            @foreach ($films as $film)
            
                <div class="relative group w-48 overflow-hidden rounded shadow-sm" x-data="{miniMenu: false}" x-init="document.querySelectorAll('.menu').forEach(el => el.classList.remove('hidden'))"/>
                    {{-- <svg width="20" class="absolute z-50 top-1 left-1 {{ $film->est_favori ? 'dark:fill-yellow-400 fill-yellow-300' : 'fill-zinc-300 dark:fill-zinc-600 opacity-60'}}"  viewBox="-5.5 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m0 2.089v21.912l6.546-6.26 6.545 6.26v-21.912c-.012-1.156-.952-2.089-2.109-2.089-.026 0-.051 0-.077.001h.004-8.726c-.022-.001-.047-.001-.073-.001-1.158 0-2.098.933-2.109 2.088v.001z"></path></g></svg> --}}
                    <svg width="24" class="absolute z-50 top-1 left-1 {{ $film->est_favori ? 'dark:fill-yellow-400 fill-yellow-300' : 'fill-zinc-300 dark:fill-zinc-600 opacity-60'}}" viewBox="0 0 64 64"  xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M45.35 6.1709H19.41C16.8178 6.17618 14.3333 7.20827 12.5003 9.04123C10.6674 10.8742 9.63528 13.3587 9.62999 15.9509V52.2709C9.6272 53.3655 9.92973 54.4392 10.5036 55.3713C11.0775 56.3034 11.9 57.057 12.8787 57.5474C13.8573 58.0377 14.9533 58.2454 16.0435 58.1471C17.1337 58.0488 18.1748 57.6484 19.05 56.9909L31.25 47.8509C31.5783 47.6074 31.9762 47.4759 32.385 47.4759C32.7938 47.4759 33.1917 47.6074 33.52 47.8509L45.71 56.9809C46.5842 57.6387 47.6246 58.0397 48.7142 58.1387C49.8038 58.2378 50.8994 58.0311 51.8779 57.5418C52.8565 57.0525 53.6793 56.3001 54.2537 55.3689C54.8282 54.4378 55.1317 53.365 55.13 52.2709V15.9509C55.1247 13.3587 54.0926 10.8742 52.2597 9.04123C50.4267 7.20827 47.9422 6.17618 45.35 6.1709Z"></path> </g></svg>
                    <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                    <img src="{{$film->url_affiche}}" alt="" class="w-48 z-10 border border-zinc-400 rounded">
                    </a>
                    <div class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-50 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                        <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                            <p :class="miniMenu ? 'opacity-0' : 'opacity-100'" class="text-white font-semibold text-lg text-center transition-all ease-in-out duration-150 delay-150">{{$film->titre}}</p>
                            <svg @click.stop="miniMenu = true" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                        </div> 
                    </div>
                    <div @mouseleave="miniMenu = false" :class="miniMenu ? 'opacity-100' : 'opacity-0 pointer-events-none'" class="menu hidden absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-60 backdrop-blur bg-opacity-0 z-30 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                        <svg @click.stop="miniMenu = false" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                        <ul class="h-full w-full flex flex-col justify-center items-center gap-2">
                            <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-all ease-in-out duration-300" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">Mettre en favori</li>
                            <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-transform ease-in-out duration-300 delay-50" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-[120%]'">Publier le film</li>
                            <a href="{{ route('admin.films.edit', $film->id) }}"><li  class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-transform ease-in-out duration-300 delay-100" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">Voir les détails</li></a>
                        </ul>
                    </div> 
                </div>

            @endforeach
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
                    <div class="relative group w-48 overflow-hidden rounded shadow-sm" x-data="{miniMenu: false}">
                        <svg width="24" class="absolute z-50 top-1 left-1 ${film.est_favori == 1 ? 'dark:fill-yellow-400 fill-yellow-300' : 'fill-zinc-300 dark:fill-zinc-600 opacity-60'}" viewBox="0 0 64 64"  xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M45.35 6.1709H19.41C16.8178 6.17618 14.3333 7.20827 12.5003 9.04123C10.6674 10.8742 9.63528 13.3587 9.62999 15.9509V52.2709C9.6272 53.3655 9.92973 54.4392 10.5036 55.3713C11.0775 56.3034 11.9 57.057 12.8787 57.5474C13.8573 58.0377 14.9533 58.2454 16.0435 58.1471C17.1337 58.0488 18.1748 57.6484 19.05 56.9909L31.25 47.8509C31.5783 47.6074 31.9762 47.4759 32.385 47.4759C32.7938 47.4759 33.1917 47.6074 33.52 47.8509L45.71 56.9809C46.5842 57.6387 47.6246 58.0397 48.7142 58.1387C49.8038 58.2378 50.8994 58.0311 51.8779 57.5418C52.8565 57.0525 53.6793 56.3001 54.2537 55.3689C54.8282 54.4378 55.1317 53.365 55.13 52.2709V15.9509C55.1247 13.3587 54.0926 10.8742 52.2597 9.04123C50.4267 7.20827 47.9422 6.17618 45.35 6.1709Z"></path> </g></svg>
                        <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                        <img src="${film.url_affiche}" alt="" class="w-48 z-10 border border-zinc-400 rounded">
                        </a>
                        <div class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-50 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                            <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                                <p class="text-white font-semibold text-lg text-center">${film.titre}</p>
                                <svg @click.stop="miniMenu = true" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                            </div> 
                        </div>
                        <div @mouseleave="miniMenu = false" :class="miniMenu ? 'opacity-100' : 'opacity-0 pointer-events-none'" class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-60 backdrop-blur bg-opacity-0 z-30 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                            <svg @click.stop="miniMenu = false" class="absolute top-1 right-3 rotate-90 fill-zinc-300 hover:fill-white" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z"></path> </g></svg>
                            <ul class="h-full w-full flex flex-col justify-center items-center gap-2">
                                <li class="text-white w-[8.5rem] text-center py-1 px-2 bg-zinc-600 hover:bg-zinc-500 bg-opacity-40 rounded transition-all ease-in-out duration-300" :class="miniMenu ? 'translate-x-0 opacity-100' : 'opacity-0 translate-x-[120%]'">Mettre en favori</li>
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
</script>

@endsection