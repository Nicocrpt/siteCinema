@extends('layouts.layoutAdmin')
@section('title' , 'Ajouter un film')

@section('content')
<form action="{{route('admin.films.store')}}" method="POST" class="w-full h-full">
    <input type="text" name="tmdb_id" value="{{$movie['id']}}" class="hidden">
    @csrf

    {{-- Header --}}
    <div class="h-12 w-full border-b-2 border-zinc-150 dark:border-zinc-700 shadow-xs p-4 px-6 lg:px-8 bg-zinc-100 dark:bg-zinc-900 flex  items-center">
        <div class="flex w-full items-center justify-between">
            <div class="flex gap-4 items-center">
                <a href="{{route('admin.films.searchPage')}}">
                    <svg width="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="fill-black dark:fill-white"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M0 0h48v48H0z" fill="none"></path> <g id="Shopicon"> <path d="M10,22v2c0,7.72,6.28,14,14,14s14-6.28,14-14s-6.28-14-14-14h-6.662l3.474-4.298l-3.11-2.515L10.577,12l7.125,8.813 l3.11-2.515L17.338,14H24c5.514,0,10,4.486,10,10s-4.486,10-10,10s-10-4.486-10-10v-2H10z"></path> </g> </g></svg>
                </a>
                <h1 class="font-semibold dark:text-white text-lg">{{$movie['title']}}</h1>
            </div>
            <h1 class="font-semibold dark:text-white text-md">Id TMDB : {{$movie['id']}}</h1>
        </div>
        <button type="submit" class="ml-6 w-32 bg-green-600 hover:bg-green-700 rounded py-[0.10rem] text-white border border-green-800">
            Ajouter le film
        </button>
    </div>
    
    {{-- Form --}}
    <div class="overflow-y-auto h-full w-full  p-10 pb-48 flex flex-col gap-14" x-data="{posterChange : false, preview : false, videoUrl : document.getElementById('trailer').value }">
        <section class="max-w-[900px] mx-auto flex flex-col gap-14">
            <div class="flex gap-6" >
                <div class="hidden md:flex-col gap-1 md:flex" x-data="{translation : 0, images: [...document.querySelectorAll('.imgPoster')].map(img => img.src)}">
                    <label for="poster" class="text-zinc-800 dark:text-white font-semibold">Poster</label>
                    <div class="w-56 relative flex overflow-hidden rounded group border-zinc-400 dark:border-zinc-500 border" >
                        <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex">
                            @foreach ($movie['images']['posters'] as $poster )
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
                    <div class="flex flex-col gap-1 w-full mb-4">
                        <label for="title" class="text-zinc-800 dark:text-white font-semibold">Titre</label>
                        <input type="text" name="title" value="{{$movie['title']}}" class=" rounded pointer-events-none dark:bg-zinc-500 border border-zinc-400 dark:text-white" >
                    </div>
                    
                    <div class="flex flex-col gap-1 w-full">
                        <label for="synopsis" class="text-zinc-800 dark:text-white font-semibold">Synopsis</label>
                        <textarea name="synopsis" id="" cols="60" rows="10" class="rounded h-[15.65rem] pointer-events-none dark:bg-zinc-500 border border-zinc-400 dark:text-white">{{$movie['overview']}}</textarea>
                    </div>
                         
                </div>
            </div>
        
              
        
            <div class="flex flex-col gap-1 w-full">
                <label for="synopsis" class="text-zinc-800 dark:text-white font-semibold">Avis de Solaris (facultatif)</label>
                <textarea name="avisSolaris" id="" cols="60" rows="5" class="rounded w-full h-[10rem] min-h-[10rem] max-h-[10rem] dark:bg-zinc-500 border border-zinc-400 dark:text-white"></textarea>
            </div>  
    
    
            <section class="flex gap-6">
                <div class="flex flex-col gap-2">
                    <label for="logo" class="text-zinc-800 dark:text-white font-semibold">Couverture</label>
                    <div class="relative w-full border-zinc-400 dark:border-zinc-500 border rounded overflow-hidden group" x-data="{translation : 0, covers: [...document.querySelectorAll('.imgcover')].map(img => img.src)}">
                        <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex bg-inherit">
                            @foreach ($movie['images']['backdrops'] as $backdrop )
               
                                <img src="https://image.tmdb.org/t/p/w780{{$backdrop['file_path']}}" alt="" class="imgcover w-full">     
            
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
                    <div class="relative w-[18rem] h-full border-zinc-400 dark:border-zinc-500 bg-zinc-300 dark:bg-zinc-500 border rounded overflow-hidden group" x-data="{translation : 0, logos: [...document.querySelectorAll('.imgLogo')].map(img => img.src)}">
                        <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="h-full flex items-center">
                            @foreach ($movie['images']['logos'] as $logo )
               
                                <img src="https://image.tmdb.org/t/p/w500{{$logo['file_path']}}" alt="" class="imgLogo p-4 rounded w-full h-auto">     
            
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
                    <input type="radio" name="certification" id="toutPublic" value="0">
                    <label for="toutPublic" class="text-zinc-800 dark:text-white">Tout public</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="radio" name="certification" id="-12" value="0">
                    <label for="-10" class="text-zinc-800 dark:text-white">interdit aux moins de 12 ans</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="radio" name="certification" id="-16" value="0">
                    <label for="-16" class="text-zinc-800 dark:text-white">interdit aux moins de 16 ans</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="radio" name="certification" id="-18" value="0">
                    <label for="-18" class="text-zinc-800 dark:text-white">interdit aux moins de 18 ans</label>
                </div>
            </div>

        
            <div class="flex-col gap-2 flex">
                <label for="trailer" class="text-zinc-800 dark:text-white font-semibold">Trailer</label>
                <div class="flex gap-2 items-center">
                    @if (count($movie['videos']['results']) > 0)
                        <input type="text" name="trailer" id="trailer" value="http://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key']}}" class="rounded w-full dark:bg-zinc-500 dark:text-white border border-zinc-400"/>
                    @else
                        <input type="text" name="trailer" id="trailer" placeholder="Insérez un url de vidéo" class="rounded w-full dark:bg-zinc-500 border border-zinc-400"/>
                    @endif
                        
                    <button type="button"@click="preview = true; videoUrl = document.getElementById('trailer').value" class="py-2 px-4 bg-zinc-700 text-white rounded">Prévisualiser</button>
                </div>
                <iframe x-show="preview == true" :src="videoUrl + '?modestbranding=1&controls=20&showinfo=0&rel=0'" frameborder="0" allowfullscreen class="aspect-[16/9] rounded w-full" ></iframe>
            </div>
        
            <div class="flex-col gap-2 flex" x-data="{imgSelector: false}">
                <label for="images" class="text-zinc-800 dark:text-white font-semibold">Images</label>
                <div class="border border-zinc-400 rounded items-start h-auto bg-white dark:bg-zinc-500 flex flex-wrap p-2 gap-2 min-w-[8rem] w-auto" id="imgReciever">
                        <div class="w-full flex justify-center items-center h-[7.6rem]">
                            <p class="text-zinc-300 dark:text-zinc-400 italic">Aucune image selectionnée</p>
                        </div>
                </div>
                <div x-show="imgSelector" class="fixed h-screen w-screen top-0 left-0 p-8 overflow-hidden flex justify-center items-center bg-black bg-opacity-70 pt-24 backdrop-blur z-40">
                        
                    <div class="w-[1018px] h-full my-auto flex flex-col border-zinc-600 border rounded">
                        <div class="w-full h-16 bg-zinc-300 dark:bg-zinc-800 rounded-t shadow-sm z-20 border-b dark:border-zinc-600 border-zinc-400 flex justify-between px-4 items-center">
                            <p class="text-lg font-semibold dark:text-white"><span id="counter">0</span>/8</p>
                            <button type="button"@click="imgSelector = false" class="bg-zinc-700 rounded-md h-fit p-2">
                                <svg width="18" class="fill-white" viewBox="0 0 15 15" version="1.1" id="cross" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2.64,1.27L7.5,6.13l4.84-4.84C12.5114,1.1076,12.7497,1.0029,13,1c0.5523,0,1,0.4477,1,1
                                c0.0047,0.2478-0.093,0.4866-0.27,0.66L8.84,7.5l4.89,4.89c0.1648,0.1612,0.2615,0.3796,0.27,0.61c0,0.5523-0.4477,1-1,1
                                c-0.2577,0.0107-0.508-0.0873-0.69-0.27L7.5,8.87l-4.85,4.85C2.4793,13.8963,2.2453,13.9971,2,14c-0.5523,0-1-0.4477-1-1
                                c-0.0047-0.2478,0.093-0.4866,0.27-0.66L6.16,7.5L1.27,2.61C1.1052,2.4488,1.0085,2.2304,1,2c0-0.5523,0.4477-1,1-1
                                C2.2404,1.0029,2.4701,1.0998,2.64,1.27z"></path> </g></svg>
                            </button>
                        </div>
                        <div class="overflow-y-auto flex flex-wrap justify-evenly w-full h-full bg-zinc-200 dark:bg-zinc-700 rounded-b gap-4 p-5">
                            @foreach ($movie['images']['backdrops'] as $image)
                                <div class="relative">
                                    <img @click="onImageClick(Array.from(displayList).indexOf($el))" src="https://image.tmdb.org/t/p/w500{{$image['file_path']}}" alt="" class="w-[30rem] border border-zinc-400 rounded imgDisplay cursor-pointer">
                                    <input type="checkbox"  class="absolute top-2 right-2 accent-green-600 w-6 h-6 imgCheckbox rounded-full opacity-0 pointer-events-none">
                                </div>    
                            @endforeach
                        </div>
                    </div>                
                </div>
                <div class="w-full h-full flex justify-start items-center">
                    <button type="button"class="border border-zinc-500 py-1 px-2 rounded bg-zinc-100 dark:bg-zinc-600 dark:text-white hover:bg-zinc-200 dark:hover:bg-zinc-500 text-zinc-600" @click="imgSelector = true">Séléctionner/ajouter une image</button>
                </div>
                <input type="text"  id="imagesString" name="images_string" class="w-[1000px] hidden">
            </div>
        </section>       
    </div>
