<style>
    .carousel-2 {
    position: relative;
    }
    .carousel-2::before {
    position: absolute;
    top: 0;
    left: 0;
    width: 20%;
    height: 100%;
    background: linear-gradient(to left,rgba(255, 255, 255, 0), black);
    content: "";
    z-index: 2;
    pointer-events: none;
    }

    .carousel-2::after {
    position: absolute;
    top: 0;
    right: 0;
    width: 20%;
    height: 100%;
    background: linear-gradient(to right,rgba(255, 255, 255, 0), rgba(0,0,0));
    content: "";
    z-index: 2;
    pointer-events: none;
    }

    .owl-prev {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        color: black;
        z-index: 3;

    }

    .owl-next {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        color: black;
        z-index: 3;
    }

    .owl-next.active {
        background-color: transparent;
    }

    .owl-items {
        transition: all 0.5s ease-in-out;
    }

    .details-active {
        position: relative;
    }

    .film {
        border-radius : 5px;
    }

    .details-active.film {
        
        
    }

    .actif {
        background-color: rgba(35, 35, 35, 0.555);
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: center;
        height: 100%;
        backdrop-filter: blur(4px);
    }

    .hidden-content {
        display: none;
    }
</style>


<div x-data="filmsCarousel" x-init="init" class=" pt-10 pb-20 p-4 box relative">
    <h1 class="text-3xl font-bold dark:text-white mb-10 title-section">Nos Films</h1>
    <div class="owl-carousel owl-theme carousel-2 overflow-hidden overflow-x-scroll">
        @foreach ($films as $film)
            <div @click="onPosterClick($event)"  style="background-image: url({{$film->url_affiche}});height:450px;width: auto ;margin-left" class="bg-center bg-cover bg-no-repeat film flex flex-col justify-end">
                <div class="contenu hidden-content">
                    <h1 class="text-3xl font-bold text-white mb-2">{{$film->titre}}</h1>
                    <p class="text-white text-md">{{$film->synopsis}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>