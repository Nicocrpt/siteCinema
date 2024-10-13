import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;



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

    Alpine.data('filmsCaroussel', () => ({
        currentIndex: 0,
        totalSlides : window.films ? window.films.length : 0,
        slideInterval : null,

        next() {

            this.currentIndex = (this.currentIndex + 1) % this.totalSlides
            console.log(this.currentIndex)
            this.resetAutoSlide()
            console.log(this.currentIndex)
            // Débogage

        },

        prev() {
            console.log(this.totalSlides)
            this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides
            this.resetAutoSlide()
        },

        autoSlide() {
            console.log('Autoslide initialized')
            if(this.slideInterval)
            {
                clearInterval(this.slideInterval);
            }
            this.slideInterval = setInterval(() => {
                console.log('calling next')
                this.next()
            },20000);
            
        },

        resetAutoSlide() {
            clearInterval(this.slideInterval); // Arrêter l'intervalle en cours
            this.autoSlide(); // Relancer le défilement automatique
        },

        init() {
            console.log('initialized')
            this.autoSlide()
        }
    }));

    Alpine.data('selectPrices', () => ({
        places: window.selectedPlaces.length,
        placesMax: window.selectedPlaces.length,

        updateValueSTD(e){
            const button = e.target
            if(button.getAttribute('id') === "plusSTD") {
                if (this.places != 0) {
                    document.getElementById('priceSTD').value = parseInt(document.getElementById('priceSTD').value) + 1
                    this.places = this.places - 1
                    console.log(this.places)
                    if (this.places == 0) {
                        button.classList.remove('bg-yellow-300')
                        button.classList.add('bg-gray-200')
                        document.getElementById('plusET').classList.remove('bg-yellow-300')
                        document.getElementById('plusET').classList.add('bg-gray-200')
                        if (document.getElementById('priceET').value == 0) {
                            let other = document.getElementById('plusET')
                            other.classList.remove('bg-yellow-300')
                            other.classList.add('bg-gray-200')
                            other.setAttribute('disabled', 'true')
                            document.getElementById('minusET').setAttribute('disabled', 'true')
                            document.getElementById('minusET').classList.add('bg-gray-200')
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
                    document.getElementById('plusSTD').classList.remove('bg-gray-300')
                    document.getElementById('plusSTD').classList.add('bg-yellow-300')

                    document.getElementById('plusET').classList.add('bg-yellow-300')
                    document.getElementById('plusET').classList.remove('bg-gray-200')
                    document.getElementById('plusET').removeAttribute('disabled')
                    document.getElementById('minusET').removeAttribute('disabled')
                    document.getElementById('minusET').classList.remove('bg-gray-200')
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
                    console.log(this.places)
                    if (this.places == 0) {
                        button.classList.remove('bg-yellow-300')
                        button.classList.add('bg-gray-200')
                        document.getElementById('plusSTD').classList.add('bg-gray-200')
                        document.getElementById('plusSTD').classList.remove('bg-gray-300')
                        document.getElementById('plusSTD').classList.remove('bg-yellow-300')
                        if (document.getElementById('priceSTD').value == 0) {
                            let other = document.getElementById('plusSTD')
                            other.classList.remove('bg-yellow-300')
                            other.classList.add('bg-gray-200')
                            other.setAttribute('disabled', 'true')
                            document.getElementById('minusSTD').setAttribute('disabled', 'true')
                            document.getElementById('minusSTD').classList.add('bg-gray-200')
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
                    document.getElementById('plusET').classList.remove('bg-gray-300')
                    document.getElementById('plusET').classList.add('bg-yellow-300')

                    document.getElementById('plusSTD').classList.add('bg-yellow-300')
                    document.getElementById('plusSTD').classList.remove('bg-gray-200')
                    document.getElementById('plusSTD').removeAttribute('disabled')
                    document.getElementById('minusSTD').removeAttribute('disabled')
                    document.getElementById('minusSTD').classList.remove('bg-gray-200')
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