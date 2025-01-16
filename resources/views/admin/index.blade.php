@extends('layouts.layoutAdmin')
@section('title' , 'Admin Panel')

@section('content')
<div class="h-16 w-full border-b-2 border-gray-150 dark:border-gray-700 shadow-xs p-4 px-6">
    <ul class="flex gap-4">
        <li>Vue d'ensemble</li>
        <li>Ajouter un film</li>
        <li>Modifier un film</li>
    </ul>
</div>

<div class="overflow-y-auto max-h-full p-10 pb-48">
    <section class="w-[800px] mx-auto">
        <form class="w-full flex justify-center items-center gap-2" id="queryFilmsForm">
            @csrf
            <input type="text" name="query" id="query" class="rounded-md w-72">
            <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 transition-all ease-in-out duration-200 rounded-md py-2 px-4">Rechercher</button>
        </form>
        <div class="min-h-72 w-full mt-16 mx-auto">
            <table class="border-collapse w-full max-h-[400px]" border="1">
                <thead>
                    <tr>
                        <th class="border-1 border black text-left p-2">titre</th>
                        <th class="border-1 border black text-left p-2">Réalisateur</th>
                        <th class="border-1 border black text-left p-2">Date de sortie</th>
                        <th class="border-1 border black text-center p-2">Action</th>
                    </tr>
                </thead>
                <tbody id="filmsTable" class="overflow-y-auto max-h-full">      
                </tbody>
            </table>
        </div>
    </section>
</div>

<script defer>
    const searchForm = document.getElementById('queryFilmsForm')
    let query = document.getElementById('query')

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
            films.forEach(film => {
                let filmCreationURI = `{{route('admin.films.create', ':id')}}`
                filmCreationURI = filmCreationURI.replace(':id', film.id)
                const row = document.createElement('tr')
                row.innerHTML = `
                    <td class="border-1 border black text-left p-2"><img src="https://image.tmdb.org/t/p/w500${film.poster_path}" alt="" class="h-24"/></td>
                    <td class="border-1 border black text-left p-2">${film.title}</td>
                    <td class="border-1 border black text-left p-2">${film.release_date}</td>
                    <td class="border-1 border black text-center p-2">
                        <a class="bg-cyan-500 hover:bg-cyan-400 transition-all ease-in-out duration-200 rounded-md py-1 px-2 cursor-pointer" href="${filmCreationURI}">Sélectionner</a>
                    </td>
                `
                filmsTable.appendChild(row)
            })

        })

    })
</script>
@endsection