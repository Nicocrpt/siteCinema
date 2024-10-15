<style>
    .owl-carousel.carousel-1 {
        width: 100%;
        height: 80vh;
        position: relative;
        overflow: hidden;
        transition: height 0.8s ease-in-out;
    }

    .owl-carousel.carousel-1:hover {
        .owl-dots {
            opacity: 100%;
        }
    }

    .owl-carousel.carousel-1 .item {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #4a90e2; /* Couleur de fond par défaut */
        color: #fff; /* Couleur du texte */
        height: 65vh; /* Hauteur de chaque slide */
        background-size: cover; /* Couvrir l'arrière-plan */
        background-position: center; /* Centrer l'image */
        transition: height 0.5s ease-in-out;

    }


    .owl-dots {
        position: absolute; /* Positionner les dots */
        bottom: 20px; /* Ajuster la distance du bas */
        left: 50%; /* Centrer horizontalement */
        transform: translateX(-50%); /* Ajuster pour centrer précisément */
        z-index: 10; /* Assurer que les dots sont au-dessus des autres éléments */
        opacity: 0; /* Opacité à 0% par défaut */
        transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out; /* Transition douce pour l'opacité */
        transition-delay: 1s;
    }
    
    .owl-dots .owl-dot {
        background: rgba(255, 255, 255, 0.5); /* Couleur des dots */
        width: 12px; /* Largeur des dots */
        height: 12px; /* Hauteur des dots */
        margin: 0 5px; /* Espacement entre les dots */
        border-radius: 50%; /* Faire des dots ronds */
        opacity: 0.5; /* Opacité des dots */
        transition: opacity 0.5s ease-in-out; /* Transition douce pour l'opacité */
    }

    .owl-dots .owl-dot:hover {
        opacity: 0.8;
    }

    .owl-dots .owl-dot.active {
        opacity: 1;
        margin-bottom: 2px;
        
        
        span {
            margin-bottom: 20px;
        border: solid 5px white;
        opacity: 1; /* Opacité à 100% pour le dot actif */
        
        transition: opacity 0.5s; 
        }
    }

    .fade-in {
        opacity: 0;
        animation: fadeIn 10s ease-in;
    }

    .fade-in.active {
        opacity: 1;
    }

    .fadeOut {
        opacity: 1;
        transition: opacity 10s ease-out; /* Durée de l'animation de sortie */
    }

    .fadeOut.active {
        opacity: 0;
    }

    @media (max-width: 109em) {
        .owl-carousel.carousel-1 {
            height: 50vh;
        }

        .owl-carousel.carousel-1 .item {
        
            height: 50vh; /* Hauteur de chaque slide */
        
        }

        .index-content {
            margin-top: 59vh
        }
    }

</style>



<div x-data="filmsBanner" x-init="init" class=" block top-0 absolute max-w-full">
    <div class="owl-carousel owl-theme carousel-1  border-b-4  border-b-slate-200 max-h-fit" style="">
        @foreach ($films as $film)
            <div class="item bg-center bg-cover bg-no-repeat" style="background-image: url('{{ $film->url_backdrop }}'); ">
                <div class="grid grid-rows-5 h-full w-full">
                    <div></div>
                    <div class="row-start-2 row-span-4 grid grid-cols-2">
                        <div class="p-10 flex flex-col-reverse justify-start items-center mb-24 gap-5">
                            
                            <a href="{{route('film.show', $films->where('est_favori', 1)->first()->slug)}}"><button class="
                                font-bold
                                text-white
                                hover:before:bg-white-500
                               
                                relative h-[50px] 
                                overflow-hidden 
                                
                                bg-black p-2 pl-4 pr-4
                                rounded-full
                                transition-all before:absolute 
                                before:bottom-0 before:left-0 
                                before:top-0 before:z-0 before:h-full before:w-0 
                                before:bg-white before:transition-all
                                before:duration-500 
                                hover:text-black
                                hover:before:left-0 hover:before:w-full
                                mt-5
                                "><span class="relative z-10" type="submit">Je réserve ma séance !</span></button></a>
                                <img src="{{ $film->url_logo }}" alt="">
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        @endforeach
    </div>
    
</div>


<script>
        window.films = @json($films->values());

</script>
