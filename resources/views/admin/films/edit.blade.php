@extends('layouts.layoutAdmin')
@section('title' , 'Admin Panel')

@section('content')

<form method="POST" action="{{route('admin.films.update', $film->id)}}" id="updateForm">
    @csrf
    @method('PUT')
    
    <div class="h-12 w-full border-b-2 border-zinc-150 dark:border-zinc-700 shadow-xs p-4 px-6 lg:px-8 bg-zinc-100 dark:bg-zinc-900 flex items-center relative z-20" x-data="{alert: false}">
        <div class="flex w-full items-center justify-between">
            <div class="flex gap-4 items-center">
                <a href="{{route('admin.films.manage')}}">
                    <svg width="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="fill-black dark:fill-white dark:hover:bg-zinc-700 rounded"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M0 0h48v48H0z" fill="none"></path> <g id="Shopicon"> <path d="M10,22v2c0,7.72,6.28,14,14,14s14-6.28,14-14s-6.28-14-14-14h-6.662l3.474-4.298l-3.11-2.515L10.577,12l7.125,8.813 l3.11-2.515L17.338,14H24c5.514,0,10,4.486,10,10s-4.486,10-10,10s-10-4.486-10-10v-2H10z"></path> </g> </g></svg>
                </a>
                <h1 class="font-semibold dark:text-white text-lg">{{$film->titre}}</h1>
            </div>
            <h1 class="font-semibold dark:text-white text-md">Id TMDB : {{$film->tmdb_id}}</h1>
        </div>
        <button type="submit" class="ml-6 w-[12.5rem] bg-green-600 hover:bg-green-700 rounded py-[0.10rem] text-white border border-green-800">
            Mettre à jour le film
        </button>
        <button @click="alert = true;" type="button" class="ml-6 w-[11rem] {{$booked ? 'bg-zinc-300 border-zinc-400 cursor-not-allowed' : 'bg-red-600 hover:bg-red-700 border-red-800'}}  rounded py-[0.10rem] text-white border ">
            Supprimer le film
        </button>

        <div x-show="alert" class="absolute flex justify-center items-center w-screen h-screen z-40 bg-black bg-opacity-40 backdrop-blur-[1px] top-0 left-0" x-transition:enter="transition-all ease-in-out duration 300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div @click.away="alert = false" class="w-[28rem] bg-white dark:bg-zinc-100 border border-zinc-400 p-4 rounded flex flex-col items-center justify-center gap-4">
                <div class="flex gap-4">
                    <div class="h-full flex items-center justify-center p-1 bg-zinc-900 rounded my-auto">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="white" stroke-width="2"></path> <path d="M12 8L12 13" stroke="white" stroke-width="2" stroke-linecap="round"></path> <path d="M12 16V15.9888" stroke="white" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                    </div>
                    <p>Etes vous sur de vouloir supprimer <span class="font-semibold">{{$film->titre}}</span> ?</p>
                </div>
                <div class="flex gap-2">
                    <form action="{{route('admin.films.destroy')}}" method="POST">  
                        @csrf
                        @method('DELETE')
                        <input type="text" class="hidden" name="idFilm" value="{{$film->id}}">  
                        <button type="submit" class="bg-red-500 border border-red-700 px-2 rounded text-lg text-white hover:bg-red-600 transition-all ease-linear duration-150">Oui</button>
                    </form>
                    <button class="bg-zinc-300 border border-zinc-500 px-2 rounded text-lg hover:bg-zinc-200 transition-all ease-linear duration-150" @click="alert = false">Non</button>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute top-0 left-0 w-full flex justify-center items-center z-10 transition-all ease-in-out duration-300 pointer-events-none" id="notifBox">
        <div class="flex justify-center w-fit items-center gap-2 bg-green-600 text-white p-1 px-2 rounded shadow-md">
            <svg viewBox="0 0 24 24" width="24px" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <p id="responseValue" class="">Film mis à jour avec succès</p>     
        </div>               
    </div>


    <div class="h-full w-full">
        
        <div class="overflow-y-auto pt-16 h-full w-full  p-10 pb-48 flex flex-col gap-14" x-data="{posterChange : false, preview : false, videoUrl : document.getElementById('trailer').value }">
            <section class="md:max-w-[900px] mx-auto flex flex-col gap-14">
                
                <div class="flex gap-6" >
                    <div class="hidden md:flex-col gap-1 md:flex" x-data="{translation : 0, images: [...document.querySelectorAll('.imgPoster')].map(img => img.src)}">
                        <label for="poster" class="text-zinc-800 dark:text-white font-semibold">Poster</label>
                        <div class="w-56 relative flex overflow-hidden rounded group border-zinc-400 dark:border-zinc-500 border" >
                            <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex">
                                @foreach ($tmdb_posters as $poster )
                                    @if ($poster['iso_639_1'] == 'fr')
                                        <img src="https://image.tmdb.org/t/p/w500{{$poster['file_path']}}" alt="" class="imgPoster">
                                    @endif   
                                @endforeach
                            </div>
                           
                            <button type="button"class="absolute left-2 bottom-1/2 bg-white p-2 rounded-full bg-opacity-80 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-300" @click="translation -= 100 ; console.log(translation)" :class="translation <=0 ? 'hidden' : 'block'">
                                <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                            </button>
                            <button type="button"class="absolute right-2 bottom-1/2 bg-white p-2 rounded-full bg-opacity-80 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-300" @click="translation = translation + 100 ; console.log(translation)" :class="translation >= document.querySelectorAll('.imgPoster').length*100 - 100 ? 'hidden' : 'block'">
                                <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                            </button>
                        </div>   
                        <input type="text" name="poster_path" id="urlPoster" :value="images[translation/100].replace('w500', 'original')" class="hidden">
                    </div>
                
                    <div class="w-full">
                        <div class="flex flex-col gap-1 w-full mb-[2.15rem]">
                            <label for="title" class="text-zinc-800 dark:text-white font-semibold">Titre</label>
                            <input type="text" name="title" value="{{$film->titre}}" class=" rounded dark:bg-zinc-500 border border-zinc-400 dark:text-white" >
                        </div>

                        <div class="flex flex-col gap-1 w-full mb-6">
                            <label for="directors" class="text-zinc-800 dark:text-white font-semibold">Réalisateur(s)</label>
                            <div class="w-full min-h-[42px] rounded bg-white border border-zinc-400 dark:bg-zinc-500 p-[0.35rem] pl-[0.4rem] flex flex-wrap gap-1">
                                @foreach ($film->realisateurs as $realisateur)
                                    <div class="rounded bg-zinc-200 dark:bg-[rgb(67,65,65)] flex justify-center items-center border dark:border-zinc-400 border-zinc-300 pl-1 pr-[0.4rem] gap-1 h-[29px]">
                                        <svg onclick="this.parentElement.remove()" width="16" class="hover:fill-black fill-zinc-500 dark:fill-zinc-400 dark:hover:fill-white cursor-pointer transition-all ease-in-out duration-150" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_732_" d="M70.7,64.3c1.8,1.8,1.8,4.6,0,6.4c-0.9,0.9-2,1.3-3.2,1.3c-1.2,0-2.3-0.4-3.2-1.3L46,52.4L27.7,70.7 c-0.9,0.9-2,1.3-3.2,1.3s-2.3-0.4-3.2-1.3c-1.8-1.8-1.8-4.6,0-6.4L39.6,46L21.3,27.7c-1.8-1.8-1.8-4.6,0-6.4c1.8-1.8,4.6-1.8,6.4,0 L46,39.6l18.3-18.3c1.8-1.8,4.6-1.8,6.4,0c1.8,1.8,1.8,4.6,0,6.4L52.4,46L70.7,64.3z"></path> </g></svg>
                                        <p class="dark:text-white text-sm directorName">{{$realisateur->nom}}</p>
                                    </div>
                                @endforeach
                                <input x-data id="inputComposer" type="text" class="h-[29px] rounded w-[4.6rem] min-w-[4.6rem] dark:bg-zinc-400 bg-zinc-100 border dark:border-zinc-400 border-zinc-200 hover:border-zinc-300 dark:text-white dark:placeholder-zinc-100 text-sm p-[0.35rem] cursor-pointer focus:cursor-text transition-all ease-in-out duration-100" @input="$el.style.width = ($el.value.length * 0.85 + 0.9) + 'ch'" placeholder="+ Ajouter" @focus="$el.placeholder=''" @blur="appendEl($el)" @keydown.enter="$el.blur()">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 w-full mb-6">
                            <label for="directors" class="text-zinc-800 dark:text-white font-semibold">Acteur(s)</label>
                            <div class="w-full min-h-[42px] rounded bg-white border border-zinc-400 dark:bg-zinc-500 p-[0.35rem] pl-[0.4rem] flex flex-wrap gap-1">
                                @foreach ($film->acteurs as $acteur)
                                    <div class="rounded bg-zinc-200 dark:bg-[rgb(67,65,65)] flex justify-center items-center border dark:border-zinc-400 border-zinc-300 pl-1 pr-[0.4rem] gap-1 h-[29px]">
                                    <svg onclick="this.parentElement.remove()" width="16" class="hover:fill-black fill-zinc-500 dark:fill-zinc-400 dark:hover:fill-white cursor-pointer transition-all ease-in-out duration-150" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_732_" d="M70.7,64.3c1.8,1.8,1.8,4.6,0,6.4c-0.9,0.9-2,1.3-3.2,1.3c-1.2,0-2.3-0.4-3.2-1.3L46,52.4L27.7,70.7 c-0.9,0.9-2,1.3-3.2,1.3s-2.3-0.4-3.2-1.3c-1.8-1.8-1.8-4.6,0-6.4L39.6,46L21.3,27.7c-1.8-1.8-1.8-4.6,0-6.4c1.8-1.8,4.6-1.8,6.4,0 L46,39.6l18.3-18.3c1.8-1.8,4.6-1.8,6.4,0c1.8,1.8,1.8,4.6,0,6.4L52.4,46L70.7,64.3z"></path> </g></svg>
                                        <p class="dark:text-white text-sm cursor-default actorName">{{$acteur->nom}}</p>
                                    </div>
                                @endforeach
                                <input x-data id="inputComposer" type="text" class="h-[29px] rounded w-[4.6rem] min-w-[4.6rem] dark:bg-zinc-400 bg-zinc-100 border dark:border-zinc-400 border-zinc-200 hover:border-zinc-300 dark:text-white dark:placeholder-zinc-100 text-sm p-[0.35rem] cursor-pointer focus:cursor-text transition-all ease-in-out duration-100" @input="$el.style.width = ($el.value.length * 0.85 + 0.9) + 'ch'" placeholder="+ Ajouter" @focus="$el.placeholder=''" @blur="appendEl($el)" @keydown.enter="$el.blur()">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 w-full">
                            <label for="directors" class="text-zinc-800 dark:text-white font-semibold">Compositeur(s)</label>
                            <div class="w-full min-h-[42px] rounded bg-white border border-zinc-400 dark:bg-zinc-500 p-[0.35rem] pl-[0.4rem] flex flex-wrap gap-1">
                                @foreach ($film->compositeurs as $compositeur)
                                    <div class="rounded bg-zinc-200 dark:bg-[rgb(67,65,65)] flex justify-center items-center border dark:border-zinc-400 border-zinc-300 pl-1 pr-[0.4rem] gap-1 h-[29px]">
                                        <svg onclick="this.parentElement.remove()" width="16" class="hover:fill-black fill-zinc-500 dark:fill-zinc-400 dark:hover:fill-white cursor-pointer transition-all ease-in-out duration-150" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_732_" d="M70.7,64.3c1.8,1.8,1.8,4.6,0,6.4c-0.9,0.9-2,1.3-3.2,1.3c-1.2,0-2.3-0.4-3.2-1.3L46,52.4L27.7,70.7 c-0.9,0.9-2,1.3-3.2,1.3s-2.3-0.4-3.2-1.3c-1.8-1.8-1.8-4.6,0-6.4L39.6,46L21.3,27.7c-1.8-1.8-1.8-4.6,0-6.4c1.8-1.8,4.6-1.8,6.4,0 L46,39.6l18.3-18.3c1.8-1.8,4.6-1.8,6.4,0c1.8,1.8,1.8,4.6,0,6.4L52.4,46L70.7,64.3z"></path> </g></svg>
                                        <p class="dark:text-white text-sm composerName">{{$compositeur->nom}}</p>
                                    </div>
                                @endforeach
                                <input x-data id="inputComposer" type="text" class="h-[29px] rounded w-[4.6rem] min-w-[4.6rem] dark:bg-zinc-400 bg-zinc-100 border dark:border-zinc-400 border-zinc-200 hover:border-zinc-300 dark:text-white dark:placeholder-zinc-100 text-sm p-[0.35rem] cursor-pointer focus:cursor-text transition-all ease-in-out duration-100" @input="$el.style.width = ($el.value.length * 0.85 + 0.9) + 'ch'" placeholder="+ Ajouter" @focus="$el.placeholder=''" @blur="appendEl($el)" @keydown.enter="$el.blur()">
                            </div>
                        </div>
                        
                                
                    </div>
                </div>
            
                <div class="flex flex-col gap-1 w-full">
                    <label for="synopsis" class="text-zinc-800 dark:text-white font-semibold">Synopsis</label>
                    <textarea name="synopsis" id="" cols="60" rows="10" class="rounded h-[15.65rem] pointer-events-none dark:bg-zinc-500 border border-zinc-400 dark:text-white">{{$film->synopsis}}</textarea>
                </div>
                    
            
                <div class="flex flex-col gap-1 w-full">
                    <label for="synopsis" class="text-zinc-800 dark:text-white font-semibold">Avis de Solaris (facultatif)</label>
                    <textarea name="avisSolaris" id="" cols="60" rows="5" class="rounded w-full h-[10rem] min-h-[10rem] max-h-[10rem] dark:bg-zinc-500 border border-zinc-400 dark:text-white"></textarea>
                </div>  


                <section class="flex gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="backdrop_path" class="text-zinc-800 dark:text-white font-semibold">Couverture</label>
                        <div class="relative w-full border-zinc-400 dark:border-zinc-500 border rounded overflow-hidden group" x-data="{translation : 0, covers: [...document.querySelectorAll('.imgcover')].map(img => img.src)}">
                            <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex bg-inherit">
                                @foreach ($tmdb_backdrops as $backdrop )
                   
                                    <img src="https://image.tmdb.org/t/p/w780{{$backdrop}}" alt="" class="imgcover w-full">     
                
                                @endforeach
                            </div>
                    
                            <button type="button"class="absolute left-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-300" @click="translation -= 100 ; console.log(translation)" :class="translation <=0 ? 'hidden' : 'block'">
                                <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                            </button>
                            <button type="button"class="absolute right-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-300" @click="translation = translation + 100 ; console.log(translation)" :class="translation >= document.querySelectorAll('.imgcover').length*100 - 100 ? 'hidden' : 'block'">
                                <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                            </button>
                            <input type="text" name="backdrop_path" id="urlPoster" :value="covers[translation/100].replace('w780', 'original')" class="hidden">
                        </div>
                        
                    </div>
        
                    <div class="flex flex-col gap-2">
                        <label for="logo" class="text-zinc-800 dark:text-white font-semibold">Logo</label>
                        <div class="relative w-[18rem] h-[330px] border-zinc-400 dark:border-zinc-500 bg-zinc-300 dark:bg-zinc-500 border rounded overflow-hidden group" x-data="{translation : 0, logos: [...document.querySelectorAll('.imgLogo')].map(img => img.src)}">
                            <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="h-full flex items-center">
                                @foreach ($tmdb_logos as $logo )
                   
                                    <img src="https://image.tmdb.org/t/p/w500{{$logo}}" alt="" class="imgLogo p-4 rounded w-full h-auto">     
                
                                @endforeach
                            </div>
                    
                            <button type="button"class="absolute left-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-300" @click="translation -= 100 ; console.log(translation)" :class="translation <=0 ? 'hidden' : 'block'">
                                <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                            </button>
                            <button type="button"class="absolute right-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-300" @click="translation = translation + 100 ; console.log(translation)" :class="translation >= document.querySelectorAll('.imgLogo').length*100 - 100 ? 'hidden' : 'block'">
                                <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                            </button>
                            <input type="text" name="logo_path" id="urlLogo" :value="logos[translation/100].replace('w500', 'original')" class="hidden">
                        </div>
                        
                    </div>
                </section>  
                
                <div class="flex flex-col gap-2">
                    <label for="isFavorite" class="text-zinc-800 dark:text-white font-semibold">Le film sera-t-il en tête d'affiche ?</label>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="isFavorite" id="isFavorite" value="1">
                        <label for="isFavorite" class="text-zinc-800 dark:text-white">Oui</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="isFavorite" id="isNotFavorite" value="0" checked>
                        <label for="isNotFavorite" class="text-zinc-800 dark:text-white">Non</label>
                    </div> 
                </div>

                <div class="flex flex-col gap-2">
                    <label for="certification" class="text-zinc-800 dark:text-white font-semibold">Certification à appliquer :</label>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="certification" id="toutPublic" value="Touts publics" {{$film->certification_id == 3 ? 'checked' : ''}}>
                        <label for="toutPublic" class="text-zinc-800 dark:text-white">Tout public</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="certification" id="-12" value="12" {{$film->certification_id == 1 ? 'checked' : ''}}>
                        <label for="-10" class="text-zinc-800 dark:text-white">interdit aux moins de 12 ans</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="certification" id="-16" value="16" {{$film->certification_id == 2 ? 'checked' : ''}}>
                        <label for="-16" class="text-zinc-800 dark:text-white">interdit aux moins de 16 ans</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" name="certification" id="-18" value="18" {{$film->certification_id == 4 ? 'checked' : ''}}>
                        <label for="-18" class="text-zinc-800 dark:text-white">interdit aux moins de 18 ans</label>
                    </div>
                </div>

            
                <div class="flex-col gap-2 flex">
                    <label for="trailer" class="text-zinc-800 dark:text-white font-semibold">Trailer</label>
                    <div class="flex gap-2 items-center">
                            <input type="text" name="trailer" id="trailer" value="{{$film->url_trailer}}" class="rounded w-full dark:bg-zinc-500 dark:text-white border border-zinc-400"/>

                            
                        <button type="button"@click="videoUrl = document.getElementById('trailer').value" class="py-2 px-4 bg-zinc-700 text-white rounded">Prévisualiser</button>
                    </div>
                    <iframe :src="videoUrl + '?modestbranding=1&controls=20&showinfo=0&rel=0'" frameborder="0" allowfullscreen class="aspect-[16/9] rounded w-full" ></iframe>
                </div>
            
                <div class="flex-col gap-2 flex" x-data="{imgSelector: false}">
                    <label for="images" class="text-zinc-800 dark:text-white font-semibold">Images</label>
                    <div class="border border-zinc-400 rounded items-start h-auto bg-white dark:bg-zinc-500 flex flex-wrap p-2 gap-2 min-w-[8rem] w-auto" id="imgReciever">
                            @foreach (explode(',', $film->images) as $image)
                                <div class="relative w-[13.4rem] img-{{$tmdb_backdrops->search(str_replace('https://image.tmdb.org/t/p/original', '', $image))}}" id="img-{{$tmdb_backdrops->search(str_replace('https://image.tmdb.org/t/p/original', '', $image))}}">
                                    <img src="{{$image}}" class="border border-zinc-400 w-[13.4rem] rounded"/>
                                    <button type="button"@click="$el.parentElement.remove(); removeSelectedImage({{$tmdb_backdrops->search(str_replace('https://image.tmdb.org/t/p/original', '', $image))}})" class="absolute top-1 right-1 bg-white bg-opacity-70 rounded-full">
                                        <svg viewBox="0 0 24 24" width="24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="#0F0F0F"></path> </g></svg>
                                    </button>
                                </div>
                            @endforeach
                    </div>
                    <div x-show="imgSelector" class="fixed h-screen w-screen top-0 left-0 p-8 overflow-hidden flex justify-center items-center bg-black bg-opacity-70 pt-24 backdrop-blur z-40">
                            
                        <div class="w-[1018px] h-full my-auto flex flex-col border-zinc-600 border rounded">
                            <div class="w-full h-16 bg-zinc-300 dark:bg-zinc-800 rounded-t shadow-sm z-20 border-b dark:border-zinc-600 border-zinc-400 flex justify-between px-4 items-center">
                                <p class="text-lg font-semibold dark:text-white"><span id="counter">{{count(explode(',', $film->images))}}</span>/8</p>
                                <button type="button"@click="imgSelector = false" class="bg-zinc-700 rounded-md h-fit p-2">
                                    <svg width="18" class="fill-white" viewBox="0 0 15 15" version="1.1" id="cross" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2.64,1.27L7.5,6.13l4.84-4.84C12.5114,1.1076,12.7497,1.0029,13,1c0.5523,0,1,0.4477,1,1
                                    c0.0047,0.2478-0.093,0.4866-0.27,0.66L8.84,7.5l4.89,4.89c0.1648,0.1612,0.2615,0.3796,0.27,0.61c0,0.5523-0.4477,1-1,1
                                    c-0.2577,0.0107-0.508-0.0873-0.69-0.27L7.5,8.87l-4.85,4.85C2.4793,13.8963,2.2453,13.9971,2,14c-0.5523,0-1-0.4477-1-1
                                    c-0.0047-0.2478,0.093-0.4866,0.27-0.66L6.16,7.5L1.27,2.61C1.1052,2.4488,1.0085,2.2304,1,2c0-0.5523,0.4477-1,1-1
                                    C2.2404,1.0029,2.4701,1.0998,2.64,1.27z"></path> </g></svg>
                                </button>
                            </div>
                            <div class="overflow-y-auto flex flex-wrap justify-evenly w-full h-full bg-zinc-200 dark:bg-zinc-700 rounded-b gap-4 p-5">
                                @foreach ($tmdb_backdrops as $image)
                                    <div class="relative">
                                        <img @click="onImageClick(Array.from(displayList).indexOf($el))" src="https://image.tmdb.org/t/p/original{{$image}}" alt="" class="w-[30rem] rounded imgDisplay cursor-pointer {{in_array("https://image.tmdb.org/t/p/original".$image,explode(',', $film->images))  ? 'outline outline-4 outline-green-600' : 'border border-zinc-400'}}">
                                        <input {{in_array("https://image.tmdb.org/t/p/original".$image,explode(',', $film->images))  ? 'checked' : ''}} type="checkbox"  class="absolute top-2 right-2 accent-green-600 w-6 h-6 imgCheckbox rounded-full opacity-0 pointer-events-none">
                                    </div>    
                                @endforeach
                            </div>
                        </div>                
                    </div>
                    <div class="w-full h-full flex justify-start items-center">
                        <button type="button"class="border border-zinc-500 py-1 px-2 rounded bg-zinc-100 dark:bg-zinc-600 dark:text-white hover:bg-zinc-200 dark:hover:bg-zinc-500 text-zinc-600" @click="imgSelector = true">Séléctionner/ajouter une image</button>
                    </div>
                    <input type="text" value="{{$film->images}}" id="imagesString" name="images_string" class="w-[1000px] hidden">
                </div>
            </section>       
        </div>
    </div>
