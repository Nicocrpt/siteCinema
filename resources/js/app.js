import './bootstrap';

import Alpine from 'alpinejs';

import $ from 'jquery';
import 'owl.carousel'
import 'owl.carousel/dist/assets/owl.carousel.css'; // Importer le CSS d'Owl Carousel
import 'owl.carousel/dist/assets/owl.theme.default.css'; // Importer le thème par défaut d'Owl Carousel


window.Alpine = Alpine;
window.$ =window.jQuery = $;






document.addEventListener('alpine:init', () => {



    // Seat Selector :

    Alpine.data('seats', () => ({
        seats: [],

        toggleSeat(e) {
            const clickedSeat = e.target.closest('.seat')
            const seatId = clickedSeat.getAttribute('id')

            if (!this.seats.includes(seatId)) 
            {
                
                if (!clickedSeat.classList.contains('oqp')) {
                    this.seats.push(seatId)
                    clickedSeat.classList.add('selected')
                }
                
            }else {
                this.seats = this.seats.filter(id => id !== seatId)
                clickedSeat.classList.remove('selected')
            }
            //console.log(this.seat)
            //console.log(this.seats)
        },
        

        
        get getAllSelected() {
             return this.seats
        },

        setReservedPlaces() {
            document.querySelectorAll('.seat').forEach((seat) => {
                if (window.occuped.includes(seat.getAttribute('id'))) {
                    seat.classList.add('oqp')
                }
            })
        },

        init() {
            this.setReservedPlaces()
        }

    }))

    // Alpine.data('filmsCaroussel', () => ({
    //     currentIndex: 0,
    //     totalSlides : window.films ? window.films.length : 0,
    //     slideInterval : null,
    //     autoSlideInterval : 5000,
    //     carouselBox : null,
        
    //     next() {

    //         this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
    //         this.carouselBox.style.transform = `translateX(-${(this.currentIndex + this.totalSlides - 1) * 100}%)`;
    //         this.resetAutoSlide();

            


    //         // this.currentIndex = (this.currentIndex + 1) % this.totalSlides
    //         // // //this.carouselBox.append(this.carouselBox.firstElementChild)
    //         // console.log(this.currentIndex)
    //         // this.resetAutoSlide()
    //         // console.log(this.currentIndex)
    //         // // Débogage

    //     },

    //     prev() {
            

    //         console.log(this.totalSlides)
    //         this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides
    //         this.resetAutoSlide()
    //     },

    //     autoSlide() {
    //         console.log('Autoslide initialized')
    //         if(this.slideInterval)
    //         {
    //             clearInterval(this.slideInterval);
    //         }
    //         this.slideInterval = setInterval(() => {
    //             console.log('calling next')
    //             this.next()
    //         },this.autoSlideInterval);
            
    //     },

    //     resetAutoSlide() {
    //         clearInterval(this.slideInterval); // Arrêter l'intervalle en cours
    //         this.autoSlide(); // Relancer le défilement automatique
    //     },

    //     pauseAutoSlide() {
    //         clearInterval(this.slideInterval); // Arrêter l'intervalle en cours
    //     },

    //     init() {
    //         console.log('initialized');
    //         this.carouselBox = document.querySelector('.carousel-container');  // Sélectionner la zone du carousel
    //         this.autoSlide();

    //         // Ajouter les événements pour mettre en pause ou redémarrer l'autoslide lors du survol
    //         this.carouselBox.addEventListener('mouseenter', () => {
    //             this.pauseAutoSlide();
    //         });

    //         this.carouselBox.addEventListener('mouseleave', () => {
    //             this.resetAutoSlide();
    //         });
        
    //     }
    // }));

    Alpine.data('filmsBanner', () => ({
        init() {
            $(document).ready(function() {
                var owl = $('.carousel-1');
                owl.owlCarousel({
                    items: 1, // Un élément à la fois
                    loop: true, // Défilement infini
                    dots: true, // Dots pour la navigation
                    autoplay: true, // Démarrer le défilement automatique
                    autoplayTimeout: 10000,
                    smartSpeed: 5000,
                    //autoplaySpeed: 2000, // Temps entre les défilements
                    autoplayHoverPause: true,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                });
            
                // Force Owl Carousel à redimensionner les éléments en temps réel
                $(window).on('resize', function() {
                    owl.trigger('refresh.owl.carousel'); // Recalculer les dimensions
                });
            });


        },

    }));

    Alpine.data('filmsCarousel', () => ({
        init() {
            //console.log('initialized');
            $(document).ready(function() {
                var owl = $('.carousel-2');

                owl.owlCarousel({
                    loop: true,
                    responsive: {
                        0: {
                            items: 1, // Un élément à la fois
                        },
                        600: {
                            items: 3, // Un élément à la fois
                        },
                        1050: {
                            items: 4
                        },
                        1400: {
                            items: 4
                        },
                        
                        1750: {
                            items: 5
                        },
                        2000: {
                            items: 8, // Un élément à la fois
                        },
                    },
     // Défilement infini
                    dots: false,
                    margin: 10,
                    mouseDrag: true,
                    stagePadding: 10,
                    touchDrag: true,
                    nav: true, // Dots pour la navigation

                });
            
                // Force Owl Carousel à redimensionner les éléments en temps réel
                $(window).on('resize', function() {
                    owl.trigger('refresh.owl.carousel'); // Recalculer les dimensions
                });
            })
        },

        onPosterClick(e) {
            const clickedFilm = e.target.closest('.owl-item')
            const clickedContent = e.target.querySelector('.contenu')

            if (!clickedFilm.classList.contains('details-active')) {
                clickedFilm.classList.add('details-active')
                clickedContent.classList.remove('hidden-content')
                clickedContent.classList.add('actif')
                
            } else {
                clickedFilm.classList.remove('details-active')
                clickedContent.classList.remove('actif')
                clickedContent.classList.add('hidden-content')
            }
        }
    }));


    Alpine.data('selectPrices', () => ({
        places: window.selectedPlaces.length,
        placesMax: window.selectedPlaces.length,
        totalHTML: document.getElementById('total'),
        total: 0,

        updateValueSTD(e){
            const button = e.target
            if(button.getAttribute('id') === "plusSTD") {
                if (this.places != 0) {
                    document.getElementById('priceSTD').value = parseInt(document.getElementById('priceSTD').value) + 1
                    this.places = this.places - 1

                    this.total += 9
                    this.totalHTML.innerHTML = this.total.toString()

                    console.log(this.places)
                    if (this.places == 0) {
                        button.classList.remove('bg-yellow-300')
                        button.classList.add('bg-gray-200')
                        button.classList.add('text-gray-400')
                        document.getElementById('plusET').classList.remove('bg-yellow-300')
                        document.getElementById('plusET').classList.add('bg-gray-200')
                        document.getElementById('plusET').classList.add('text-gray-400')
                        if (document.getElementById('priceET').value == 0) {
                            let other = document.getElementById('plusET')
                            other.classList.remove('bg-yellow-300')
                            other.classList.add('bg-gray-200')
                            other.setAttribute('disabled', 'true')
                            document.getElementById('minusET').setAttribute('disabled', 'true')
                            document.getElementById('minusET').classList.add('bg-gray-200')
                            document.getElementById('minusET').classList.add('text-gray-400')
                            document.getElementById('minusET').classList.remove('bg-gray-300')
                            document.getElementById('priceET').classList.add('text-gray-200')
                            document.getElementById('priceET').setAttribute('disabled', 'true')
                            document.getElementById('labelET').classList.add('text-gray-200')
                        }
                    }
                }
            }else if (button.getAttribute('id') === "minusSTD") {
                if (this.places != this.placesMax && document.getElementById('priceSTD').value != 0) {
                    document.getElementById('priceSTD').value = parseInt(document.getElementById('priceSTD').value) - 1
                    this.places = this.places + 1
                    this.total -= 9
                    this.totalHTML.innerHTML = this.total.toString()
                    document.getElementById('plusSTD').classList.remove('bg-gray-300')
                    document.getElementById('plusSTD').classList.add('bg-yellow-300')
                    document.getElementById('plusSTD').classList.remove('text-gray-400')

                    document.getElementById('plusET').classList.add('bg-yellow-300')
                    document.getElementById('plusET').classList.remove('bg-gray-200')
                    document.getElementById('plusET').classList.remove('text-gray-400')
                    document.getElementById('plusET').removeAttribute('disabled')
                    document.getElementById('minusET').removeAttribute('disabled')
                    document.getElementById('minusET').classList.remove('bg-gray-200')
                    document.getElementById('minusET').classList.remove('text-gray-400')
                    document.getElementById('minusET').classList.add('bg-gray-300')
                    document.getElementById('priceET').classList.remove('text-gray-200')
                    document.getElementById('priceET').removeAttribute('disabled')
                    document.getElementById('labelET').classList.remove('text-gray-200')
                }
            }

            
        },
        updateValueET(e){
            const button = e.target
            if(button.getAttribute('id') === "plusET") {
                if (this.places != 0) {
                    document.getElementById('priceET').value = parseInt(document.getElementById('priceET').value) + 1
                    this.places = this.places - 1
                    this.total += 6
                    this.totalHTML.innerHTML = this.total.toString()
                    console.log(this.places)
                    if (this.places == 0) {
                        button.classList.remove('bg-yellow-300')
                        button.classList.add('bg-gray-200')
                        button.classList.add('text-gray-400')
                        document.getElementById('plusSTD').classList.add('bg-gray-200')
                        document.getElementById('plusSTD').classList.remove('bg-gray-300')
                        document.getElementById('plusSTD').classList.remove('bg-yellow-300')
                        document.getElementById('plusSTD').classList.add('text-gray-400')
                        if (document.getElementById('priceSTD').value == 0) {
                            let other = document.getElementById('plusSTD')
                            other.classList.remove('bg-yellow-300')
                            other.classList.add('bg-gray-200')
                            other.setAttribute('disabled', 'true')
                            document.getElementById('minusSTD').setAttribute('disabled', 'true')
                            document.getElementById('minusSTD').classList.add('bg-gray-200')
                            document.getElementById('minusSTD').classList.add('text-gray-400')
                            document.getElementById('minusSTD').classList.remove('bg-gray-300')
                            document.getElementById('priceSTD').classList.add('text-gray-200')
                            document.getElementById('priceSTD').setAttribute('disabled', 'true')
                            document.getElementById('labelSTD').classList.add('text-gray-200')
                        }
                    }
                }
            }else if (button.getAttribute('id') === "minusET") {
                if (this.places != this.placesMax && document.getElementById('priceET').value != 0) {
                    document.getElementById('priceET').value = parseInt(document.getElementById('priceET').value) - 1
                    this.places = this.places + 1
                    this.total -= 6
                    this.totalHTML.innerHTML = this.total.toString()
                    document.getElementById('plusET').classList.remove('bg-gray-300')
                    document.getElementById('plusET').classList.add('bg-yellow-300')
                    document.getElementById('plusET').classList.remove('text-gray-400')

                    document.getElementById('plusSTD').classList.add('bg-yellow-300')
                    document.getElementById('plusSTD').classList.remove('bg-gray-200')
                    document.getElementById('plusSTD').classList.remove('text-gray-400')
                    document.getElementById('plusSTD').removeAttribute('disabled')
                    document.getElementById('minusSTD').removeAttribute('disabled')
                    document.getElementById('minusSTD').classList.remove('bg-gray-200')
                    document.getElementById('minusSTD').classList.remove('text-gray-400')
                    document.getElementById('minusSTD').classList.add('bg-gray-300')
                    document.getElementById('priceSTD').classList.remove('text-gray-200')
                    document.getElementById('priceSTD').removeAttribute('disabled')
                    document.getElementById('labelSTD').classList.remove('text-gray-200')
                }
            }

            
        }
    }))
       

});

Alpine.start();


$(window).on('load', function () {
    console.log('domOK');
    initCarousel();
    initBanner();
});

console.log('jQuery version:', $.fn.jquery);

function initCarousel() {
    console.log('initCarousel')
    var owl = $(".custom-carousel").owlCarousel({
        autoWidth: true,
        loop: false,
        margin: 10,
        nav: false, // Activer les flèches de navigation
        dots: false, // Désactiver les points de pagination
        autoplay: false, // Activer le défilement automatique
    });
    $(".custom-carousel .film").click(function () {
        $(".custom-carousel .film").not($(this)).removeClass("active");
        $(this).toggleClass("active");
      });

    $('.owl-prev').on('click', function() {
        owl.trigger('prev.owl.carousel');
    });

    $('.owl-next').on('click', function() {
        owl.trigger('next.owl.carousel');
    });
}





