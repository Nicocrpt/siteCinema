@extends('layouts.layoutAdmin')
@section('title' , 'Films - Ajouter un film')

@section('content')

<x-admin.admin-film-heading/>

<div class="max-h-full px-4 overflow-y-auto pb-[5rem]">
    <section class="lg:w-[63.125rem] 2xl:w-[88.25rem] mx-auto h-full mt-6">
        <form class="w-full flex justify-start items-center gap-2" id="queryFilmsForm">
            @csrf
            <input type="text" name="query" id="query" class="rounded w-72 bg-white dark:bg-zinc-600 dark:focus:bg-zinc-500 border border-zinc-500 dark:text-white dark:placeholder:text-zinc-300" placeholder="Rechercher un film">
            <button type="submit" class="w-[10.25rem] border border-zinc-600 bg-zinc-900 hover:bg-cyan-600 text-white  transition-all ease-in-out duration-200 rounded py-2 px-4">Rechercher</button>
        </form>

        <div class="w-full h-full mt-4 rounded overflow-hidden flex flex-col">
            <div class="w-full flex h-8 bg-neutral-300 dark:bg-zinc-900 overflow-hidden border border-zinc-400 dark:border-zinc-500 rounded-t shadow">
                <div class="w-[4.5rem] 2xl:w-[7.425rem]  flex justify-center items-center" >
                    <p class="px-auto font-semibold dark:text-white">Affiche</p>
                </div>
                <div class="w-[36.625rem] 2xl:w-[50rem] flex justify-center items-center">
                    <p class="px-auto font-semibold dark:text-white">Titre</p>
                </div>
                <div class="w-[12rem] 2xl:[16.8rem] flex justify-center items-center">
                    <p class="px-auto font-semibold dark:text-white">Date de sortie</p>
                </div>
                <div class="w-[10rem] 2xl:w-[14rem] flex justify-center items-center">
                    <p class="px-auto font-semibold dark:text-white">Action</p>
                </div>
            </div>
            <div class="overflow-y-auto  max-h-[calc(100vh-18rem)]  border-b border-x border-zinc-400 dark:border-zinc-500 rounded-b">
                <div class="rounded-b overflow-hidden flex flex-col" id="filmsTable">
                    <div class="w-full h-56 flex justify-center items-center bg-zinc-100 dark:bg-zinc-600">
                        <p class="italic text-zinc-500 dark:text-zinc-300">Aucun film trouvé</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-xs italic text-zinc-500 dark:text-zinc-400 pt-[0.5rem]">propulsé par <span class="font-semibold text-zinc-600 dark:text-zinc-300">T</span>he<span class="font-semibold text-zinc-600 dark:text-zinc-300">M</span>ovie<span class="font-semibold text-zinc-600 dark:text-zinc-300">D</span>ata<span class="font-semibold text-zinc-600 dark:text-zinc-300">B</span>ase</p>
    </section>
</div>

<script defer>
    const searchForm = document.getElementById('queryFilmsForm')
    let query = document.getElementById('query')
    const films_ids = @json($films_ids)

    searchForm.addEventListener('submit', (e) => {
        e.preventDefault()

        const url = "{{ route('admin.films.searchFilms')}}" + '?query=' + encodeURIComponent(query.value)

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
            console.log(films)
            const filmsTable = document.getElementById('filmsTable')
            filmsTable.innerHTML = ''
            let count = 0
            if (films.length == 0) {
                filmsTable.innerHTML = `
                    <div class="w-full h-56 flex justify-center items-center bg-zinc-100">
                            <p class="italic text-zinc-500">Aucun film trouvé</p>
                    </div>
                `
            }
            films.forEach(film => {
                let filmCreationURI = `{{route('admin.films.create', ':id')}}`
                filmCreationURI = filmCreationURI.replace(':id', film.id)
                const row = document.createElement('div')
                const rowColor = count % 2 == 0 ? 'bg-zinc-100' : 'bg-zinc-200'
                const rowColorDark = count % 2 == 0 ? 'dark:bg-zinc-600' : 'dark:bg-zinc-700'
                row.classList.add('w-full', 'flex', 'overflow-hidden', rowColor, rowColorDark, 'min-h-16', 'border-b', 'border-zinc-300', 'dark:border-zinc-500', 'hover:bg-sky-100', 'dark:hover:bg-zinc-500', 'hover:cursor-pointer')
                row.innerHTML = `
                    <div class="w-[4.5rem] 2xl:w-[7.425rem] flex justify-center items-center">
                        <img src="https://image.tmdb.org/t/p/w500${film.poster_path}" alt="" class="w-full"/>
                    </div>
                    <div class="w-[36.625rem] 2xl:w-[50rem]  flex justify-center items-center">
                        <p class="dark:text-white">${film.title}</p>
                    </div>
                    <div class="w-[12rem] 2xl:[16.8rem]  flex justify-center items-center">
                        <p class="dark:text-white">${film.release_date}</p>
                    </div>


                `
                if (films_ids.includes(film.id)) {
                    let filmEditURI = `{{route('admin.films.edit', ':id')}}`
                    filmEditURI = filmEditURI.replace(':id', film.id)
                    row.innerHTML += `
                    <div class="w-[10rem] 2xl:w-[14rem] flex justify-center items-center">
                        <a href="${filmEditURI}" class="border border-zinc-500 bg-zinc-800 hover:bg-yellow-500 text-white transition-all ease-in-out duration-200 rounded py-2 px-4">Modifier</a>
                    </div>`
                } else {
                    row.innerHTML += `
                    <div class="w-[10rem] 2xl:w-[14rem] flex justify-center items-center">
                        <a class="border border-zinc-500 bg-zinc-800 hover:bg-green-600 transition-all ease-in-out duration-200 rounded py-2 px-4 cursor-pointer text-white" href="${filmCreationURI}">Détails</a>
                    </div>`
                }
                filmsTable.appendChild(row)
                count++
            })

        })

    })
</script>
@endsection