<style>
    .owl-carousel.carousel-1 {
        width: 100vw;
        height: 65vh;
        min-height: 500px !important;
        position: relative;
        overflow: hidden;
        transition: height 0.8s ease-in-out;
    }

    .owl-carousel.carousel-1:hover {
        .owl-dots {
            opacity: 100%;
        }
    }

    .owl-stage {
        @apply !w-fit overflow-hidden;
    }

    .owl-item.cloned {
        overflow: hidden;
    }

    .owl-carousel.carousel-1 .item {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #4a90e2; /* Couleur de fond par défaut */
        color: #fff; /* Couleur du texte */
        height: 65vh; /* Hauteur de chaque slide */
        min-height: 500px !important;
        background-size: cover; /* Couvrir l'arrière-plan */
        background-position: center; /* Centrer l'image */
        transition: height 0.5s ease-in-out;

    }


    .owl-dots {
        position: absolute; /* Positionner les dots */
        bottom: 20px; /* Ajuster la distance du bas */
        left: 50%; /* Centrer horizontalement */
        transform: translateX(-50%); /* Ajuster pour centrer précisément */
        z-index: 50 ; /* Assurer que les dots sont au-dessus des autres éléments */
        opacity: 0; /* Opacité à 0% par défaut */
        transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out; /* Transition douce pour l'opacité */
        transition-delay: 1s;
    }
    
    .owl-dots .owl-dot {
        background: rgb(255, 255, 255); /* Couleur des dots */
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
            margin-bottom: 5px;
            z-index: 20;
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
            min-height: 500px !important;
        }

        .owl-carousel.carousel-1 .item {
        
            height: 50vh; /* Hauteur de chaque slide */
            min-height: 500px !important;
        
        }

        /* .index-content {
            margin-top: 59vh
        } */
    }




</style>



<div x-data="filmsBanner" x-init="init" class=" block max-w-full relative z-20">
    <div class="owl-carousel owl-theme carousel-1 border-none border-zinc-950 max-h-fit" style="">
        @foreach ($films as $film)
            <div class="item bg-center bg-cover bg-no-repeat" style="background-image: url('{{ $film->url_backdrop }}'); ">
                <div class="grid grid-rows-5 h-full w-full">
                    <div></div>
                    <div class="row-start-3 row-span-3 flex md:row-start-2 md:row-span-4 md:grid md:grid-cols-2">
                        <div class="p-10 flex flex-col justify-end items-center mb-5 md:pb-24 h-full">
                            {{-- <a href="{{route('film.show', $film->slug)}}"><button class="bg-zinc-950 px-4 py-2 rounded-lg border border-zinc-600 md:hover:bg-zinc-800 transition-color ease-in-out duration-200"><span class="relative z-10" type="submit">Je réserve ma séance !</span></button></a> --}}
                            <img src="{{ $film->url_logo }}" alt="" class="max-w-[40rem] md:pb-0 pb-10 !relative !z-10">
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        @endforeach
    </div>
    {{-- <div class="w-full block absolute bottom-0 h-[6rem] z-[1] pointer-events-none" style="background: linear-gradient(
  0deg,
  rgba(9, 9, 11, 1) 1%,
  rgba(9, 9, 11, 0.9) 5%,        /* #09090b 100% opaque */
  rgba(9, 9, 11, 0.738) 19%,   /* 73.8% opaque */
  rgba(9, 9, 11, 0.541) 34%,   /* 54.1% opaque */
  rgba(9, 9, 11, 0.382) 47%,   /* 38.2% opaque */
  rgba(9, 9, 11, 0.278) 56.5%, /* 27.8% opaque */
  rgba(9, 9, 11, 0.194) 65%,   /* 19.4% opaque */
  rgba(9, 9, 11, 0.126) 73%,   /* 12.6% opaque */
  rgba(9, 9, 11, 0.075) 80.2%, /* 7.5% opaque */
  rgba(9, 9, 11, 0.042) 86.1%, /* 4.2% opaque */
  rgba(9, 9, 11, 0.021) 91%,   /* 2.1% opaque */
  rgba(9, 9, 11, 0.008) 95.2%, /* 0.8% opaque */
  rgba(9, 9, 11, 0.002) 98.2%, /* 0.2% opaque */
  rgba(9, 9, 11, 0) 100%       /* transparent */
);" 
    >--}}

    </div>
</div>


<script>
        window.films = @json($films->values());

</script>
