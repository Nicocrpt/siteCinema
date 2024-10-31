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


    Alpine.data('selectPrices', () => ({
        places: window.selectedPlaces.length,
        placesMax: window.selectedPlaces.length,
        totalHTML: document.getElementById('total'),
        total: 0,
        totalArray : [],
        index: 0,
        guestModal: false,
        user: window.user,

        updateValueSTD(e){
            const button = e.target
            if(button.getAttribute('id') === "plusSTD") {
                if (this.places != 0) {
                    document.getElementById('priceSTD').value = parseInt(document.getElementById('priceSTD').value) + 1
                    this.places = this.places - 1

                    this.total += 9
                    this.totalArray.push(9)
                    this.totalHTML.innerHTML = this.total.toString()

                    console.log(this.places)
                    if (this.places == 0) {
                        button.classList.remove('bg-cyan-500')
                        button.classList.add('bg-gray-200')
                        button.classList.add('text-gray-400')
                        document.getElementById('plusET').classList.remove('bg-cyan-500')
                        document.getElementById('plusET').classList.add('bg-gray-200')
                        document.getElementById('plusET').classList.add('text-gray-400')
                        if (document.getElementById('priceET').value == 0) {
                            let other = document.getElementById('plusET')
                            other.classList.remove('bg-cyan-500')
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
                    this.index = this.totalArray.indexOf(9)
                    if (this.index > -1) {
                        this.totalArray.splice(this.index, 1)
                    }

                    this.totalHTML.innerHTML = this.total.toString()
                    document.getElementById('plusSTD').classList.remove('bg-gray-300')
                    document.getElementById('plusSTD').classList.add('bg-cyan-500')
                    document.getElementById('plusSTD').classList.remove('text-gray-400')

                    document.getElementById('plusET').classList.add('bg-cyan-500')
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
            console.log(this.totalArray)
            
        },
        updateValueET(e){
            const button = e.target
            if(button.getAttribute('id') === "plusET") {
                if (this.places != 0) {
                    document.getElementById('priceET').value = parseInt(document.getElementById('priceET').value) + 1
                    this.places = this.places - 1
                    this.total += 6
                    this.totalArray.push(6)
                    this.totalHTML.innerHTML = this.total.toString()
                    console.log(this.places)
                    if (this.places == 0) {
                        button.classList.remove('bg-cyan-500')
                        button.classList.add('bg-gray-200')
                        button.classList.add('text-gray-400')
                        document.getElementById('plusSTD').classList.add('bg-gray-200')
                        document.getElementById('plusSTD').classList.remove('bg-gray-300')
                        document.getElementById('plusSTD').classList.remove('bg-cyan-500')
                        document.getElementById('plusSTD').classList.add('text-gray-400')
                        if (document.getElementById('priceSTD').value == 0) {
                            let other = document.getElementById('plusSTD')
                            other.classList.remove('bg-cyan-500')
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
                    this.index = this.totalArray.indexOf(6)
                    if (this.index > -1) {
                        this.totalArray.splice(this.index, 1)
                    }

                    this.totalHTML.innerHTML = this.total.toString()
                    document.getElementById('plusET').classList.remove('bg-gray-300')
                    document.getElementById('plusET').classList.add('bg-cyan-500')
                    document.getElementById('plusET').classList.remove('text-gray-400')

                    document.getElementById('plusSTD').classList.add('bg-cyan-500')
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
            console.log(this.totalArray)
            
        }
    }))

    Alpine.data('filmShow', () => ({
        contentFilm: false, 
        scrollState: 0, 
        maxSize: 14, 
        minSize: 11, 
        scrollLimit: 100,
        isSmallScreen: window.innerWidth < 768,
        is2xlScreen: window.innerWidth >= 1536,
        fullscreenImage: false,
        translation: 0,

        init() {
            window.addEventListener('resize', () => {
                this.isSmallScreen = window.innerWidth < 768 
                console.log(this.isSmallScreen)
                this.is2xlScreen = window.innerWidth >= 1536
            })

            window.addEventListener('scroll', () => { 
                if (this.isSmallScreen) {
                    this.scrollState = Math.min(window.scrollY, this.scrollLimit)
                }
            })
        }

    }))
       

});

Alpine.start();


$(window).on('load', function () {
    console.log('domOK');
    initCarousel();
    initBanner();
});









