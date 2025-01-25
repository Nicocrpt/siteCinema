@extends('layouts.layoutAdmin')
@section('title' , 'Séances - Vue d\'ensemble')

@section('content')
<x-admin.admin-seance-heading/>
<div class="overflow-y-auto max-w-[1200px] min-w-[800px] mx-auto mt-8 px-8">
    <div class="w-full flex gap-2 mb-2">
        <div class="h-72 w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500 hover:bg-zinc-200 transition-all ease-in-out duration-500">
            <p class="px-3 py-2 text-lg font-semibold dark:text-white">Statistiques séances</p>
            <p>{{$seances->count()}} Séances programmées</p>
        </div>
        <div class="h-72 w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500 hover:bg-zinc-200 transition-all ease-in-out duration-500">
            <p class="px-3 py-2 text-lg font-semibold dark:text-white">Blabla</p>
        </div>
    </div>
    <div class="h-72 w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500 hover:bg-zinc-200 transition-all ease-in-out duration-500">
        <p class="px-3 py-2 text-lg font-semibold dark:text-white">Blablabla</p>
    </div>
</div>
@endsection