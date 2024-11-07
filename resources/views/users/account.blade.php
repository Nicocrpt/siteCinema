@extends('layouts.layoutUser')
@section('title' , 'Mon compte')

@section('content')


    
    <div style="height: 100%; width: 100%" x-data="userPage()" x-init="init()" class="relative">

        {{-- Bouton toggle menu latéral --}}

        <a @click="sideMenu = !sideMenu" class="md:hidden text-xl text-white w-fit px-4 ml-4 rounded-l-xl transition-all ease-in-out duration-500 cursor-pointer absolute top-16 p-3 z-40 border-b" :class="sideMenu ? 'right-64 rounded-xl bg-zinc-50 hover:bg-white border-zinc-200' : 'right-0 bg-zinc-900  border-zinc-500 dark:border-zinc-950' ">
            <svg :class="!sideMenu ? '' : 'fill-black rotate-180'" class="transition-all ease-in-out duration-500" fill="#ffffff" width="22" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12 C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084 c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864 l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path> </g> </g> </g></svg>
        </a>


        {{-- Menu Latéral --}}

        <div x-show="sideMenu" style="height: 100vh" class="fixed w-full md:left-0 right-0 max-w-80 bg-zinc-900 py-6 md:pt-24 pt-20 flex flex-col gap-10 shadow-lg shadow-black z-20 margin-0"
            x-transition:enter="transition transform ease-in-out duration-500" 
            x-transition:enter-start="translate-x-[100%]" 
            x-transition:enter-end="translate-x-0" 
            x-transition:leave="transition transform ease-in-out duration-500" 
            x-transition:leave-start="translate-x-0" 
            x-transition:leave-end="translate-x-[100%]">
                <div class="flex justify-end">
                    
                </div>
            
                <div>
                    <h1 class="text-white text-2xl font-semibold mb-10 mx-6 text-end md:text-start">Bonjour</h1>
                    <ul class=" text-white w-full">
                        <li><a href="#infoPerso" class="sideMenu" @click="if (window.innerWidth < 768) sideMenu = false" >Informations personnelles</a></li>
                        <li><a href="#avantages" class="sideMenu"  @click="if (window.innerWidth < 768) sideMenu = false">Avantages</a></li>
                        <li><a href="#reservations" class="sideMenu" @click="if (window.innerWidth < 768) sideMenu = false">Reservations</a></li>
                        <li><a href="#supprimer-compte" class="sideMenu" @click="if (window.innerWidth < 768) sideMenu = false"> supprimer mon compte</a></li>
                        <li><a href="" class="sideMenu disconnect">Me deconnecter</a></li>
                    </ul>
                </div> 
        </div>
        

        {{-- Contenu de la page --}}

        <div class=" overflow-hidden overflow-y-auto h-[100vh] w-auto transition-all ease-in-out duration-500 z-10 md:ml-80 relative scroll-smooth"
        :class="sideMenu ? 'md:ml-80' : ' ml-0 md:ml-0'">

            {{-- Pastille de statut/MAJ --}}

            <div x-show="formsStatus" x-transition:enter="transition transform ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-[-200%]" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition transform ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-[-200%]" class="fixed w-full md:pl-80 top-16 z-40 flex justify-center items-center left-0">
                <div class="flex justify-center w-fit items-center gap-2 bg-green-600 text-white p-2 px-4 rounded-lg shadow-md">
                    <svg viewBox="0 0 24 24" width="24px" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    <p id="responseValue" class=""></p>
                    
                </div>               
            </div>

            <div id="infoPerso"  class=" xl:mx-auto px-2 md:px-4 lg:px-8 w-full max-w-[1000px] pt-32">




                


                {{-- Informations Personnelles --}}

                @include('users.partials.infosPerso')


                {{-- Avantages --}}

                <div class="mb-12 md:mb-24" id="avantages"></div>
                @include('users.partials.avantages')


                {{-- Reservations --}}

                <div class="mb-12 md:mb-24" id="reservations"></div>
                @include('users.partials.reservations')


                {{-- Supprimer le compte --}}

                <div class="mb-12 md:mb-24" id="supprimer-compte"></div>
                @include('users.partials.compteSuppression')


                
            </div>    

        </div>       


             
    </div>

@endsection