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
            <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                <div class="relative group w-48 overflow-hidden rounded shadow-sm">
                    <img src="{{$film->url_affiche}}" alt="" class="w-48 z-10 border border-zinc-400 rounded">
                    <div class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-70 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                        <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                            <p class="text-white font-semibold text-lg text-center">{{$film->titre}}</p>
                            <svg class="absolute top-1 right-3 rotate-90" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z" fill="#ffffff"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z" fill="#ffffff"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z" fill="#ffffff"></path> </g></svg>
                        </div>  
                    </div>
                </div>
            </a>
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
                filmList.innerHTML += `
                    <a href="{{route('admin.films.edit', $film->id)}}" class="w-48">
                        <div class="relative group w-48 overflow-hidden rounded shadow-sm">
                            <img src="${film.url_affiche}" alt="" class="w-48 z-10 border border-zinc-400 rounded">
                            <div class="absolute top-0 left-0 h-full w-full bg-black group-hover:bg-opacity-70 bg-opacity-0 z-20 transition-all ease-in-out duration-300 rounded group cursor-pointer">
                                <div class="h-full w-full opacity-0 group-hover:opacity-100 transition-all linear duration-300 flex items-center justify-center relative">
                                    <p class="text-white font-semibold text-lg text-center">${film.titre}</p>
                                    <svg class="absolute top-1 right-3 rotate-90" width="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 12C9.10457 12 10 12.8954 10 14C10 15.1046 9.10457 16 8 16C6.89543 16 6 15.1046 6 14C6 12.8954 6.89543 12 8 12Z" fill="#ffffff"></path> <path d="M8 6C9.10457 6 10 6.89543 10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6Z" fill="#ffffff"></path> <path d="M10 2C10 0.89543 9.10457 -4.82823e-08 8 0C6.89543 4.82823e-08 6 0.895431 6 2C6 3.10457 6.89543 4 8 4C9.10457 4 10 3.10457 10 2Z" fill="#ffffff"></path> </g></svg>
                                </div>  
                            </div>
                        </div>
                    </a>`
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