</form>
<script>

    film = @json($film)

    let container = document.getElementById('imgReciever')
    let imagesString = document.getElementById('imagesString')
    const imagesList = document.querySelectorAll('.imgCheckbox')
    const displayList = document.querySelectorAll('.imgDisplay')
    const counter = document.getElementById('counter')
    const max = 8
    const updateForm = document.getElementById('updateForm')


    imagesList.forEach(checkbox => {
        checkbox.classList.add(`cb-${Array.from(imagesList).indexOf(checkbox)}`)
        checkbox.addEventListener('change', function(){
            console.log(this.checked)
            let img = this.previousElementSibling
            if (this.checked){
                if (parseInt(counter.innerHTML) >= max) {
                    this.checked = false
                } else {
                    img.classList.remove('border', 'border-zinc-400')
                    img.classList.add('outline',  'outline-4', 'outline-green-600')
                    counter.innerHTML = parseInt(counter.innerHTML) + 1
                    if(counter.innerHTML == "1") {
                        container.innerHTML = ""
                    }
                    container.innerHTML += `
                    <div class="relative w-[13.4rem] img-${Array.from(imagesList).indexOf(checkbox)}">
                        <img src="${img.src}" class="border border-zinc-400 w-[13.4rem] rounded"/>
                        <button type="button"@click="removeSelectedImage(${Array.from(imagesList).indexOf(checkbox)}); $el.parentElement.remove();" class="absolute top-1 right-1 bg-white bg-opacity-70 rounded-full">
                            <svg viewBox="0 0 24 24" width="24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="#0F0F0F"></path> </g></svg>
                        </button>
                    </div>`

                    if (imagesString.value == ""){
                        imagesString.value = img.src.replace("w500", "original")
                    } else {
                        imagesString.value += ',' + img.src.replace("w500", "original")
                    }
                }
            } else {
                console.log(img)
                img.classList.remove('outline', 'outline-4', 'outline-green-600')
                img.classList.add('border', 'border-zinc-400')
                counter.innerHTML = parseInt(counter.innerHTML) - 1
                let imgToRemove = document.querySelector(`.img-${Array.from(imagesList).indexOf(checkbox)}`)
                if (imagesString.value.split(',').length == 1 ) {
                    imagesString.value = ""
                } else {
                    imagesString.value = imagesString.value.replace(img.src.replace("w500", "original"), "")
                    imagesString.value = imagesString.value.replace(/^,|,$/g, "");
                }
                if (imgToRemove != null) {
                    console.log(imgToRemove)
                    container.removeChild(imgToRemove)
                }
                if (counter.innerHTML == "0") {
                    container.innerHTML = `<div class="w-full flex justify-center items-center h-[7.6rem]">
                        <p class="text-zinc-300 italic">Aucune image selectionnée</p>
                    </div>`
                }
            }
        })
    })

    function removeSelectedImage(integer){
        console.log(document.querySelector(`.cb-${integer}`))
        document.querySelector(`.cb-${integer}`).checked = false
        document.querySelector(`.cb-${integer}`).dispatchEvent(new Event('change', { bubbles: true }));
    }

    function onImageClick(integer) {
        let checkbox = document.querySelector(`.cb-${integer}`)
        checkbox.checked = !document.querySelector(`.cb-${integer}`).checked
        checkbox.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function updateMovie(form) {
        let url = "{{ route('admin.films.update', ':id') }}"
        url = url.replace(':id', film.id)
        console.log(url)
        console.log(document.querySelector('[name="backdrop_path"]').value)

        const realisateurs = document.querySelectorAll('.directorName')
        let realString = ''
        realisateurs.forEach(real => {
            if (real == realisateurs[realisateurs.length - 1]) {
                realString += `${real.innerText}`
            } else {
                realString += `${real.innerText}, `
            }
        })

        const acteurs = document.querySelectorAll('.actorName')
        console.log(acteurs)
        let actorString = ''
        acteurs.forEach(actor => {
            console.log(actor)
            if (actor == acteurs[acteurs.length - 1]) {
                actorString += `${actor.innerText}`
            } else {
                actorString += `${actor.innerText}, `
            }
        })

        const compositeurs = document.querySelectorAll('.composerName')
        let composerString = ''
        compositeurs.forEach(composer => {
            if (composer == compositeurs[compositeurs.length - 1]) {
                composerString += `${composer.innerText}`
            } else {
                composerString += `${composer.innerText}, `
            }
        })

        console.log(realString)
        console.log(composerString)
        console.log(actorString)

        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value 
            },
            body: JSON.stringify({
                'titre': document.querySelector('[name="title"]').value,
                'realisateurs': realString,
                'acteurs': actorString,
                'compositeurs': composerString,
                'synopsis': document.querySelector('[name="synopsis"]').value,
                'backdrop_path': document.querySelector('[name="backdrop_path"]').value,
                'logo_path': document.querySelector('[name="logo_path"]').value,
                'poster_path': document.querySelector('[name="poster_path"]').value,
                'trailer_path': document.querySelector('[name="trailer"]').value,
                'is_favorite' : document.querySelector('[name="isFavorite"]').value,
                'certification': document.querySelector('[name="certification"]').value,
                'images_string': imagesString.value
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP ! statut : ${response.status}`);
            }
            return response.json(); // Traiter la réponse comme JSON
        })
        .then(data => {
            document.getElementById('responseValue').innerHTML = data.message
            document.getElementById('notifBox').classList.add('translate-y-[170%]')
            setTimeout(() => {
                document.getElementById('notifBox').classList.remove('translate-y-[170%]')
            }, 3000);

        })

    }

    function appendEl(input) {
        if (input.value != '') {
            const url = "{{route('admin.films.getPerson')}}" + `?query=${encodeURI(input.value)}`
            fetch(url, {
                method: 'get',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value 
                }
            }).then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP ! statut : ${response.status}`);
                }
                return response.json(); // Traiter la réponse comme JSON
            }).then(data => {
                let parent = input.parentElement
                const already = parent.querySelectorAll('div')
                exist = false
                already.forEach(element => {
                    if (element.children[1].innerText == data.name.trim()) {
                        exist = true
                    }            
                });

                if (!exist) {
                    const el = document.createElement('div')
                    el.className = 'rounded bg-zinc-200 dark:bg-[rgb(67,65,65)] flex justify-center items-center border dark:border-zinc-400 border-zinc-300 pl-1 pr-[0.4rem] gap-1 h-[29px]'

                    el.innerHTML = `
                        <svg onclick="this.parentElement.remove()" width="16" class="hover:fill-black fill-zinc-500 dark:fill-zinc-400 dark:hover:fill-white cursor-pointer transition-all ease-in-out duration-150" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_732_" d="M70.7,64.3c1.8,1.8,1.8,4.6,0,6.4c-0.9,0.9-2,1.3-3.2,1.3c-1.2,0-2.3-0.4-3.2-1.3L46,52.4L27.7,70.7 c-0.9,0.9-2,1.3-3.2,1.3s-2.3-0.4-3.2-1.3c-1.8-1.8-1.8-4.6,0-6.4L39.6,46L21.3,27.7c-1.8-1.8-1.8-4.6,0-6.4c1.8-1.8,4.6-1.8,6.4,0 L46,39.6l18.3-18.3c1.8-1.8,4.6-1.8,6.4,0c1.8,1.8,1.8,4.6,0,6.4L52.4,46L70.7,64.3z"></path> </g></svg>
                        <p class="dark:text-white text-sm">${data.name}</p>
                    `
                    parent.insertBefore(el, input)
                }       
            })


            

            
        }
        input.style.width = 0
        input.classList.add('w-[4.6rem]')
        input.value = ''
        input.placeholder = '+ Ajouter'    
    }

    updateForm.addEventListener('submit', (e) => {
        e.preventDefault()
        updateMovie(updateForm)
    })
</script>

@endsection