</form>


<script defer>
    let container = document.getElementById('imgReciever')
    let imagesString = document.getElementById('imagesString')
    const imagesList = document.querySelectorAll('.imgCheckbox')
    const displayList = document.querySelectorAll('.imgDisplay')
    const counter = document.getElementById('counter')
    const max = 8

    imagesList.forEach(checkbox => {
        checkbox.classList.add(`cb-${Array.from(imagesList).indexOf(checkbox)}`)
        checkbox.addEventListener('change', function(){
            const img = this.previousElementSibling
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
                        <button type="button"@click="$el.parentElement.remove(); removeSelectedImage(${Array.from(imagesList).indexOf(checkbox)})" class="absolute top-1 right-1 bg-white bg-opacity-70 rounded-full">
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
                img.classList.remove('outline', 'outline-4', 'outline-green-600')
                img.classList.add('border', 'border-zinc-400')
                counter.innerHTML = parseInt(counter.innerHTML) - 1
                imgToRemove = document.querySelector(`.img-${Array.from(imagesList).indexOf(checkbox)}`)
                if (imgToRemove != null) {
                    console.log(imgToRemove)
                    container.removeChild(imgToRemove)
                }
                if (counter.innerHTML == "0") {
                    container.innerHTML = `<div class="w-full flex justify-center items-center h-[7.6rem]">
                        <p class="text-zinc-300 italic">Aucune image selectionnée</p>
                    </div>`
                }
                
                if (imagesString.value.split(',').length == 1 ) {
                    imagesString.value = ""
                } else {
                    imagesString.value = imagesString.value.replace(/^,|,$/g, "");


                }
            }
        })
    })

    function removeSelectedImage(integer){
        document.querySelector(`.cb-${integer}`).checked = false
        document.querySelector(`.cb-${integer}`).dispatchEvent(new Event('change', { bubbles: true }));
    }

    function onImageClick(integer) {
        checkbox = document.querySelector(`.cb-${integer}`)
        checkbox.checked = !document.querySelector(`.cb-${integer}`).checked
        checkbox.dispatchEvent(new Event('change', { bubbles: true }));
    }
</script>

@endsection