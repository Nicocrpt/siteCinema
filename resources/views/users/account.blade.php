@extends('layouts.layoutUser')
@section('title' , 'Mon compte')

@section('content')


    
    <div style="height: 100%; width: 100%" x-data="{sideMenu : true}" class="relative">

        <a @click="sideMenu = true" class="text-xl text-white p-3 px-4 rounded-r-xl bg-zinc-900 bg-opacity-90 hover:bg-opacity-100 transition-all ease-in-out duration-300 absolute md:top-24 top-16 left-0 cursor-pointer shadow-lg z-10"
        x-show="!sideMenu"
        x-transition:enter="transition transform ease-in-out duration-[1s]" 
        x-transition:enter-start="translate-x-[-100%]" 
        x-transition:enter-end="translate-x-0" 
        x-transition:leave="transition transform ease-in-out duration-[1s]" 
        x-transition:leave-start="translate-x-0" 
        x-transition:leave-end="translate-x-[-100%]">
            <svg fill="#ffffff" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>icn/menu</title><path d="M2 3h12a1 1 0 0 1 0 2H2a1 1 0 1 1 0-2zm0 4h12a1 1 0 0 1 0 2H2a1 1 0 1 1 0-2zm0 4h12a1 1 0 0 1 0 2H2a1 1 0 0 1 0-2z" id="a"></path></g></svg>
        </a>

        <div x-show="sideMenu" style="height: 100vh" class="absolute w-full max-w-80 bg-zinc-900 py-6 md:pt-24 pt-16 flex flex-col gap-10 shadow-lg shadow-black z-20 margin-0"
            x-transition:enter="transition transform ease-in-out duration-500" 
            x-transition:enter-start="translate-x-[-100%]" 
            x-transition:enter-end="translate-x-0" 
            x-transition:leave="transition transform ease-in-out duration-500" 
            x-transition:leave-start="translate-x-0" 
            x-transition:leave-end="translate-x-[-100%]">
                <div class="flex justify-end">
                    <a @click="sideMenu = false" class="text-xl text-white w-fit p-2 px-3 mr-4 rounded-xl bg-cyan-700 hover:bg-cyan-600 transition-all ease-in-out duration-300 cursor-pointer">
                        <svg fill="#ffffff" width="22" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12 C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084 c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864 l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path> </g> </g> </g></svg>
                    </a>
                </div>
            
                <div>
                    <h1 class="text-white text-2xl font-semibold mb-10 ml-6">Bonjour {{ Auth::user()->prenom }}</h1>
                    <ul class=" text-white w-full">
                        <li><a href="#infoPerso" class="sideMenu" @click="if (window.innerWidth < 768) sideMenu = false" >Informations personnelles</a></li>
                        <li><a href="#reservations" class="sideMenu"  @click="if (window.innerWidth < 768) sideMenu = false">Reservations</a></li>
                        <li><a href="" class="sideMenu">Favoris</a></li>
                        <li><a href="" class="sideMenu">Mes reservations</a></li>
                        <li><a href="" class="sideMenu disconnect">Me deconnecter</a></li>
                    </ul>
                </div> 
        </div>
        
            {{-- Side Menu --}}
            

        <div class=" overflow-hidden overflow-y-auto h-[100vh] transition-all ease-in-out duration-500 z-10 "
        :class="sideMenu ? 'md:ml-80' : 'ml-0'">
            <div id="infoPerso"  class="relative md:pl-24 px-4  w-full">
                @if (session('success'))
                    <div class="flex justify-center absolute top-4" 
                        x-data="{show : true}"
                        x-init="setTimeout(() => show = false, 3000)" 
                        x-show="show"
                        x-transition:leave="transition ease-in-out duration-500"
                        x-transition:leave-start="opacity-100" 
                        x-transition:leave-end="opacity-0">
                        <p class="py-1 px-2 bg-green-500 border-2 border-green-700 rounded text-white shadow-lg">{{session('success')}}</p>
                    </div>
                @elseif (session('error'))
                    <div class="flex justify-center absolute top-4">
                        <p class="py-1 px-2 bg-red-500 rounded text-white shadow-sm">{{session('error')}}</p>
                    </div>
                @endif
                <form action="{{route('users.update', $user->id)}}" method="POST" x-data="{active_form : false}" class="mt-32">
                    @csrf
                    @method('PUT')
                    <div class="flex gap-4 w-full">
                        <div class="w-8">
                            <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="fill-zinc-800 dark:fill-zinc-100"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" width="24"></g><g id="SVGRepo_iconCarrier"> <path d="M0 0h48v48H0z" fill="none"></path> <g id="Shopicon"> <path d="M8.706,37.027c2.363-0.585,4.798-1.243,6.545-1.243c0.683,0,1.261,0.101,1.688,0.345c1.474,0.845,2.318,4.268,3.245,7.502 C21.421,43.866,22.694,44,24,44c1.306,0,2.579-0.134,3.816-0.368c0.926-3.234,1.771-6.657,3.244-7.501 c0.427-0.245,1.005-0.345,1.688-0.345c1.747,0,4.183,0.658,6.545,1.243c1.605-1.848,2.865-3.99,3.706-6.333 c-2.344-2.406-4.872-4.891-4.872-6.694c0-1.804,2.528-4.288,4.872-6.694c-0.841-2.343-2.101-4.485-3.706-6.333 c-2.363,0.585-4.798,1.243-6.545,1.243c-0.683,0-1.261-0.101-1.688-0.345c-1.474-0.845-2.318-4.268-3.245-7.502 C26.579,4.134,25.306,4,24,4c-1.306,0-2.579,0.134-3.816,0.368c-0.926,3.234-1.771,6.657-3.245,7.501 c-0.427,0.245-1.005,0.345-1.688,0.345c-1.747,0-4.183-0.658-6.545-1.243C7.101,12.821,5.841,14.962,5,17.306 C7.344,19.712,9.872,22.196,9.872,24c0,1.804-2.527,4.288-4.872,6.694C5.841,33.037,7.101,35.179,8.706,37.027z M18,24 c0-3.314,2.686-6,6-6s6,2.686,6,6s-2.686,6-6,6S18,27.314,18,24z"></path> </g> </g></svg>
                        </div>
                        <h1 class="text-3xl font-semibold dark:text-white">Informations Personnelles</h1>
                        <button @click="active_form = !active_form" type="button" class="w-8 group">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="File / Note_Edit"> <path id="Vector" d="M10.0002 4H7.2002C6.08009 4 5.51962 4 5.0918 4.21799C4.71547 4.40973 4.40973 4.71547 4.21799 5.0918C4 5.51962 4 6.08009 4 7.2002V16.8002C4 17.9203 4 18.4801 4.21799 18.9079C4.40973 19.2842 4.71547 19.5905 5.0918 19.7822C5.5192 20 6.07899 20 7.19691 20H16.8031C17.921 20 18.48 20 18.9074 19.7822C19.2837 19.5905 19.5905 19.2839 19.7822 18.9076C20 18.4802 20 17.921 20 16.8031V14M16 5L10 11V14H13L19 8M16 5L19 2L22 5L19 8M16 5L19 8" class="stroke-zinc-400 group-hover:stroke-zinc-700 dark:group-hover:stroke-zinc-100 transition-all ease-in-out duration-300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                        </button>
                    </div>
                    
                    <div style="max-width: 700px">
                        <div class="flex gap-4 mt-10 w-full">
                            <div class="w-full">
                                <x-input-label for="Nom" :value="__('Nom')" />
                                @error('Nom')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                                <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Nom" id="Nom" value="{{ $user->nom }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                            </div>
                            <div class="w-full">
                                <x-input-label for="Prenom" :value="__('Prenom')" />
                                <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Prenom" id="Prenom" value="{{ $user->prenom }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                            </div>
                        </div>
                        <div class="mt-5">
                            <x-input-label for="Email" :value="__('Email')" />
                            <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="email" name="Mail" id="Mail" value="{{ $user->email }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                        </div>
                        <div class="mt-5">
                            <x-input-label for="Telephone" :value="__('Téléphone')" />
                            <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Telephone" id="Telephone" value="{{ $user->telephone }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                        </div>
                        <div class="mt-5">
                            <x-input-label for="Adresse" :value="__('Adresse')" />
                            <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Adresse" id="Adresse" value="{{ $user->adresse ? $user->adresse : null }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                        </div>
                        <div class="flex gap-4 mt-10">
                            <div class="w-full">
                                <x-input-label for="CodePostal" :value="__('Code postal')" />
                                <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="CodePostal" id="CodePostal" value="{{ $user->code_postal ? $user->code_postal : null }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                            </div>
                            <div class="w-full">
                                <x-input-label for="Ville" :value="__('Ville')" />
                                <input class="border-gray-300 dark:border-zinc-500 dark:bg-zinc-600  focus:border-zinc-500 dark:focus:border-zinc-600 focus:ring-zinc-500 dark:focus:ring-zinc-600 rounded-md shadow-sm mt-1 w-full block" type="text" name="Ville" id="Ville" value="{{ $user->ville ? $user->ville : null }}" :disabled="!active_form" :class="active_form ? 'text-black dark:text-white' : 'text-zinc-500 dark:text-zinc-300'">
                            </div>
                        </div>
                        <button type="submit" class="text-md text-white w-fit p-2 px-3 mr-4 rounded-md bg-cyan-600 hover:bg-cyan-500 transition-all ease-in-out duration-300 cursor-pointer mt-6 shadow-sm" 
                        x-show="active_form"
                        x-transition:enter="transition transform ease-in-out duration-500"
                        x-transition:enter-start="transform opacity-0"
                        x-transition:enter-end="transform opacity-100"
                        x-transition:leave="transition transform ease-in-out duration-500"
                        x-transition:leave-start="transform opacity-100"
                        x-transition:leave-end="transform opacity-0"
                        >Mettre à jour</button>
                    </div>  
                </form>
                <div class="h-24"></div>

                <div class="flex gap-4 w-full mb-10 pt-24" id="reservations">
                    <div class="w-8">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="fill-zinc-800 dark:fill-zinc-100"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" width="24"></g><g id="SVGRepo_iconCarrier"><path d="M0 0h48v48H0z" fill="none"></path> <g id="Shopicon"> <path d="M8.706,37.027c2.363-0.585,4.798-1.243,6.545-1.243c0.683,0,1.261,0.101,1.688,0.345c1.474,0.845,2.318,4.268,3.245,7.502 C21.421,43.866,22.694,44,24,44c1.306,0,2.579-0.134,3.816-0.368c0.926-3.234,1.771-6.657,3.244-7.501 c0.427-0.245,1.005-0.345,1.688-0.345c1.747,0,4.183,0.658,6.545,1.243c1.605-1.848,2.865-3.99,3.706-6.333 c-2.344-2.406-4.872-4.891-4.872-6.694c0-1.804,2.528-4.288,4.872-6.694c-0.841-2.343-2.101-4.485-3.706-6.333 c-2.363,0.585-4.798,1.243-6.545,1.243c-0.683,0-1.261-0.101-1.688-0.345c-1.474-0.845-2.318-4.268-3.245-7.502 C26.579,4.134,25.306,4,24,4c-1.306,0-2.579,0.134-3.816,0.368c-0.926,3.234-1.771,6.657-3.245,7.501 c-0.427,0.245-1.005,0.345-1.688,0.345c-1.747,0-4.183-0.658-6.545-1.243C7.101,12.821,5.841,14.962,5,17.306 C7.344,19.712,9.872,22.196,9.872,24c0,1.804-2.527,4.288-4.872,6.694C5.841,33.037,7.101,35.179,8.706,37.027z M18,24 c0-3.314,2.686-6,6-6s6,2.686,6,6s-2.686,6-6,6S18,27.314,18,24z"></path> </g> </g></svg>
                    </div>
                    <h1 class="text-3xl font-semibold dark:text-white">Réservations</h1>
                </div>  
                @foreach ($user->reservations as $reservation)
                    <div class="grid grid-cols-4 p-2 border border-zinc-400 shadow-md bg-zinc-600 hover:bg-zinc-500 rounded-lg mb-5 transition-all ease-in-out duration-300" style="max-width: 1000px">
                        <img class="col-span-1 rounded-md w-full" src="{{$reservation->seance->film->url_affiche}}" alt="">
                        <div class="col-span-3 pl-5">
                            <h1 class="text-xl font-semibold dark:text-white">{{$reservation->seance->film->titre}}</h1>
                            <p class="dark:text-white" >{{$reservation->seance->datetime_seance}}</p>
                            <p class="dark:text-white">référence : {{$reservation->reference}}</p>
                        </div>
                    </div>
                @endforeach
            </div>    
        </div>       

            {{-- Main Content --}}
             
    </div>
@endsection