@extends('layouts.layoutAdmin')
@section('title' , 'Ajouter un film')

@section('content')
<div class="h-16 w-full border-b-2 border-gray-150 dark:border-gray-700 shadow-xs p-4 px-6 lg:px-8 bg-gray-100 flex justify-between items-center">
    <div class="flex gap-4 items-center">
        <svg width="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M0 0h48v48H0z" fill="none"></path> <g id="Shopicon"> <path d="M10,22v2c0,7.72,6.28,14,14,14s14-6.28,14-14s-6.28-14-14-14h-6.662l3.474-4.298l-3.11-2.515L10.577,12l7.125,8.813 l3.11-2.515L17.338,14H24c5.514,0,10,4.486,10,10s-4.486,10-10,10s-10-4.486-10-10v-2H10z"></path> </g> </g></svg>
        <h1 class="font-semibold dark:text-white text-xl">{{$movie['title']}}</h1>
    </div>
    <h1 class="font-semibold dark:text-white text-large">Id TMDB : {{$movie['id']}}</h1>
</div>

<div class="overflow-y-auto max-h-full w-full  p-10 pb-48 flex flex-col gap-14" x-data="{posterChange : false, preview : false, videoUrl : document.getElementById('trailer').value }">
    <section class="max-w-[900px] mx-auto flex flex-col gap-14">
        <div class="flex gap-6" >
            <div class="hidden md:flex-col gap-2 md:flex" x-data="{translation : 0, images: [...document.querySelectorAll('.imgPoster')].map(img => img.src)}">
                <label for="poster" class="text-gray-800 font-semibold">Poster</label>
                <div class="w-56 relative flex overflow-hidden rounded" >
                    <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex">
                        @foreach ($movie['images']['posters'] as $poster )
                            @if ($poster['iso_639_1'] == 'fr')
                                <img src="https://image.tmdb.org/t/p/w500{{$poster['file_path']}}" alt="" class="imgPoster">
                            @endif   
                        @endforeach
                    </div>
                   
                    <button class="absolute left-2 bottom-1/2 bg-white p-2 rounded-full bg-opacity-80" @click="translation -= 100 ; console.log(translation)" :class="translation <=0 ? 'hidden' : 'block'">
                        <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                    </button>
                    <button class="absolute right-2 bottom-1/2 bg-white p-2 rounded-full bg-opacity-80" @click="translation = translation + 100 ; console.log(translation)" :class="translation >= document.querySelectorAll('.imgPoster').length*100 - 100 ? 'hidden' : 'block'">
                        <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                    </button>
                </div>   
                <input type="text" name="urlPoster" id="urlPoster" :value="images[translation/100].replace('https://image.tmdb.org/t/p/w500', '')" class="hidden">
            </div>
        
            
            <div class="w-full">
                <div class="flex flex-col gap-1 w-full mb-4">
                    <label for="title" class="text-gray-800 font-semibold">Titre</label>
                    <input type="text" name="title" value="{{$movie['title']}}" class=" rounded" disabled>
                </div>
                
                <div class="flex flex-col gap-1 w-full">
                    <label for="synopsis" class="text-gray-800 font-semibold">Synopsis</label>
                    <textarea name="synopsis" id="" cols="60" rows="10" class="rounded" disabled>{{$movie['overview']}}</textarea>
                </div>
                     
            </div>
        </div>
    
          
    
        <div class="flex flex-col gap-1 w-full">
            <label for="synopsis" class="text-gray-800 font-semibold">Avis de Solaris (facultatif)</label>
            <textarea name="avisSolaris" id="" cols="60" rows="5" class="rounded"></textarea>
        </div>  
    
        <div class="flex flex-col gap-2">
            <label for="logo" class="text-gray-800 font-semibold">Logo</label>
            <div class="relative w-[24rem] h-auto min-h-[12rem] border-gray-400 border rounded overflow-hidden" x-data="{translation : 0, logos: [...document.querySelectorAll('.imgLogo')].map(img => img.src)}">
                <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex bg-inherit">
                    @foreach ($movie['images']['logos'] as $logo )
       
                        <img src="https://image.tmdb.org/t/p/w500{{$logo['file_path']}}" alt="" class="imgLogo p-4 bg-gray-300 rounded w-full h-auto">     
    
                    @endforeach
                </div>
        
                <button class="absolute left-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80" @click="translation -= 100 ; console.log(translation)" :class="translation <=0 ? 'hidden' : 'block'">
                    <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                </button>
                <button class="absolute right-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80" @click="translation = translation + 100 ; console.log(translation)" :class="translation >= document.querySelectorAll('.imgLogo').length*100 - 100 ? 'hidden' : 'block'">
                    <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                </button>
                <input type="text" name="urlPoster" id="urlPoster" :value="logos[translation/100].replace('https://image.tmdb.org/t/p/w500', '')" class="hidden">
            </div>
            
        </div>
    
        <div class="flex flex-col gap-2">
            <label for="logo" class="text-gray-800 font-semibold text-lg">Couverture</label>
            <div class="relative w-[65%] border-gray-400 border rounded overflow-hidden" x-data="{translation : 0, covers: [...document.querySelectorAll('.imgcover')].map(img => img.src)}">
                <div x-bind:style="'transform: translateX(-' + translation + '%);'" class="flex bg-inherit">
                    @foreach ($movie['images']['backdrops'] as $backdrop )
       
                        <img src="https://image.tmdb.org/t/p/original{{$backdrop['file_path']}}" alt="" class="imgcover w-full">     
    
                    @endforeach
                </div>
        
                <button class="absolute left-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80" @click="translation -= 100 ; console.log(translation)" :class="translation <=0 ? 'hidden' : 'block'">
                    <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m4.431 12.822 13 9A1 1 0 0 0 19 21V3a1 1 0 0 0-1.569-.823l-13 9a1.003 1.003 0 0 0 0 1.645z"></path></g></svg>
                </button>
                <button class="absolute right-2 bottom-[45%] bg-white p-2 rounded-full bg-opacity-80" @click="translation = translation + 100 ; console.log(translation)" :class="translation >= document.querySelectorAll('.imgcover').length*100 - 100 ? 'hidden' : 'block'">
                    <svg fill="#000000" width="12px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></g></svg>
                </button>
                <input type="text" name="urlPoster" id="urlPoster" :value="covers[translation/100].replace('https://image.tmdb.org/t/p/w500', '')" class="hidden">
            </div>
            
        </div>
    
    
        
        <div class="flex flex-col gap-2">
            <label for="isFavorite" class="text-gray-800 font-semibold">Le film sera-t-il en tête d'affiche ?</label>
            <div class="flex items-center gap-2">
                <input type="radio" name="isFavorite" id="isFavorite" value="1">
                <label for="isFavorite" class="text-gray-800">Oui</label>
            </div>
            <div class="flex items-center gap-2">
                <input type="radio" name="isFavorite" id="isNotFavorite" value="0" checked>
                <label for="isNotFavorite" class="text-gray-800">Non</label>
            </div> 
        </div>
    
        <div class="flex flex-col gap-2 md:hidden">
            <label for="poster" class="text-gray-800 font-semibold">Poster</label>
            <div class="w-72 relative flex">
                <img src="https://image.tmdb.org/t/p/w500{{$movie['poster_path']}}" alt="" class="w-72">
    
                {{-- <div x-show="posterChange == true" class="absolute h-72 w-full overflow-x-auto flex gap-2">
                    @foreach ($movie['images']['posters'] as $poster )
                        @if($poster['iso_639_1'] == 'fr')
                            <img src="https://image.tmdb.org/t/p/w500{{$poster['file_path']}}" alt="">
                        @endif
                    @endforeach
                </div> --}}
            </div>
            
        </div>
    
        <div class="flex-col gap-2 flex">
            <label for="trailer" class="text-gray-800 font-semibold">Trailer</label>
            <div class="flex gap-2 items-center">
                @if (count($movie['videos']['results']) > 0)
                    <input type="text" name="trailer" id="trailer" value="http://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key']}}" class="rounded w-full"/>
                @else
                    <input type="text" name="trailer" id="trailer" placeholder="Insérez un url de vidéo" class="rounded w-full"/>
                @endif
                    
                <button @click="preview = true; videoUrl = document.getElementById('trailer').value" class="py-2 px-4 bg-gray-700 text-white rounded">Prévisualiser</button>
            </div>
            <iframe x-show="preview == true" :src="videoUrl + '?modestbranding=1&controls=20&showinfo=0&rel=0'" frameborder="0" allowfullscreen class="aspect-[16/9] rounded w-[65%]" ></iframe>
        </div>
    
        <div class="flex-col gap-2 flex" x-data="{imgSelector: false}">
            <label for="images" class="text-gray-800 font-semibold">Images</label>
            <div class="border border-gray-400 rounded min-h-36 bg-white">
                <div id="imgReciever" class="flex flex-wrap p-4 gap-4 min-h-36">
    
                </div>


                <div x-show="imgSelector" class="fixed h-screen w-screen top-0 left-0 p-8 overflow-hidden flex justify-center items-center bg-black bg-opacity-70 border border-gray-500">
                    
                        <div class="w-[1200px] h-full my-auto flex flex-col relative">
                            <div class="overflow-y-auto flex flex-wrap justify-evenly w-full h-full bg-gray-200 rounded-b rounded-tl gap-4 p-10">
                                @foreach ($movie['images']['backdrops'] as $image)
                                    <div class="relative">
                                        <img src="https://image.tmdb.org/t/p/w500{{$image['file_path']}}" alt="" class="w-[30rem] border border-gray-400 rounded">
                                        <input type="checkbox"  class="absolute top-2 right-2 accent-green-600 w-6 h-6 imgCheckbox rounded-full" style="accent-color: green;">
                                    </div>    
                                @endforeach
                            </div>
                            <button @click="imgSelector = false" class="absolute top-2 right-2 bg-white p-2 rounded-full">X</button>
                        </div>                
                </div>


            </div>
            <div class="w-full h-full flex justify-start items-center">
                <button class="border border-gray-500 py-1 px-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-600" @click="imgSelector = true">Séléctionner/ajouter une image</button>
            </div>
            <input type="text"  id="imagesString" class="w-[1000px] hidden">
        </div>
    </section>
    
    
