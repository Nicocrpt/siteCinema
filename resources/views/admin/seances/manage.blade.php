@extends('layouts.layoutAdmin')
@section('title' , 'Séances - Gérer les séances')

@section('content')
<style>

    

</style>
<x-admin.admin-seance-heading/>
<div class="h-full w-full flex flex-col gap-14" x-data="seanceManager()" x-init="init()" id="seanceManager">
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

        <div class="h-full bg-zinc-100 dark:bg-zinc-700 border-l-2 border-zinc-200 dark:border-zinc-600 min-w-[380px] w-[30%] flex">
            <div class="h-full w-full p-4 shrink-0">
                    <select name="filter" id="filmFilter" class="w-full dark:bg-zinc-800 rounded border border-zinc-500 dark:text-white h-[2.2rem] p-0 px-2 mb-[0.95rem]" @change="queryMovies()">
                        <option value="all">Tous les films</option>
                        <option value="published">Déja à l'affiche</option>
                        <option value="unpublished">Non publiés</option>
                        <option value="upcoming">Prochainement</option>
                        <option value="archived">Archivé</option>
                    </select>
                    <input @input="queryMovies()" type="text" name="query" id="filmQuery" class="rounded w-full dark:bg-zinc-500 border-zinc-400 dark:text-white dark:placeholder:text-zinc-300" placeholder="Rechercher un film"/>
                    <div class="flex w-full justify-end mt-[0.95rem]">
                        <label class="inline-flex items-center cursor-pointer">
                            <span class="mr-3 text-sm font-medium text-gray-900 dark:text-gray-300">VF</span>
                            <input type="checkbox" value="" id="language" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-yellow-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">VO</span>
                        </label>
                    </div> 
                <div class="overflow-y-auto h-[calc(100vh-18.5rem)] w-full flex flex-col mt-[0.95rem] border border-zinc-400 dark:border-zinc-500 rounded " id="filmsContainer">
                </div>
            </div>
            <div class="w-full h-full shrink-0 dark:bg-zinc-700 transition-all ease-in-out duration-[400ms]" id="filmDetails" :class="detailView ? '-translate-x-[100%]' : 'translate-x-0'">

            </div>
        </div>
    </section>
</div>

<script defer>
    const films = @json($films)


</script>

@endsection