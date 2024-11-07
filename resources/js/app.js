import './bootstrap';

import Alpine from 'alpinejs';

import $, { data } from 'jquery';
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
       
    Alpine.data('userPage', () => ({

        sideMenu : true,
        active_form : false,
        formsStatus: false,
        skip : 2,


        onUpdateUserInfoClick(event) {
            event.preventDefault();
            const url = event.target.closest('form').getAttribute('action');

            fetch(url, {
                method : 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                },
                body: JSON.stringify({
                    Nom: document.getElementById('Nom').value,
                    Prenom: document.getElementById('Prenom').value,
                    Mail: document.getElementById('Mail').value,
                    Telephone: document.getElementById('Telephone').value,
                    Adresse: document.getElementById('Adresse').value,
                    CodePostal: document.getElementById('CodePostal').value,
                    Ville: document.getElementById('Ville').value
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP ! statut : ${response.status}`);
                }
                return response.json();
            })
            .then(data => {

                document.getElementById('Nom').value = data.updated_data.Nom
                document.getElementById('Prenom').value = data.updated_data.Prenom
                document.getElementById('Mail').value = data.updated_data.Mail
                document.getElementById('Telephone').value = data.updated_data.Telephone
                document.getElementById('Adresse').value = data.updated_data.Adresse
                document.getElementById('CodePostal').value = data.updated_data.CodePostal
                document.getElementById('Ville').value = data.updated_data.Ville
                this.active_form = false
                document.getElementById('responseValue').innerHTML = data.message
                this.formsStatus = true
                setTimeout(() => {
                    this.formsStatus = false
                }, 3000)
                


            })
                
        },

        onDeleteReservationClick(event) {
            event.preventDefault();
            const currentDiv = event.target.closest('.reservationDisplay');
            const img = currentDiv.querySelector('.imgResa');
            const title = currentDiv.querySelector('h1');
            const subtitles = currentDiv.querySelectorAll('h3');


            const currentForm = event.target.closest('form');
            const url = currentForm.getAttribute('data-url');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                }
            })
            .then(response => {
                if (!response.ok) {
                    document.getElementById('responseValue').innerHTML = "Une erreur est survenue, veuillez recharger la page et reessayer."
                    throw new Error(`Erreur HTTP ! statut : ${response.status}`);
                }
                return response.json(); // Traiter la réponse comme JSON
            })
            .then(data => {
                currentDiv.querySelector('#actions').innerHTML = '<p class="text-lg text-gray-400 italic">Réservation annulée</p>'
                document.getElementById('responseValue').innerHTML = data.success
                this.formsStatus = true
                img.classList.remove('grayscale-0')
                img.classList.add('grayscale')
                title.classList.add('text-zinc-500', 'dark:text-zinc-300')
                subtitles.forEach(subtitle => subtitle.classList.add('text-zinc-500', 'dark:text-zinc-300'))
                currentDiv.querySelectorAll('.placesID').forEach(element => {
                    element.classList.add('text-zinc-400', 'dark:text-zinc-300', 'dark:bg-zinc-500')
                })
                currentDiv.querySelectorAll('.language').forEach(element => {
                    element.classList.add('text-zinc-500', 'dark:text-zinc-300', 'dark:bg-zinc-500', 'bg-zinc-300')
                })
                currentDiv.querySelector('.salleResa').classList.remove('bg-zinc-600')
                currentDiv.querySelector('.salleResa').classList.add('text-zinc-300', 'dark:text-zinc-300', 'dark:bg-zinc-500', 'bg-zinc-400')

                if (currentDiv.querySelector('.atmos')) {
                    currentDiv.querySelector('.atmos').classList.remove('fill-black', 'dark:fill-white')
                    currentDiv.querySelector('.atmos').classList.add('fill-zinc-500')
                }
                if (currentDiv.querySelector('.vision'))
                {
                    currentDiv.querySelector('.vision').classList.remove('fill-black', 'dark:fill-white')
                    currentDiv.querySelector('.vision').classList.add('fill-zinc-500')
                }
                currentDiv.querySelectorAll('.txt').forEach(element => {
                    element.classList.add('text-zinc-400', 'dark:text-zinc-300')
                })

                setTimeout(() => {
                    this.formsStatus = false
                }, 3000)
            })
        },

        onDeleteLineClick(event) {
            event.preventDefault();
            const currentDiv = event.target.closest('.reservationDisplay');
            const currentForm = event.target.closest('form');
            const url = currentForm.getAttribute('action');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP ! statut : ${response.status}`);
                }
                return response.json(); // Traiter la réponse comme JSON
            })
            .then(data => {
                if (data.success == 'Reservation supprimée avec succès !')
                {
                    document.getElementById('responseValue').innerHTML = data.success
                    currentDiv.remove()
                }else
                {
                    document.getElementById('responseValue').innerHTML = data.success
                    currentForm.remove()
                }
                this.formsStatus = true
                setTimeout(() => {
                    this.formsStatus = false
                }, 3000)
            })
        },

        loadMoreReservations() {
            
            const url = `/reservations/load-more?skip=${this.skip}`;

            

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.reservations)
                const container = document.getElementById('load-more-content');

                document.getElementById('loadMoreButton').innerHTML = '<div class="flex justify-center items-center p-1"><svg class="mt-1 dark:fill-white" width="25"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z"><animateTransform attributeName="transform" type="rotate" dur="1s" values="0 12 12;360 12 12" repeatCount="indefinite"/></path></svg></div>'

                setTimeout(() => {

                    if (data.reservations.length != 0) {
                        this.skip += 2
                        console.log(this.skip)
                    }
                    if (data.nbReservations <= this.skip) {
                        document.getElementById('loadMoreButton').remove()
                    }else
                    {
                        document.getElementById('loadMoreButton').innerHTML = `<a @click="loadMoreReservations()" class="flex justify-center font-medium items-center p-2 w-96 mx-auto rounded-md hover:bg-gray-100 dark:hover:bg-zinc-500 mb-4 hover:shadow-sm cursor-pointer transition-all ease-in-out duration-300 border border-zinc-50 hover:border-zinc-200 dark:border-zinc-700 dark:hover:border-zinc-400"><p class="dark:text-white" >Voir Plus</p></a>`
                    }

                    data.reservations.forEach(reservation => {
                        container.insertAdjacentHTML('beforeend', reservation);
                    })                    
                }, 400)
                
            }
                
            )
        },

        init() {
            const sideMenuAdapter = () => {
                if (window.innerWidth < 768) 
                    {
                        this.sideMenu = false
                    } 
                    else 
                    {
                        this.sideMenu = true
                    }
            }
            sideMenuAdapter()
            window.addEventListener('resize', sideMenuAdapter)
        }

    }))

});

Alpine.start();


// $(window).on('load', function () {
//     console.log('domOK');
//     initBanner();
// });