</div>

<script defer>
    let container = document.getElementById('imgReciever')
    let imagesString = document.getElementById('imagesString')
    const imagesList = document.querySelectorAll('.imgCheckbox')

    imagesList.forEach(checkbox => {
        checkbox.classList.add(`cb-${Array.from(imagesList).indexOf(checkbox)}`)
        checkbox.addEventListener('change', function(){
            const img = this.previousElementSibling
            if (this.checked){
                container.innerHTML += `
                    <div class="relative w-48 img-${Array.from(imagesList).indexOf(checkbox)}">
                        <img src="${img.src}" class="border border-gray-400 w-48 rounded"/>
                        <button @click="$el.parentElement.remove(); removeSelectedImage(${Array.from(imagesList).indexOf(checkbox)})" class="absolute top-1 right-1 bg-white bg-opacity-70 rounded-full">
                            <svg viewBox="0 0 24 24" width="24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="#0F0F0F"></path> </g></svg>
                        </button>
                    </div>`

                if (imagesString.value == ""){
                    imagesString.value = img.src.replace("https://image.tmdb.org/t/p/w500", "")
                } else {
                    imagesString.value += ',' + img.src.replace("https://image.tmdb.org/t/p/w500", "")
                }
                

            } else {
                imgToRemove = document.querySelector(`.img-${Array.from(imagesList).indexOf(checkbox)}`)
                if (imgToRemove != null) {
                    console.log(imgToRemove)
                    container.removeChild(imgToRemove)
                }
                
                if (imagesString.value.split(',').length == 1 ) {
                    imagesString.value = ""
                } else {
                    imagesString.value = imagesString.value.replace(img.src.replace("https://image.tmdb.org/t/p/w500", ""), "").replace(/^,|,$/g, "");


                }
            }
        })
    })

    function removeSelectedImage(integer){
        document.querySelector(`.cb-${integer}`).checked = false
        document.querySelector(`.cb-${integer}`).dispatchEvent(new Event('change', { bubbles: true }));
    }
</script>

@endsection