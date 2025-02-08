<style>
    .queryBox::after {
       background: linear-gradient(180deg,rgba(24, 24, 24, 0.656) 33%,rgba(8, 8, 8, 0) 100%);
    }
</style>


<div class="fixed bg-stone-950 bg-opacity-80 !top-0 !left-0 transition-all ease-in-out duration-300 z-40 backdrop-blur-md"  style="width: 100%; max-height: 100% ;min-height: 100% !important;" x-show="open" x-transition:enter="transition ease-out duration-300" 
x-transition:enter-start="opacity-0 " 
x-transition:enter-end="opacity-100" 
x-transition:leave="transition ease-in duration-300" 
x-transition:leave-start="opacity-100" 
x-transition:leave-end="opacity-0">
    <div class="w-full h-full relative flex justify-center">
        <button @click="open = false" id="exitBtn" class="absolute top-2 md:left-5 lg:left-7 md:right-auto right-2 text-white rounded-full font-bold transition-all ease-in-out duration-300 p-2"><svg class="h-6 w-6 hover:opacity-90 opacity-70 font-bold" fill="white" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512.481 421.906L850.682 84.621c25.023-24.964 65.545-24.917 90.51.105s24.917 65.545-.105 90.51L603.03 512.377 940.94 850c25.003 24.984 25.017 65.507.033 90.51s-65.507 25.017-90.51.033L512.397 602.764 174.215 940.03c-25.023 24.964-65.545 24.917-90.51-.105s-24.917-65.545.105-90.51l338.038-337.122L84.14 174.872c-25.003-24.984-25.017-65.507-.033-90.51s65.507-25.017 90.51-.033L512.48 421.906z"></path></g></svg></button>

        

        <div @click.away="open = false" class="mt-24 flex flex-col w-fit max-w-full items-center overflow-hidden overflow-y-scroll" style="max-height: 100vh">
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-12 ">Que souhaitez vous voir ?</h1>
            <form action="" class="flex justify-center gap-2">
                @csrf
                <input autofocus id="searchInput" type="text" class=" bg-white bg-opacity-20 border-none rounded-xl text-2xl p-2 pl-4 pr-4 w-80 md:w-96 text-white focus:outline-none h-12" >
                {{-- <button id="btnSend" type="button" class="text-2xl  rounded-xl font-bold bg-cyan-600 hover:bg-cyan-500 transition-all ease-in-out duration-300"><svg class="h-12 w-12 p-2 text-stone-200 hover:opacity-90 opacity-70" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button> --}}
                
            </form>
            <div class="max-w-[800px]">
                <div id="infosFilms" class="text-white mt-10">
                    {{-- <div class="grid grid-cols-4 p-2 border border-zinc-400 shadow-md bg-zinc-600 hover:bg-zinc-500 rounded-lg mb-5 transition-all ease-in-out duration-300" style="max-width: 1000px">
                        <img class="col-span-1 rounded-md w-full" src="${film.url_affiche}" alt="">
                        <div class="col-span-3 pl-5">
                            <h1 class="text-xl font-semibold dark:text-white">${film.titre}</h1>
                            <p class="dark:text-white" >${film.realisateurs[0].nom}</p>
                            
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        
    </div>

    
</div>

<script>
    const btn = document.querySelector('#btnSend')
    const SearchInput = document.querySelector('#searchInput')
    const filmList = document.querySelector('#infosFilms')
    const exitBtn = document.querySelector('#exitBtn')

    

    SearchInput.addEventListener('input', () => {
        
        let inputContent = encodeURIComponent(SearchInput.value)
        filmList.innerHTML = ''

        let url = "{{ route('films.query') }}";
        url += '?research=' + inputContent;
        console.log(url)

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
        .then(films => 
        {
            console.log(films)
            films.forEach(film => {
                const filmItem = document.createElement('div');
                let actorString = ''
                let realString = ''
                film.acteurs.forEach(acteur => {
                    if (acteur == film.acteurs[film.acteurs.length - 1]) {
                        actorString += `${acteur.nom}`
                    } else {
                        actorString += `${acteur.nom}, `
                    }
                })
                film.realisateurs.forEach(realisateur => {
                    if (realisateur == film.realisateurs[film.realisateurs.length - 1]) {
                        realString += `${realisateur.nom}`
                    } else {
                        realString += `${realisateur.nom}, `
                    }
                })
                console.log(inputContent)
                actorString = actorString.split(SearchInput.value.toLowerCase()).join(`<mark>${SearchInput.value}</mark>`);
                film.titre = film.titre.split(SearchInput.value).join(`<mark>${SearchInput.value}</mark>`);
                realString = realString.split(SearchInput.value).join(`<mark>${SearchInput.value}</mark>`);
                console.log(actorString)
                 // Assure-toi que 'titre' correspond à la clé dans ta réponse JSON
                filmItem.innerHTML = 
                    `<a href="/films/${film.slug}">
                    <div class="grid grid-cols-4 p-2 h-60  shadow-md bg-zinc-600 hover:bg-zinc-500 rounded-lg mb-5 transition-all ease-in-out duration-300">
                        <img class="col-span-1 rounded-md h-56" src="${film.url_affiche}" alt="">
                        <div class="col-span-3 pl-5">
                            <h1 class="text-xl font-semibold dark:text-white">${film.titre}</h1>
                            <p class="dark:text-white" >De : ${realString}</p>
                            <p class="dark:text-white" >Avec : ${actorString}</p>   
                        </div>
                    </div>
                    </a>`
                filmList.appendChild(filmItem);
            });
        })
        .catch(error => console.error('Erreur:', error));

    })

    exitBtn.addEventListener('click', () => {
        SearchInput.value = ''
        filmList.innerHTML = ''
    })

</script>