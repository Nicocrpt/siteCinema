@extends('layouts.layoutAdmin')
@section('title' , 'Séances - Vue d\'ensemble')

@section('content')
<x-admin.admin-seance-heading/>
<div class="w-full h-screen">
    <div class="overflow-y-auto w-full h-full relative">
        <div class="max-w-[1200px] min-w-[800px] mx-auto mt-8 px-8 pb-48">
            <div class="w-full flex gap-2 mb-2">
                <div class="h-[20.1rem] w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500/70 hover:bg-zinc-200/50 transition-all ease-in-out duration-500 py-2 px-3">
                    <p class="text-lg font-semibold dark:text-white mb-2">Statistiques séances</p>
                    <p class="dark:text-white text-zinc-600">{{$seances->count()}} Séances programmées</p>
                    <div class="w-full flex justify-center gap-8 items-center mt-10">
                        <div class="h-[7rem] w-[7rem] rounded-full border-[6px] hover:bg-red-500 transition-all ease-in-out duration-500 border-red-500 flex justify-center items-center group">
                            <p class="text-2xl font-semibold group-hover:text-white dark:text-white transition-all ease-in-out duration-500">20%</p>
                        </div>
                        <div class="h-[7rem] w-[7rem] rounded-full border-[6px] hover:bg-green-500 transition-all ease-in-out duration-500 border-green-500 flex justify-center items-center group">
                            <p class="text-2xl font-semibold group-hover:text-white dark:text-white transition-all ease-in-out duration-500">33%</p>
                        </div>
                        <div class="h-[7rem] w-[7rem] rounded-full border-[6px] hover:bg-sky-500 transition-all ease-in-out duration-500 border-sky-500 flex justify-center items-center group">
                            <p class="text-2xl font-semibold group-hover:text-white dark:text-white transition-all ease-in-out duration-500">47%</p>
                        </div>
                    </div>
                </div>
                <div class="h-[20.1rem] w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500/70 hover:bg-zinc-200/50 transition-all ease-in-out duration-500 py-2 px-3">
                    <p class=" text-lg font-semibold dark:text-white">Horaires les plus populaires</p>
                </div>
            </div>
            <div class="h-[20.1rem] w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500/70 hover:bg-zinc-200/50 transition-all ease-in-out duration-500 py-2 px-3 mb-2">
                <p class=" text-lg font-semibold dark:text-white">Blablabla</p>
            </div>
            <div class="h-[20.1rem] w-full rounded bg-zinc-100 dark:bg-zinc-600 border border-zinc-200 dark:border-zinc-500 dark:hover:bg-zinc-500/70 hover:bg-zinc-200/50 transition-all ease-in-out duration-500 py-2 px-3">
                <p class=" text-lg font-semibold dark:text-white">Blablabla</p>
            </div>
        </div>
        <div class="!w-[100%] !p-0 !m-0 bg-zinc-950  shadow-none absolute -bottom-[14rem] left-0">
            <div class="w-full !h-2 rounded-b bg-zinc-50 dark:bg-zinc-800">
            </div>
            <div class="flex items-center justify-center h-8 w-full">
                <p class="text-zinc-300 text-[0.7rem]">Copyright © Nicolas Carpita 2025 - All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>


@endsection