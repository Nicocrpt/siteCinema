import './bootstrap';

import Alpine from 'alpinejs';

import $, { data, event } from 'jquery';

//Faker.js
import { faker } from '@faker-js/faker';
//FullCalendar
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin, { Draggable } from '@fullcalendar/interaction';
import frLocale from '@fullcalendar/core/locales/fr';



//Owl Carousel
import 'owl.carousel'
import 'owl.carousel/dist/assets/owl.carousel.css'; // Importer le CSS d'Owl Carousel
import 'owl.carousel/dist/assets/owl.theme.default.css'; // Importer le thème par défaut d'Owl Carousel



window.Alpine = Alpine;
window.$ =window.jQuery = $;






document.addEventListener('alpine:init', () => {

    Alpine.data('seanceManager', () => ({
        detailView: false,
        salle : "all",
        calendar: null,

        init() {
            const alpineContext = this;


            document.addEventListener('DOMContentLoaded', function () {

                alpineContext.queryMovies();

                const draggable = new Draggable(document.getElementById('filmsContainer'), {
                    itemSelector: '.draggableElement.active',
                    eventData: function (eventEl) {
                        const ref = faker.string.numeric(8)
                        const language = eventEl.getAttribute('data-language') == "1" ? " (VF)" : " (VO)"
                        let salleId;
                        switch (eventEl.getAttribute('datacolor')) {
                            case '#ef4444':
                                salleId = 1
                                break;
                            case '#22c55e':
                                salleId = 2
                                break;
                            case '#0ea5e9':
                                salleId = 3
                                break;  
                        }
                        return {
                            title: eventEl.getAttribute('data-title') + language,
                            duration: eventEl.getAttribute('data-duration'),
                            color: eventEl.getAttribute('datacolor'),
                            extendedProps: {
                                id : parseInt(eventEl.getAttribute('data-id')),
                                ref : ref,
                                salle : salleId,
                                langue : parseInt(eventEl.getAttribute('data-language'))
                            }
                        };
                    }
                });

                const calendarEl = document.getElementById('calendar');

                
                alpineContext.calendar = new Calendar(calendarEl, {
                    locale: 'FR-fr',
                    firstDay: 3,
                    timezone: 'UTC',
                    eventOverlap: false,
                    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                    initialView: 'timeGridWeek', // Vue initiale
                    slotDuration: '00:15:00',
                    allDaySlot: false,
                    headerToolbar: {
                        left: 'prev,next today', // Boutons de navigation
                        center: 'title', // Titre du calendrier
                        right: 'dayGridMonth,timeGridWeek,timeGridDay', // Boutons pour changer de vue
                    },
                    buttonText: {
                        today:    'Aujourd\'hui',    // Personnaliser "today"
                        month:    'Mois',            // Personnaliser "month"
                        week:     'Semaine',         // Personnaliser "week"
                        day:      'Jour',            // Personnaliser "day"
                        list:     'Liste',           // Personnaliser "list"
                    },
                    events: function(info, successCallback, failureCallback) {
                        const start = new Date(info.startStr); 
                        const end = new Date(info.endStr);
                        // Formatage des dates au format ISO sans le fuseau horaire
                        const startFormatted = start.toISOString().split('.')[0]; // Supprime la partie millisecondes et fuseau horaire
                        const endFormatted = end.toISOString().split('.')[0];
                        const url = `/admin/seances/get-seances?salle=${alpineContext.salle}&start=${startFormatted}&end=${endFormatted}`
                        console.log(url)
                        fetch(url)
                            .then(response => response.json())
                            .then(events => {
                                successCallback(events)
                            })
                            .catch(error => failureCallback(error));

                    },              // Permet de faire glisser et de modifier des événements
                    selectable: true, // Permet de déplacer les événements
                    droppable: true,
                    editable: true, // Permet de déposer des événements externes
                    slotMinTime: '09:00:00', // Heure de début
                    slotMaxTime: '25:00:00', // Heure de fin
                    eventReceive: function(info) {
                        const existingEvents = alpineContext.calendar.getEvents().filter(e => 
                            e.title === info.event.title && e.startStr === info.event.startStr
                        );
                    
                        if (existingEvents.length > 1) {
                            info.event.remove();  // Supprime l'événement en double
                        }

                        fetch('/admin/seances/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                film: info.event.extendedProps.id,
                                datetime_seance: info.event.start,
                                salle: parseInt(info.event.extendedProps.salle),
                                reference: info.event.extendedProps.ref,
                                langue: parseInt(info.event.extendedProps.langue)
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Événement ajouté avec succès:', data);
                            //info.event.setExtendedProp('id', data.id); // Mettre à jour l'ID depuis la réponse serveur
                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'ajout:', error);
                            info.revert();  // Annule le drop en cas d'échec
                        });
                    },
                    eventDrop: function(info) {
                        fetch('/admin/seances/update', {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                reference: info.event.extendedProps.reference,
                                datetime_seance: info.event.start,
                            })
                        })
                        .then(response => response.json())
                    }
                });
        
                alpineContext.calendar.render();


                window.addEventListener('resize', function () {
                    console.log(alpineContext.calendar)
                    if (alpineContext.calendar) {
                        alpineContext.calendar.refetchEvents(); // Recharger l'affichage
                    }
                })

                document.getElementById('language').addEventListener('change', function() {
                    document.querySelectorAll('.draggableElement').forEach((film) => {
                        let child = film.querySelector('p')
                       if (document.getElementById('language').checked) {
                           film.setAttribute('data-language', 0);
                           child.textContent = child.textContent.replace(' (VF)', ' (VO)');
                       }else{
                           film.setAttribute('data-language', 1);
                           child.textContent = child.textContent.replace(' (VO)', ' (VF)');
                       }           
                    })
                })
            });

            
        },

        queryMovies() {
            const language = document.getElementById('language')

            let url = "/admin/seances/get-films"
            url += '?filter=' + encodeURIComponent(filmFilter.value)
            url += '&query=' + encodeURIComponent(filmQuery.value)

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
            .then(films => {
                let filmContainer = document.getElementById('filmsContainer')
                filmContainer.innerHTML = ''
                films.forEach(film => {
                    let heures = Math.floor((parseInt(film.duree)+30) / 60);
                    let minutes = (parseInt(film.duree)+30) % 60;
                    minutes = minutes.toString().padStart(2, '0');
                    filmContainer.innerHTML += `
                        <div class="p-4 flex justify-between items-center ${films.indexOf(film)%2 == 0 ? 'bg-zinc-100 dark:bg-zinc-600 hover:bg-sky-100 dark:hover:bg-zinc-500' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-sky-100 dark:hover:bg-zinc-500'}" id="${film.id}">
                            <div class="px-2 py-1 bg-zinc-600 dark:bg-zinc-900 rounded flex gap-1 draggableElement max-w-[67%]" style="cursor: grab" data-title="${film.titre}" data-language="1" data-duration="${heures}:${minutes}:00" data-id="${film.id}">
                                <svg width="14" class="fill-white" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M600 1440c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240ZM600 720c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240ZM600 0c132.36 0 240 107.64 240 240S732.36 480 600 480 360 372.36 360 240 467.64 0 600 0Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240S1187.64 0 1320 0Z" fill-rule="evenodd"></path> </g></svg>
                                <p class="text-white truncate ...">${film.titre} ${language.checked ? ' (VO)' : ' (VF)'}</p>
                            </div>

                            <div class="flex gap-4 justify-between items-center">
                                <p class="dark:text-white cursor-default pl-4">${heures}h${minutes}</p>
                                <svg @click="injectMovieInfos(${film.id})" width="26" viewBox="0 0 24 24" class="group cursor-pointer" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 18.5C12.5523 18.5 13 18.0523 13 17.5L13 10.5C13 9.94772 12.5523 9.5 12 9.5C11.4477 9.5 11 9.94772 11 10.5L11 17.5C11 18.0523 11.4477 18.5 12 18.5Z" class="dark:fill-zinc-200 dark:group-hover:fill-white fill-zinc-700 group-hover:fill-black"></path> <path d="M12 8.5C12.8284 8.5 13.5 7.82843 13.5 7C13.5 6.17157 12.8284 5.5 12 5.5C11.1716 5.5 10.5 6.17157 10.5 7C10.5 7.82843 11.1716 8.5 12 8.5Z" class="dark:fill-zinc-200 dark:group-hover:fill-white fill-zinc-700 group-hover:fill-black"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M1 12C1 18.0751 5.92487 23 12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1C5.92487 1 1 5.92487 1 12ZM12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z" class="dark:fill-zinc-200 dark:group-hover:fill-white fill-zinc-700 group-hover:fill-black"></path> </g></svg>
                            </div>
                        </div>
                    `
                });
                this.changeDraggableItemColorByRoom(this.salle)
            })

        },
        filterEventsByRoom(room) {

            this.salle = room
            this.changeDraggableItemColorByRoom(room)
            this.calendar.removeAllEvents();
            this.calendar.refetchEvents();
        },
        changeDraggableItemColorByRoom(room){
            console.log("ntm")
            document.querySelectorAll('.draggableElement').forEach((film) => {
                switch(room){
                    case '1':
                        film.classList.remove('hover:bg-sky-500', 'dark:hover:bg-sky-500', 'hover:bg-green-500', 'salle2', 'salle3', 'pointer-events-none', 'cursor-default')
                        film.classList.add('dark:hover:bg-red-500', 'hover:bg-red-500', 'dark:bg-zinc-900', 'salle1', 'active')
                        film.setAttribute('datacolor', '#ef4444');
                        break;
                    case '2':
                        console.log("ntm2")
                        console.log(film)
                        film.classList.remove('hover:bg-sky-500','dark:hover:bg-sky-500', 'hover:bg-red-500','dark:hover:bg-red-500', 'salle1', 'salle3', 'dark:bg-zinc-500', 'pointer-events-none', 'cursor-default')
                        film.classList.add('hover:bg-green-500', 'dark:bg-zinc-900', 'salle2', 'active')
                        film.setAttribute('datacolor', '#22c55e');
                        break;
                    case '3':
                        film.classList.remove('hover:bg-green-500', 'hover:bg-red-500','dark:hover:bg-red-500', 'salle1', 'salle2', 'dark:bg-zinc-500', 'pointer-events-none', 'cursor-default')
                        film.classList.add('hover:bg-sky-500','dark:hover:bg-sky-500', 'dark:bg-zinc-900', 'salle3', 'active')
                        film.setAttribute('datacolor', '#0ea5e9');
                        break;
                    case 'all':
                        film.classList.remove('hover:bg-sky-500','dark:hover:bg-sky-500', 'hover:bg-green-500', 'hover:bg-red-700', 'active')
                        film.classList.add('pointer-events-none', 'cursor-default')
                        break;
                }
            })
        },

        injectMovieInfos(id) {
            this.detailView = true
            const film = films.find(film => film.id == id)
            let div = document.getElementById('filmDetails')
            const heures = Math.floor(film.duree / 60);
            let minutes = film.duree % 60;
            minutes = minutes.toString().padStart(2, '0');
            div.innerHTML = `
                <div class="flex justify-between items-center w-full min-h-14 pl-4 pr-6 py-2 mb-4 dark:bg-zinc-800 bg-[rgb(238,238,240)] border-b dark:border-zinc-500 border-[rgb(220,220,225)]">
                    <button @click="detailView = false" class="hover:bg-zinc-300 hover:border-zinc-300 dark:hover:bg-zinc-500 p-1 rounded transition-all ease-in-out duration-200">
                        <svg width="32" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z" class="dark:fill-white fill-black"></path> </g></svg>
                    </button>
                    <h1 class="font-semibold dark:text-white text-lg max-w-[80%]">${film.titre}</h1>
                </div>
                <div class="w-full px-4 flex gap-4 mb-4">
                    <img src="${film.url_affiche}" alt="" class="w-[50%] rounded border dark:border-zinc-500 border-zinc-800"/>
                    <div class="w-auto flex flex-col gap-2">
                        <div>
                            <p class="dark:text-white"><span class="font-semibold">Durée : </span>${heures}h${minutes}</p>
                        </div>
                        <div>
                            <p class=" dark:text-white"><span class="font-semibold">Certification : </span>${film.certification.valeur}</p> 
                        </div>
                    </div>
                </div>
                
                
                
                
            `
        }


    }))


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
                document.getElementById('fidelityCount').innerHTML = data.content.fidelity
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









