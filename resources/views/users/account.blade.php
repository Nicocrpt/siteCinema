@extends('layouts.layoutUser')
@section('title' , 'Mon compte')

@section('content')


    
    <div style="height: 100%; width: 100%" x-data="userPage()" class="relative">

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
                    <h1 class="text-white text-2xl font-semibold mb-10 ml-6">Bonjour</h1>
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
            

        <div class=" overflow-hidden overflow-y-auto h-[100vh] w-auto transition-all ease-in-out duration-500 z-10 md:ml-80"
        :class="sideMenu ? 'md:ml-80' : 'ml-0 md:ml-0'">

            <x-confirmation-modal :content="'annuler cette réservation ?'" :action="'disableReservation'" />

            <div x-show="formsStatus" x-transition:enter="transition transform ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-[-100%]" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition transform ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-[-200%]" class=" absolute top-16 w-full flex justify-around items-center z-40">
                <div class="flex justify-center items-center gap-2 bg-green-600 text-white p-2 px-4 w-fit rounded-lg shadow-md">
                    <svg viewBox="0 0 24 24" width="24px" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    <p id="responseValue" class=""></p>
                    
                </div>
                
            </div>

            <div id="infoPerso"  class="relative md:pl-24 px-4  w-full">


                <form action="{{route('users.update', $user->id)}}" method="POST" class="mt-32 max-w-[700px]">
                    @csrf
                    @method('PUT')
                    <div class="flex gap-4 w-full justify-between items-center">

                        <div class="flex flex-col gap-1">
                            <h1 class="text-3xl font-semibold dark:text-white">Informations Personnelles</h1>
                            <p class="text-md dark:text-gray-100 text-zinc-400">Consultez ou mettez à jour vos informations</p>
                        </div>
                        
                        <button @click="active_form = !active_form" type="button" class="dark:text-neutral-300 hover:text-sky-600">
                            Modifier
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
                        <div class="h-20 flex justify-end items-center">
                            <button type="submit" @click="onUpdateUserInfoClick($event)" class="text-md text-white w-fit p-2 px-3  rounded-md bg-cyan-600 hover:bg-cyan-500 transition-all ease-in-out duration-300 cursor-pointer mt-6 shadow-sm" 
                            x-show="active_form"
                            x-transition:enter="transition transform ease-in-out duration-500"
                            x-transition:enter-start="transform opacity-0"
                            x-transition:enter-end="transform opacity-100"
                            x-transition:leave="transition transform ease-in-out duration-500"
                            x-transition:leave-start="transform opacity-100"
                            x-transition:leave-end="transform opacity-0"
                            >Mettre à jour</button>
                        </div>
                        
                    </div>  
                </form>


                <div class="flex flex-col gap-1 w-full mb-10 pt-24" id="reservations">
                    
                    <h1 class="text-3xl font-semibold dark:text-white">Réservations</h1>
                    <p class="text-md dark:text-gray-100 text-zinc-400">Consultez, modifiez ou annulez vos réservations</p>
                </div>  

                @foreach ($user->reservations as $reservation)
                    {{-- <div class="reservationDisplay relative grid grid-cols-4 p-2 border border-zinc-400 shadow-md bg-zinc-600 hover:bg-zinc-500 rounded-lg mb-5 transition-all ease-in-out duration-300" style="max-width: 1000px">
                        <form action="{{route('reservations.destroy', $reservation)}}" method="POST" class="absolute top-0 right-0 p-2" data-url="{{ route('reservations.destroy', $reservation) }}">
                            @csrf
                            @method('DELETE')
                            <button @click="onDeleteReservationClick($event)" id="deleteReservation" class="px-4 py-2 bg-red-500 rounded-md hover:bg-red-600">X</button>
                        </form>
                        <img class="col-span-1 rounded-md w-full" src="{{$reservation->seance->film->url_affiche}}" alt="">
                        <div class="col-span-3 pl-5">
                            <h1 class="text-xl font-semibold dark:text-white">{{$reservation->seance->film->titre}}</h1>
                            <p class="dark:text-white" >{{$reservation->seance->datetime_seance}}</p>
                            <p class="dark:text-white">référence : {{$reservation->reference}}</p>
                            <div class="mt-4 flex flex-col w-full gap-2">
                                @foreach ($reservation->reservationlignes as $reservationLigne)
                                    <form action="{{route('reservationlignes.destroy', $reservationLigne->id)}}" method="POST" class="flex justify-start items-center gap-2">
                                        @csrf
                                        @method('DELETE')
                                        <p>{{$reservationLigne->place->rangee.$reservationLigne->place->numero}}</p>
                                        <button @click="onDeleteLineClick($event)" class="px-2 py-1 h-full bg-red-500 rounded-md hover:bg-red-600">X</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                    @if ($reservation->is_active)
                        <x-reservation-card :reservation="$reservation" :status="null" />
                    @else
                        <x-reservation-card :reservation="$reservation" :status="'grayscale'" />
                    @endif
                @endforeach
            </div>    
        </div>       

            {{-- Main Content --}}
             
    </div>

@endsection