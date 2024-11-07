

<div x-data="filmsCaroussel" x-init="init" class="relative overflow-hidden w-full group">

    
    <div class="flex transition-transform duration-1000 ease-in-out carousel-box" :style="`transform: translateX(-${currentIndex * 100}%)`">
        @foreach ($films as $film)
            <div class="top-20 left-0 w-full bg-cover bg-center bg-no-repeat border-b-4 border-t-4 border-b-slate-200 border-t-slate-200 min-w-full" style="background-image: url({{$film->url_backdrop}}); height: 60vh;">
                <div class="z-10 relative">
                    <div class="h-[50vh] grid grid-rows-2">
                        <div></div>
                        <div class="pl-20 flex flex-col">
                            <img class="w-1/3" src="{{ $film->url_logo }}" alt="" />
                            
                            <a class="ml-20 mt-5" href="{{route('film.show', $films->where('est_favori', 1)->first()->slug)}}"><button class="
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
                            {{-- <a class="w-fit ml-20 mt-5 p-2 bg-black text-xl text-white rounded-2xl font-bold border-2 border-black hover:bg-white hover:text-black hover:border-black transition-all ease-in-out duration-500" href="{{route('film.show', $films->where('est_favori', 1)->first()->slug)}}">Je réserve !</a> --}}
                        </div>
                    </div> 
                </div>
            </div>
        @endforeach     
    </div>

    {{-- <button @click="prev" cursor="pointer" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-4 py-2">
        ⟨
    </button>

    <!-- Bouton suivant -->
    <button @click="next" cursor="pointer" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-4 py-2">
        ⟩
    </button> --}}

    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 opacity-0 group-hover:opacity-80 transition-all ease-in-out duration-500 delay-500">
        @foreach ($films->values() as $index => $film)
            <button @click="currentIndex = {{ $index }}; resetAutoSlide()" class="w-3 h-3 rounded-full" :class="currentIndex === {{ $index }} ? 'bg-white' : 'bg-gray-400'"></button>
        @endforeach
    </div>

    <script>
        window.films = @json($films->values());
        console.log(films)
    </script>
</div>



{{-- <script>
    console.log('aljdqlmsfj')
    let carousel = document.querySelector('.carousel');
    let carouselInner = document.querySelector('.carousel-inner');
    let prev = document.querySelector('.carousel-controls .prev');
    let next = document.querySelector('.carousel-controls .next');
    let slides = document.querySelectorAll('.carousel-inner .carousel-item');
    let totalSlides = slides.length;
    let step = 100 / totalSlides;
    let activeSlide = 0;
    let activeIndicator = 0;
    let direction = -1;
    let jump = 1;
    let interval = 2000;
    let time;

    carouselInner.style.minWidth = (totalSlides * 100) + '%';
    loadIndicators();
    loop(true);

    next.addEventListener('click', () => {
        slideToNext();
    });

    prev.addEventListener('click', () => {
        slideToPrev();
    });

    carouselInner.addEventListener('transitionend', () => {
        if (direction === -1) {
            if (jump > 1) {
                for (let i = 0; i < jump; i++) {
                    activeSlide++;
                    carouselInner.append(carouselInner.firstElementChild);
                }
            } else {
                activeSlide++;
                carouselInner.append(carouselInner.firstElementChild);
            }
        } else if (direction === 1) {
            if (jump > 1) {
                for (let i = 0; i < jump; i++) {
                    activeSlide--;
                    carouselInner.prepend(carouselInner.lastElementChild);
                }
            } else {
                activeSlide--;
                carouselInner.prepend(carouselInner.lastElementChild);
            }
        }

        carouselInner.style.transition = 'none';
        carouselInner.style.transform = 'translateX(0%)';

        setTimeout(() => {
            jump = 1;
            carouselInner.style.transition = 'all ease .5s';
        });

        updateIndicators();
    });

    document.querySelectorAll('.carousel-indicators span').forEach(item => {
        item.addEventListener('click', (e) => {
            let slideTo = parseInt(e.target.dataset.slideTo);
            let indicators = document.querySelectorAll('.carousel-indicators span');
            indicators.forEach((item, index) => {
                if (item.classList.contains('active')) {
                    activeIndicator = index;
                }
            });

            if (slideTo - activeIndicator > 1) {
                jump = slideTo - activeIndicator;
                step = jump * step;
                slideToNext();
            } else if (slideTo - activeIndicator === 1) {
                slideToNext();
            } else if (slideTo - activeIndicator < 0) {
                if (Math.abs(slideTo - activeIndicator) > 1) {
                    jump = Math.abs(slideTo - activeIndicator);
                    step = jump * step;
                    slideToPrev();
                }
                slideToPrev();
            }
            step = 100 / totalSlides;
        });
    });

    carousel.addEventListener('mouseover', () => {
        loop(false);
    });

    carousel.addEventListener('mouseout', () => {
        loop(true);
    });

    function loadIndicators() {
        slides.forEach((slide, index) => {
            if (index === 0) {
                document.querySelector('.carousel-indicators').innerHTML += `<span data-slide-to="${index}" class="active"></span>`;
            } else {
                document.querySelector('.carousel-indicators').innerHTML += `<span data-slide-to="${index}"></span>`;
            }
        });
    }

    function updateIndicators() {
        if (activeSlide > (totalSlides - 1)) {
            activeSlide = 0;
        } else if (activeSlide < 0) {
            activeSlide = (totalSlides - 1);
        }

        document.querySelector('.carousel-indicators span.active').classList.remove('active');
        document.querySelectorAll('.carousel-indicators span')[activeSlide].classList.add('active');
    }

    function slideToNext() {
        if (direction === 1) {
            direction = -1;
            carouselInner.prepend(carouselInner.lastElementChild);
        }
        carousel.style.justifyContent = 'flex-start';
        carouselInner.style.transform = `translateX(-${step}%)`;
    }

    function slideToPrev() {
        if (direction === -1) {
            direction = 1;
            carouselInner.append(carouselInner.firstElementChild);
        }
        carousel.style.justifyContent = 'flex-end';
        carouselInner.style.transform = `translateX(${step}%)`;
    }

    function loop(status) {
        if (status === true) {
            time = setInterval(() => {
                slideToNext();
            }, interval);
        } else {
            clearInterval(time);
        }
    }
</script> --}}