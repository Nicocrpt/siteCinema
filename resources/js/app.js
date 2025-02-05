import './bootstrap';

import Alpine from 'alpinejs';

import Swiper from 'swiper/bundle';
import { Pagination } from 'swiper/modules';



//FullCalendar
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin, { Draggable } from '@fullcalendar/interaction';





window.Alpine = Alpine;







document.addEventListener('alpine:init', () => {


    Alpine.data('seanceManager', () => ({
        detailView: false,
        seanceOverview: false,
        salle : "all",
        calendar: null,
        films: movies,

        init() {
            const alpineContext = this;


            document.addEventListener('DOMContentLoaded', function () {

                alpineContext.queryMovies();

                const draggable = new Draggable(document.getElementById('filmsContainer'), {
                    itemSelector: '.draggableElement.active',
                    eventData: function (eventEl) {
                        const ref = alpineContext.generateNumeric(8)
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
                                filmId : parseInt(eventEl.getAttribute('data-id')),
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
                                film: info.event.extendedProps.filmId,
                                datetime_seance: info.event.start,
                                salle: parseInt(info.event.extendedProps.salle),
                                reference: info.event.extendedProps.ref,
                                langue: parseInt(info.event.extendedProps.langue)
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            alpineContext.queryMovies()
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
                    },
                    eventClick: function(info) {
                        const film = alpineContext.films.find(film => film.id == info.event.extendedProps.filmId);
                        const start = new Date(info.event.start)
                        const end = new Date(info.event.end)
                        const totalMinutes = end.getHours() * 60 + end.getMinutes()
                        start.setMinutes(start.getMinutes() + totalMinutes);
                        alpineContext.seanceOverview = true
                        let container = document.getElementById('overviewContainer')
                        container.innerHTML = `
                        <div class="h-full flex flex-col gap-1 md:col-span-2 items-center justify-between" @click.away="seanceOverview = false">
                            <div class="flex text-lg gap-4 justify-start items-center w-full">
                                <img src="${film.url_affiche}" class="w-24 h-36 rounded border border-zinc-400">
                                <div class="flex flex-col justify-between h-full w-full gap-2">
                                    <div>
                                        <p class="pb-1"><span class="font-semibold">${film.titre}</span></p>
                                        <div class="flex gap-1">
                                            <p class="${info.event.extendedProps.salle == 1 ? 'bg-red-500 border-red-600' : info.event.extendedProps.salle == 2 ? 'bg-green-500 border-green-600' : 'bg-sky-500 border-sky-600' } w-fit text-white p-1 rounded text-sm box-border border">Salle ${info.event.extendedProps.salle}</p>
                                            <p class="text-sm rounded p-1 px-2 bg-zinc-900 text-white">${info.event.title.replace(film.titre + " (", '').replace(")", '')}</p>
                                            <div class="p-1 px-[0.3rem] -pb-[0.1rem] bg-zinc-500 rounded">
                                                <svg class="fill-white w-[20px]" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Dolby icon</title><path d="M24,20.352V3.648H0v16.704H24z M18.433,5.806h2.736v12.387h-2.736c-2.839,0-5.214-2.767-5.214-6.194S15.594,5.806,18.433,5.806z M2.831,5.806h2.736c2.839,0,5.214,2.767,5.214,6.194s-2.374,6.194-5.214,6.194H2.831V5.806z"></path></g></svg>
                                            </div>
                                            <div class="bg-zinc-400 flex items-center rounded pr-1">
                                                <svg class="fill-white w-[18px]" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M 16.5156 49.5742 L 39.2734 49.5742 C 41.6640 49.5742 43.0937 48.2617 43.0937 45.7305 L 43.0937 45.1211 C 43.1172 38.6523 36.2266 33.4023 33.2031 30.5430 C 32.3593 29.7461 31.9140 29.0196 31.9140 27.9649 C 31.9140 26.9102 32.3593 26.2071 33.2031 25.3867 C 36.2031 22.4805 43.0937 17.5586 43.0937 10.8320 L 43.0937 10.2696 C 43.0937 7.7383 41.6640 6.4258 39.2734 6.4258 L 16.5156 6.4258 C 14.1718 6.4258 12.8828 7.7383 12.8828 10.0586 L 12.8828 10.8320 C 12.8828 17.5586 19.7734 22.4805 22.7969 25.3867 C 23.6406 26.2071 24.0859 26.9102 24.0859 27.9649 C 24.0859 29.0196 23.6406 29.7461 22.7969 30.5430 C 19.7734 33.4023 12.8828 38.6523 12.8828 45.1211 L 12.8828 45.9414 C 12.8828 48.2617 14.1718 49.5742 16.5156 49.5742 Z M 18.9531 46.3633 C 17.8281 46.3633 17.4766 45.1211 18.5781 44.3008 L 26.5937 38.3242 C 26.8515 38.1133 26.9922 37.9727 26.9922 37.6211 L 26.9922 26.3477 C 26.9922 25.0820 26.7344 24.4492 25.8437 23.6992 C 24.5078 22.5742 21.9766 20.7930 20.8281 19.1758 C 20.3593 18.5196 20.4062 17.9805 20.9922 17.9805 L 34.9844 17.9805 C 35.5703 17.9805 35.6172 18.5196 35.1484 19.1758 C 34.0000 20.7930 31.4922 22.5742 30.1328 23.6992 C 29.2422 24.4492 28.9844 25.0820 28.9844 26.3477 L 28.9844 37.6211 C 28.9844 37.9727 29.125 38.1133 29.3828 38.3242 L 37.4218 44.3008 C 38.5234 45.1211 38.1484 46.3633 37.0469 46.3633 Z"></path></g></svg>
                                                <p class="text-white text-sm">${Math.floor((parseInt(film.duree)+30) / 60)}h${(parseInt(film.duree)+30) % 60}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <p class="text-sm"><span class="font-semibold">Séance : </span>Le ${new Date(info.event.start).toLocaleString('fr-FR', { day: 'numeric', month: 'numeric', year: 'numeric'})} à ${new Date(info.event.start).toLocaleTimeString('fr-FR', { hour: 'numeric', minute: 'numeric' })}</p>
                                        <p class="text-sm"><span class="font-semibold text-zinc-800">${info.event.extendedProps.nbPlaces}/${info.event.extendedProps.salle == 1 ? '280' : info.event.extendedProps.salle == 2 ? '162' : '112'}</span> Places réservées</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end items-center w-full">
                                <button class="text-sm  ${info.event.extendedProps.nbPlaces > 0 ? 'bg-zinc-200 border-zinc-300 pointer-events-none': 'bg-zinc-800 border-black hover:bg-red-600'}  border  px-2 py-1 text-white rounded transition-color ease-linear duration-100">
                                    Annuler la séance
                                </button>
                            </div>
                        </div>
                        `
                    }
                });
        
                alpineContext.calendar.render();


                window.addEventListener('resize', function () {
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

                document.querySelector('.fc-next-button').addEventListener('click', function(e) {
                    if (alpineContext.detailView) {
                        alpineContext.injectMovieInfos(document.getElementById('filmDetails').getAttribute('data-id'))
                    }
                })
    
                document.querySelector('.fc-prev-button').addEventListener('click', function(e) {
                    if (alpineContext.detailView) {
                        alpineContext.injectMovieInfos(document.getElementById('filmDetails').getAttribute('data-id'))
                    }
                })
            });

        },

        injectMovieInfos(id) {
            const startDate = this.calendar.view.currentStart
            const startDateStr = startDate.toLocaleString('fr-FR', { timeZone: 'Europe/Paris' }).split(' ')[0].split('/').slice(0,2).join('/')
            const endDate = this.calendar.view.currentEnd
            const endDateStr = endDate.toISOString().split('T')[0].split('-').reverse().slice(0,2).join('/')
            const daysOfWeek = ['Mer.', 'Jeu.', 'Ven.', 'Sam.', 'Dim.', 'Lun.', 'Mar.']
            this.detailView = true
            const film = this.films.find(film => film.id == id)
            let div = document.getElementById('filmDetails')
            div.setAttribute('data-id', film.id)
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
                    <img src="${film.url_affiche}" alt="" class="w-[40%] rounded border dark:border-zinc-500 border-zinc-800"/>
                    <div class="w-auto flex flex-col gap-2">
                        <div>
                            <p class="dark:text-white"><span class="font-semibold">Durée : </span>${heures}h${minutes}</p>
                        </div>
                        <div>
                            <p class=" dark:text-white"><span class="font-semibold">Certification : </span>${film.certification.valeur}</p> 
                        </div>
                        <div>
                            <p class=" dark:text-white"><span class="font-semibold">Nombre de séances : </span>${Object.keys(film.seances).length}</p> 
                        </div>
                        <div>
                            <p class=" dark:text-white"><span class="font-semibold">Genres : </span>${film.genres.map(genre => genre.nom).join(', ')}</p> 
                        </div>
                    </div>
                </div>
                <p class="dark:text-white mx-4 mt-1 mb-2 font-semibold">Séances programmées du ${startDateStr} au ${endDateStr} :</p>
            `
            let seancesList = document.createElement('div')
            seancesList.className = 'max-h-[calc(100vh-33.5rem)] mx-4 overflow-y-scroll dark:bg-zinc-500 rounded border dark:border-zinc-300 border-zinc-300 bg-zinc-100 dark:border-zinc-400 shadow-inner'
            daysOfWeek.forEach(day => {
                let dayDate = new Date(startDate)
                dayDate.setDate(dayDate.getDate() + daysOfWeek.indexOf(day))
                let month = String(dayDate.getMonth() + 1).padStart(2, '0')
                let dayNumeric = String(dayDate.getDate()).padStart(2, '0')
                seancesList.innerHTML += `
                    <div class="flex gap-2 justify-start p-[0.68rem] items-center border-b border-zinc-300/20 w-full min-h-10 ${daysOfWeek.indexOf(day) % 2 == 0 ? 'bg-zinc-100 dark:bg-zinc-600/60' : 'bg-zinc-50 dark:bg-zinc-500'} ${day.replace('.', '')}">
                        <div class="flex w-[5.95rem] justify-between">
                            <p class="dark:text-zinc-200 text-zinc-600 font-semibold">${day}</p>
                            <p class="dark:text-white text-black font-semibold">${dayNumeric}/${month} :</p>
                        </div>
                    </div>
                `
                div.appendChild(seancesList)
                film.seances.forEach(seance => {
                    console.log(seance.film_id, film.id)
                    if (seance.datetime_seance.split(' ')[0] == dayDate.toISOString().split('T')[0] && seance.film_id == film.id) {
                        let dayDiv = document.querySelector('.' + day.replace('.', ''))
                        //console.log(dayDiv)
                        let divHoraire = document.createElement('p')
                        divHoraire.className = 'p-1 border dark:border-zinc-500 border-zinc-500 bg-zinc-600 dark:bg-zinc-900 text-white rounded'
                        divHoraire.innerHTML = `${seance.datetime_seance.split(' ')[1].split(':').slice(0, 2).join(':')}`
                        dayDiv.appendChild(divHoraire)
                    }
                })
            })
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
                this.films = films
                let filmContainer = document.getElementById('filmsContainer')
                filmContainer.innerHTML = ''
                films.forEach(film => {
                    let heures = Math.floor((parseInt(film.duree)+30) / 60);
                    let minutes = (parseInt(film.duree)+30) % 60;
                    minutes = minutes.toString().padStart(2, '0');
                    filmContainer.innerHTML += `
                        <div class="p-4 flex justify-between items-center ${films.indexOf(film)%2 == 0 ? 'bg-zinc-50 dark:bg-zinc-600 hover:bg-sky-100 dark:hover:bg-zinc-500' : 'bg-zinc-100 dark:bg-zinc-700 hover:bg-sky-100 dark:hover:bg-zinc-500'}" id="${film.id}">
                            <div class="px-2 py-1 bg-zinc-600 dark:bg-zinc-900 rounded flex gap-1 draggableElement max-w-[67%]" style="cursor: grab" data-title="${film.titre}" data-language="1" data-duration="${heures}:${minutes}:00" data-id="${film.id}">
                                <svg class="fill-white !w-[14px] shrink-0" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M600 1440c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240ZM600 720c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240 107.64-240 240-240ZM600 0c132.36 0 240 107.64 240 240S732.36 480 600 480 360 372.36 360 240 467.64 0 600 0Zm720 0c132.36 0 240 107.64 240 240s-107.64 240-240 240-240-107.64-240-240S1187.64 0 1320 0Z" fill-rule="evenodd"></path> </g></svg>
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
            document.querySelectorAll('.draggableElement').forEach((film) => {
                switch(room){
                    case '1':
                        film.classList.remove('hover:bg-sky-500', 'dark:hover:bg-sky-500', 'hover:bg-green-500', 'salle2', 'salle3', 'pointer-events-none', 'cursor-default')
                        film.classList.add('dark:hover:bg-red-500', 'hover:bg-red-500', 'dark:bg-zinc-900', 'salle1', 'active')
                        film.setAttribute('datacolor', '#ef4444');
                        break;
                    case '2':
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

        generateNumeric (length) {
            let result = '';
            const characters = '0123456789';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
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
            console.log('init')
            const swiper = new Swiper('.swiper', {
                loop: true,
                speed: 2000,
                parallax: true,
                autoplay: {
                    delay: 8000,
                    disableOnInteraction: true,
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
                modules: [Pagination ],
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true,
                },
                resizeReInit: true,
                on: {
                    slideChangeTransitionStart: function () {
                        let activeSlide = document.querySelector(".swiper-slide-active");
            
                        // Supprime et réajoute la classe uniquement à la slide active
                        activeSlide.classList.add("parallax-active");
                        void activeSlide.offsetWidth; // Trick pour forcer le recalcul CSS
                    }
                }
            });
            document.querySelector(".swiper-slide-active").classList.add("parallax-active");
            console.log('init2')
            window.addEventListener('resize', function () {
                swiper.update();
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
                        button.classList.add('bg-zinc-200')
                        button.classList.add('text-zinc-400')
                        document.getElementById('plusET').classList.remove('bg-cyan-500')
                        document.getElementById('plusET').classList.add('bg-zinc-200')
                        document.getElementById('plusET').classList.add('text-zinc-400')
                        if (document.getElementById('priceET').value == 0) {
                            let other = document.getElementById('plusET')
                            other.classList.remove('bg-cyan-500')
                            other.classList.add('bg-zinc-200')
                            other.setAttribute('disabled', 'true')
                            document.getElementById('minusET').setAttribute('disabled', 'true')
                            document.getElementById('minusET').classList.add('bg-zinc-200')
                            document.getElementById('minusET').classList.add('text-zinc-400')
                            document.getElementById('minusET').classList.remove('bg-zinc-300')
                            document.getElementById('priceET').classList.add('text-zinc-200')
                            document.getElementById('priceET').setAttribute('disabled', 'true')
                            document.getElementById('labelET').classList.add('text-zinc-200')
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
                    document.getElementById('plusSTD').classList.remove('bg-zinc-300')
                    document.getElementById('plusSTD').classList.add('bg-cyan-500')
                    document.getElementById('plusSTD').classList.remove('text-zinc-400')

                    document.getElementById('plusET').classList.add('bg-cyan-500')
                    document.getElementById('plusET').classList.remove('bg-zinc-200')
                    document.getElementById('plusET').classList.remove('text-zinc-400')
                    document.getElementById('plusET').removeAttribute('disabled')
                    document.getElementById('minusET').removeAttribute('disabled')
                    document.getElementById('minusET').classList.remove('bg-zinc-200')
                    document.getElementById('minusET').classList.remove('text-zinc-400')
                    document.getElementById('minusET').classList.add('bg-zinc-300')
                    document.getElementById('priceET').classList.remove('text-zinc-200')
                    document.getElementById('priceET').removeAttribute('disabled')
                    document.getElementById('labelET').classList.remove('text-zinc-200')
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
                        button.classList.add('bg-zinc-200')
                        button.classList.add('text-zinc-400')
                        document.getElementById('plusSTD').classList.add('bg-zinc-200')
                        document.getElementById('plusSTD').classList.remove('bg-zinc-300')
                        document.getElementById('plusSTD').classList.remove('bg-cyan-500')
                        document.getElementById('plusSTD').classList.add('text-zinc-400')
                        if (document.getElementById('priceSTD').value == 0) {
                            let other = document.getElementById('plusSTD')
                            other.classList.remove('bg-cyan-500')
                            other.classList.add('bg-zinc-200')
                            other.setAttribute('disabled', 'true')
                            document.getElementById('minusSTD').setAttribute('disabled', 'true')
                            document.getElementById('minusSTD').classList.add('bg-zinc-200')
                            document.getElementById('minusSTD').classList.add('text-zinc-400')
                            document.getElementById('minusSTD').classList.remove('bg-zinc-300')
                            document.getElementById('priceSTD').classList.add('text-zinc-200')
                            document.getElementById('priceSTD').setAttribute('disabled', 'true')
                            document.getElementById('labelSTD').classList.add('text-zinc-200')
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
                    document.getElementById('plusET').classList.remove('bg-zinc-300')
                    document.getElementById('plusET').classList.add('bg-cyan-500')
                    document.getElementById('plusET').classList.remove('text-zinc-400')

                    document.getElementById('plusSTD').classList.add('bg-cyan-500')
                    document.getElementById('plusSTD').classList.remove('bg-zinc-200')
                    document.getElementById('plusSTD').classList.remove('text-zinc-400')
                    document.getElementById('plusSTD').removeAttribute('disabled')
                    document.getElementById('minusSTD').removeAttribute('disabled')
                    document.getElementById('minusSTD').classList.remove('bg-zinc-200')
                    document.getElementById('minusSTD').classList.remove('text-zinc-400')
                    document.getElementById('minusSTD').classList.add('bg-zinc-300')
                    document.getElementById('priceSTD').classList.remove('text-zinc-200')
                    document.getElementById('priceSTD').removeAttribute('disabled')
                    document.getElementById('labelSTD').classList.remove('text-zinc-200')
                }
            }
            console.log(this.totalArray)
            
        }
    }))

    Alpine.data('filmShow', () => ({
        contentFilm: false, 
        scrollState: 0, 
        maxSize: 11.5, 
        minSize: 11.5, 
        scrollLimit: 50,
        isSmallScreen: window.innerWidth < 768,
        is2xlScreen: window.innerWidth >= 1280,
        fullscreenImage: false,
        translation: 0,

        init() {
            window.addEventListener('resize', () => {
                this.isSmallScreen = window.innerWidth < 768 
                console.log(this.isSmallScreen)
                this.is2xlScreen = window.innerWidth >= 1280
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
                currentDiv.querySelector('#actions').innerHTML = '<p class="text-lg text-zinc-400 italic">Réservation annulée</p>'
                document.getElementById('responseValue').innerHTML = data.success
                document.getElementById('fidelityCount').innerHTML = data.content.fidelity
                this.formsStatus = true
                img.classList.remove('zincscale-0')
                img.classList.add('zincscale')
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
                        document.getElementById('loadMoreButton').innerHTML = `<a @click="loadMoreReservations()" class="flex justify-center font-medium items-center p-2 w-96 mx-auto rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-500 mb-4 hover:shadow-sm cursor-pointer transition-all ease-in-out duration-300 border border-zinc-50 hover:border-zinc-200 dark:border-zinc-700 dark:hover:border-zinc-400"><p class="dark:text-white" >Voir Plus</p></a>`
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

    Alpine.data('seancesPage', () => ({
        container : document.getElementById('dateContainer'),
        today: new Date(),
        firstDate : new Date(),
        lastDate : null,
        activeDay : new Date().toISOString(),
        translation : 0,
        translateValue : null,
        dateItems : null,
        films : films_php,
        seancesContainer : document.getElementById('seancesContainer'),

        init() {
            this.setupMediaQueries()
            this.setOnLoadCarousel(this.activeDay)
        },

        setupMediaQueries() {
            const queries = [
                { query: "(max-width: 399px)", value: 4, translate: 16 },
                { query: "(min-width: 400px) and (max-width: 529px)", value: 4, translate: 20 },
                { query: "(min-width: 530px) and (max-width: 639px)", value: 7, translate: 28 },
                { query: "(min-width: 640px)", value: 7, translate: 35 }
            ];
    
            queries.forEach(q => {
                let mediaQuery = window.matchMedia(q.query);
                mediaQuery.addEventListener("change", (e) => {
                    console.log(this.firstDate)
                    if (e.matches) {

                        if (e.media == "(min-width: 640px)" || e.media == "(min-width: 530px) and (max-width: 639px)"){
                            this.injectRequiredSeances(this.activeDay.split('T')[0])
                        }
                        
                        
                        this.dateItems = q.value;
                        this.translateValue = q.translate;

                        let active = document.querySelector('.activeDay').parentElement
                        let index = Array.from(active.parentElement.children).indexOf(active)

                        let count = this.dateItems
                        this.translation = 0
                        this.firstDate = new Date(this.today)

                        while (index > count) {
                            this.translation -= this.translateValue
                            this.firstDate = new Date(this.firstDate.setDate(this.firstDate.getDate() + this.dateItems))
                            count += this.dateItems

                        }
                    }
                });
    
                if (mediaQuery.matches) {
                    this.dateItems = q.value;
                    this.translateValue = q.translate;
                }
            });
        },

        setOnLoadCarousel(dateToDisplay) {
            this.lastDate = new Date(this.today)
            this.lastDate.setDate(this.lastDate.getDate() + 27)
            console.log(this.lastDate)

            for (let i = 0; i < 28; i++) {
                const date = new Date(this.today)
                date.setDate(date.getDate() + i) 
                this.container.appendChild(this.insertNewDate(date))
            }

            this.injectRequiredSeances(dateToDisplay.split('T')[0])
        },

        prev(){
            this.translation += this.translateValue
            this.firstDate = new Date(this.firstDate.setDate(this.firstDate.getDate() - this.dateItems))
        },

        next(){
            this.translation -= this.translateValue
            this.firstDate = new Date(this.firstDate.setDate(this.firstDate.getDate() + this.dateItems))
            if (this.lastDate.getTime()/86400000 - this.firstDate.getTime()/86400000 <= 7) {
                console.log(this.lastDate.getTime()/86400000 - this.firstDate.getTime()/86400000)
                for (let i = 1; i < 29; i++) {
                    const date = new Date(this.lastDate)
                    date.setDate(date.getDate() + i)
                    this.container.appendChild(this.insertNewDate(date))
                }
                this.lastDate = new Date(this.lastDate.setDate(this.lastDate.getDate() + 28))
            } 
        },

        insertNewDate(date) {
            const formatedDate = date.toISOString().split('T')[0].split('-').reverse().splice(0,2).join('/')
            const dayName = date.toLocaleString('fr-FR', { weekday: 'long' })
            let dateDiv = document.createElement('div')
            dateDiv.className = " h-full w-16 xxs:w-20 shrink-0 xs:w-16 sm:w-20 dateDiv flex justify-center items-center transition-none"
            dateDiv.innerHTML = `
                <div @click="activeDay = '${date.toISOString()}'; injectRequiredSeances(activeDay.split('T')[0])" class=" py-1 px-2 xxs:px-4 xs:px-2 sm:px-4 rounded-lg flex flex-col justify-center items-center border border-zinc-100 dark:border-zinc-800 transition-color ease-in-out duration-200 cursor-pointer dayDiv" :class="activeDay == '${date.toISOString()}' ? 'bg-zinc-800 dark:bg-zinc-200 activeDay' : 'dark:bg-zinc-800/70 bg-zinc-200/60 hover:bg-zinc-300/60 dark:hover:bg-zinc-700/80'">
                    <p class=" -mt-1 text-sm" :class="activeDay == '${date.toISOString()}' ? 'text-white dark:text-black' : 'dark:text-white'">${dayName.substring(0,3) + '.'}</p>
                    <p class="pt-1 text-sm" :class="activeDay == '${date.toISOString()}' ? 'text-white dark:text-black' : 'dark:text-white'">${formatedDate}</p>
                </div>
            `
            return dateDiv
        },

        // injectRequiredSeances(date) {
        //     this.seancesContainer.innerHTML = ''
        //     let globalCount = 0
        //     this.films.forEach(film => {
        //         let count = 0
        //         let seances = []
        //         film.seances.forEach(seance => {
        //             if (seance.datetime_seance.split(' ')[0] == date.split('T')[0]) {
        //                 count ++
        //                 let seanceP = document.createElement('p')
        //                 seanceP.innerHTML += `                                
        //                     <a href="/seances/${seance.reference}">
        //                         <div class="flex justify-center items-center w-fit rounded-sm bg-zinc-200 hover:bg-zinc-300 dark:bg-zinc-500 dark:hover:bg-zinc-400 py-1 px-1 gap-2 transition-all ease-in-out duration-200 group border border-zinc-300 dark:border-zinc-400/50">
        //                             <p class="dark:text-white">${seance.datetime_seance.split(' ')[1].split(':').splice(0,2).join(':')}</p>
        //                             ${seance.vf == 1 ? '<p class="text-sm bg-zinc-700 text-white rounded px-1 dark:group-hover:bg-zinc-500 transition-all ease-in-out duration-200" title="Francais">VF</p>' : '<p class="bg-zinc-900 text-white rounded px-1 text-sm">VO</p>'}
        //                             ${seance.dolby_vision || seance.dolby_atmos ? 
        //                                 `<div class="p-1 px-[0.3rem] -pb-[0.1rem] bg-zinc-500 rounded">
        //                                     <svg class="fill-white w-[12px]" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Dolby icon</title><path d="M24,20.352V3.648H0v16.704H24z M18.433,5.806h2.736v12.387h-2.736c-2.839,0-5.214-2.767-5.214-6.194S15.594,5.806,18.433,5.806z M2.831,5.806h2.736c2.839,0,5.214,2.767,5.214,6.194s-2.374,6.194-5.214,6.194H2.831V5.806z"></path></g></svg>
        //                                 </div>` 
        //                             : ''}
        //                         </div>
        //                     </a>
        //                 `
        //                 seances.push(seanceP)
        //             }
        //         })
        //         if (count > 0) {
        //             globalCount ++
        //             let filmDiv = document.createElement('div')
        //             filmDiv.className = "pb-10 mt-10 border-b-2 border-zinc-400/60 flex flex-col w-full"

        //             let infosDiv = document.createElement('div')
        //             infosDiv.className = "flex flex gap-2 xl:gap-4 w-full h-[9rem] sm:h-72"
        //             infosDiv.innerHTML = `
        //                     <a href="/films/${film.slug}" class="h-full shrink-0">
        //                         <img src="${film.url_affiche}" alt="" class="h-full rounded border border-zinc-400 dark:border-zinc-400/40 shrink-0">
        //                     </a>
        //             `
        //             let content = document.createElement('div')
        //             content.className = "flex flex-col"
        //             content.innerHTML = `
        //                 <p class="font-semibold dark:text-white text-xl sm:text-3xl">${film.titre}<span class="text-sm font-normal text-zinc-600 dark:text-zinc-400 pl-2">${Math.floor(parseInt(film.duree) / 60)}h${(parseInt(film.duree) % 60).toString().padStart(2, '0')}</span></p>
        //                 <div class="mt-2 flex flex-col gap-1">
        //                     <p class="dark:text-white max-sm:text-sm">Réalisateur(s) : <span class="font-light">${film.realisateurs.map(realisateur => realisateur.nom).join(', ')}</span></p>
        //                     <p class="dark:text-white max-sm:text-sm max-sm:line-clamp-1">Avec : <span class="font-light">${film.acteurs.map(acteur => acteur.nom).join(', ')}</span></p>
        //                     <p class="dark:text-white max-sm:text-sm">Genre(s) : <span class="font-light">${film.genres.map(genre => genre.nom).join(', ')}</span></p>
        //                 </div>
        //             `
        //             if (window.innerWidth >= 640) {
        //                 content.innerHTML += `
        //                     <div class="border-b-2 dark:border-zinc-700 mt-6 mb-2 xl:w-[32rem]"/>
        //                 `
        //             }

        //             let hoursContent = document.createElement('div')
        //             hoursContent.className = "flex gap-2"

        //             seances.forEach(seanceP => {
        //                 hoursContent.appendChild(seanceP)
        //             })

        //             infosDiv.appendChild(content)
                    
        //             if (window.innerWidth >= 640) {
        //                 content.appendChild(hoursContent)
        //                 filmDiv.appendChild(infosDiv)
        //             } else {
        //                 filmDiv.appendChild(infosDiv)
        //                 filmDiv.innerHTML += '<div class="border-b-2 dark:border-zinc-700 mt-2 mb-2 w-[90%]"/>'
        //                 filmDiv.appendChild(hoursContent)
        //             }

        //             this.seancesContainer.appendChild(filmDiv)
        //         }
        //     })

        //     if (globalCount == 0) {
        //         this.seancesContainer.innerHTML = `
        //         <div class="h-[calc(100vh-200px)] w-full flex gap-2 justify-center items-center">
        //             <svg viewBox="0 0 24 24" class="w-14 h-14 stroke-zinc-400" xmlns="http://www.w3.org/2000/svg" aria-labelledby="sadFaceIconTitle" stroke="#000000" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title id="sadFaceIconTitle">sad Face</title> <line stroke-linecap="round" x1="9" y1="9" x2="9" y2="9"></line> <line stroke-linecap="round" x1="15" y1="9" x2="15" y2="9"></line> <path d="M8,16 C9.33333333,15.3333333 10.6656028,15.0003822 11.9968085,15.0011466 C13.3322695,15.0003822 14.6666667,15.3333333 16,16"></path> <circle cx="12" cy="12" r="10"></circle> </g></svg>
        //             <div class="w-fit">
        //                 <p class="text-zinc-400 text-xl w-fit">Aucune seance programmée pour l'instant !</p>
        //                 <p class="text-zinc-400 w-fit">Veuillez choisir une autre date ou revenir plus tard.</p>
        //             </div>
        //         </div>
        //         `
        //     }

        //     window.scrollTo({
        //         top: 0,
        //         behavior: 'smooth' // Pour un effet fluide
        //     });
        // },

        injectRequiredSeances(date) {
            this.seancesContainer.classList.remove('opacity-100')
            this.seancesContainer.classList.add('opacity-0')
            setTimeout(() => {
                this.seancesContainer.innerHTML = ''
            }, 200)
            console.log(date)
            const url = '/seances/get-seances-by-date' + '?date=' + encodeURIComponent(date)
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                setTimeout(() => {
                    if (data.length == 0) {
                        console.log("pas de seances")
                        this.seancesContainer.innerHTML = `
                        <div class="h-fit mt-10 md:mt-16 w-full mx-auto">
                            <div class="flex gap-2 items-center justify-center w-fit mx-auto max-w-[95%]">
                                <svg viewBox="0 0 24 24" class="w-14 h-14 stroke-zinc-400 shrink-0" xmlns="http://www.w3.org/2000/svg" aria-labelledby="sadFaceIconTitle" stroke="#000000" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title id="sadFaceIconTitle">sad Face</title> <line stroke-linecap="round" x1="9" y1="9" x2="9" y2="9"></line> <line stroke-linecap="round" x1="15" y1="9" x2="15" y2="9"></line> <path d="M8,16 C9.33333333,15.3333333 10.6656028,15.0003822 11.9968085,15.0011466 C13.3322695,15.0003822 14.6666667,15.3333333 16,16"></path> <circle cx="12" cy="12" r="10"></circle> </g></svg>
                                <div class="w-fit">
                                    <p class="text-zinc-400 text-xl w-fit">Aucune seance programmée pour l'instant !</p>
                                    <p class="text-zinc-400 w-fit">Veuillez choisir une autre date ou revenir plus tard.</p>
                                </div>
                            </div>
                        </div>
                        `
                    } else {
                        data.forEach(film => {
                            let seances = []
                            film.seances.forEach(seance => {
                                if (seance.datetime_seance.split(' ')[0] == date.split('T')[0]) {
                                    let seanceP = document.createElement('p')
                                    seanceP.innerHTML += `                                
                                        <a href="/seance/${seance.reference}">
                                            <div class="flex justify-center items-center w-fit rounded-sm bg-zinc-200 hover:bg-zinc-300 dark:bg-zinc-500 dark:hover:bg-zinc-400 py-1 px-1 gap-2 transition-all ease-in-out duration-200 group border border-zinc-300 dark:border-zinc-400/50">
                                                <p class="dark:text-white">${seance.datetime_seance.split(' ')[1].split(':').splice(0,2).join(':')}</p>
                                                ${seance.vf == 1 ? '<p class="text-sm bg-zinc-700 text-white rounded px-1 dark:group-hover:bg-zinc-500 transition-all ease-in-out duration-200" title="Francais">VF</p>' : '<p class="bg-zinc-900 text-white rounded px-1 text-sm">VO</p>'}
                                                ${seance.dolby_vision || seance.dolby_atmos ? 
                                                    `<div class="p-1 px-[0.3rem] -pb-[0.1rem] bg-zinc-500 rounded">
                                                        <svg class="fill-white w-[12px]" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Dolby icon</title><path d="M24,20.352V3.648H0v16.704H24z M18.433,5.806h2.736v12.387h-2.736c-2.839,0-5.214-2.767-5.214-6.194S15.594,5.806,18.433,5.806z M2.831,5.806h2.736c2.839,0,5.214,2.767,5.214,6.194s-2.374,6.194-5.214,6.194H2.831V5.806z"></path></g></svg>
                                                    </div>` 
                                                : ''}
                                            </div>
                                        </a>
                                    `
                                    seances.push(seanceP)
                                }
                            })
    
                            let filmDiv = document.createElement('div')
                            filmDiv.className = "pb-10 mt-10 border-b-2 border-zinc-400/60 flex flex-col w-full"
    
                            let infosDiv = document.createElement('div')
                            infosDiv.className = "flex flex gap-2 xl:gap-4 w-full h-[9rem] sm:h-72"
                            infosDiv.innerHTML = `
                                    <a href="/film/${film.slug}" class="h-full shrink-0">
                                        <img src="${film.url_affiche}" alt="" class="h-full rounded border border-zinc-400 dark:border-zinc-400/40 shrink-0">
                                    </a>
                            `
                            
                            let content = document.createElement('div')
                            content.className = "flex flex-col"
                            content.innerHTML = `
                                <p class="font-semibold dark:text-white text-xl sm:text-3xl">${film.titre}<span class="text-sm font-normal text-zinc-600 dark:text-zinc-400 pl-2">${Math.floor(parseInt(film.duree) / 60)}h${(parseInt(film.duree) % 60).toString().padStart(2, '0')}</span></p>
                                <div class="mt-2 flex flex-col gap-1">
                                    <p class="dark:text-white max-sm:text-sm max-sm:line-clamp-1">Réalisateur(s) : <span class="font-light">${film.realisateurs.map(realisateur => realisateur.nom).join(', ')}</span></p>
                                    <p class="dark:text-white max-sm:text-sm max-sm:line-clamp-1">Avec : <span class="font-light">${film.acteurs.map(acteur => acteur.nom).join(', ')}</span></p>
                                    <p class="dark:text-white max-sm:text-sm">Genre(s) : <span class="font-light">${film.genres.map(genre => genre.nom).join(', ')}</span></p>
                                </div>
                            `
                            
                            if (window.innerWidth >= 640) {
                                content.innerHTML += `
                                    <div class="border-b-2 dark:border-zinc-700 mt-6 mb-2 xl:w-[32rem]"/>
                                `
                            }
    
                            let hoursContent = document.createElement('div')
                            hoursContent.className = "flex gap-2"
    
                            seances.forEach(seanceP => {
                                hoursContent.appendChild(seanceP)
                            })
    
                            infosDiv.appendChild(content)
                            
                            if (window.innerWidth >= 640) {
                                content.appendChild(hoursContent)
                                filmDiv.appendChild(infosDiv)
                            } else {
                                filmDiv.appendChild(infosDiv)
                                filmDiv.innerHTML += '<div class="border-b-2 dark:border-zinc-700/40 mt-2 mb-2 w-full"/>'
                                filmDiv.appendChild(hoursContent)
                            }
    
                            this.seancesContainer.appendChild(filmDiv) 
                        })     
                    }  
                    this.seancesContainer.classList.remove('opacity-0')
                    this.seancesContainer.classList.add('opacity-100') 
                },200)
      
            })

            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Pour un effet fluide
            });
        }

    }))

    Alpine.data('filmsPage', () => ({
        forthComing : false,
        availableContainer: document.getElementById('availableContainer'),
        forthcomingContainer : document.getElementById('forthcomingContainer'),


        init() { 
            this.getFilteredFilms()
            window.addEventListener('resize', () => {
                this.adaptBody(this.availableContainer)
            })
        },


        getFilteredFilms() {            

            const url = `/films/get-films?name=${encodeURIComponent(document.getElementById('nameQuery').value)}&genre=${encodeURIComponent(document.getElementById('genreQuery').value)}`
            console.log(url)
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                this.availableContainer.innerHTML = ''
                this.forthcomingContainer.innerHTML = ''
                document.getElementById('availableCount').innerHTML = data.availableFilms.length
                document.getElementById('forthcomingCount').innerHTML = data.forthcomingFilms.length
                if (data.availableFilms.length == 0) {
                    this.availableContainer.innerHTML = `
                        <div class="h-fit mt-10 md:mt-16 w-full mx-auto">
                            <div class="flex gap-2 items-center justify-center w-fit mx-auto max-w-[90%]">
                                <svg viewBox="0 0 24 24" class="w-14 h-14 stroke-zinc-400 shrink-0" xmlns="http://www.w3.org/2000/svg" aria-labelledby="sadFaceIconTitle" stroke="#000000" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title id="sadFaceIconTitle">sad Face</title> <line stroke-linecap="round" x1="9" y1="9" x2="9" y2="9"></line> <line stroke-linecap="round" x1="15" y1="9" x2="15" y2="9"></line> <path d="M8,16 C9.33333333,15.3333333 10.6656028,15.0003822 11.9968085,15.0011466 C13.3322695,15.0003822 14.6666667,15.3333333 16,16"></path> <circle cx="12" cy="12" r="10"></circle> </g></svg>
                                <div class="w-fit">
                                    <p class="text-zinc-400 text-xl w-fit">Aucun film trouvé !</p>
                                    <p class="text-zinc-400 w-fit">Veuillez effectuer une autre rechercher ou rééssayer plus tard.</p>
                                </div>
                            </div>
                        </div>
                    `
                }
                data.availableFilms.forEach(film => {
                    
                    this.availableContainer.innerHTML += `
                        <div class="flex items-center justify-center max-w-[49%] xs:max-w-[32.4%] sm:max-w-[24.25%] lg:max-w-[19%] relative group mb-2 sm:mb-[0.35rem] md:mb-2 z-1 border dark:border-zinc-600" >
                            <a href="/film/${film.slug}"><img src="${film.url_affiche}" alt="" class="transition-all ease-in-out duration-300"></a>
                            <div class="w-full h-full absolute top-0 left-0 bg-black bg-opacity-50 backdrop-blur-[1px] flex flex-col justify-center items-center p-2 px-4 opacity-0 group-hover:opacity-100 transition-opacity ease-in-out duration-500 pointer-events-none gap-1"> 
                                <p class="w-full text-white text-center font-semibold text-lg mb-4">${film.titre}</p>
                                <!-- <div class="w-full flex flex-col gap-2">
                                    <p class=" text-white text-start line-clamp-2">Réalisateur(s) : <span class="font-light">${film.realisateurs.map(realisateur => realisateur.nom).join(', ')}</span></p>
                                    <p class=" text-white text-start line-clamp-2">Avec : <span class="font-light">${film.acteurs.map(acteur => acteur.nom).join(', ')}</span></p>
                                    <p class=" text-white text-start line-clamp-2">Genre(s) : <span class="font-light">${film.genres.map(genre => genre.nom).join(', ')}</span></p>
                                </div> -->
                            </div>
                        </div>
                    `
                })

                if (data.forthcomingFilms.length == 0) {
                    this.forthcomingContainer.innerHTML = `
                        <div class="h-fit mt-10 md:mt-16 w-full mx-auto">
                            <div class="flex gap-2 items-center justify-center w-fit mx-auto max-w-[90%]">
                                <svg viewBox="0 0 24 24" class="w-14 h-14 stroke-zinc-400 shrink-0" xmlns="http://www.w3.org/2000/svg" aria-labelledby="sadFaceIconTitle" stroke="#000000" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title id="sadFaceIconTitle">sad Face</title> <line stroke-linecap="round" x1="9" y1="9" x2="9" y2="9"></line> <line stroke-linecap="round" x1="15" y1="9" x2="15" y2="9"></line> <path d="M8,16 C9.33333333,15.3333333 10.6656028,15.0003822 11.9968085,15.0011466 C13.3322695,15.0003822 14.6666667,15.3333333 16,16"></path> <circle cx="12" cy="12" r="10"></circle> </g></svg>
                                <div class="w-fit">
                                    <p class="text-zinc-400 text-xl w-fit">Aucun film trouvé !</p>
                                    <p class="text-zinc-400 w-fit">Veuillez effectuer une autre rechercher ou rééssayer plus tard.</p>
                                </div>
                            </div>
                        </div>
                    `
                }
                data.forthcomingFilms.forEach(film => {
                    this.forthcomingContainer.innerHTML += `
                        <div class="flex items-center justify-center max-w-[49%] xs:max-w-[32.4%] sm:max-w-[24.25%] lg:max-w-[19%] relative group mb-2 sm:mb-[0.35rem] md:mb-2 z-1 border dark:border-zinc-600" >
                            <a href="/film/${film.slug}"><img src="${film.url_affiche}" alt="" class=" rounded  dark:border-neutral-600 shadom-md transition-all ease-in-out duration-300"></a>
                            <div class="w-full h-full absolute top-0 left-0 bg-black bg-opacity-50 backdrop-blur-[1px] flex flex-col justify-center items-center p-2 px-4 opacity-0 group-hover:opacity-100 transition-opacity ease-in-out duration-500 pointer-events-none gap-1"> 
                                <p class="w-full text-white text-center font-semibold text-lg mb-4">${film.titre}</p>
                                <!-- <div class="w-full flex flex-col gap-2">
                                    <p class=" text-white text-start line-clamp-2">Réalisateur(s) : <span class="font-light">${film.realisateurs.map(realisateur => realisateur.nom).join(', ')}</span></p>
                                    <p class=" text-white text-start line-clamp-2">Avec : <span class="font-light">${film.acteurs.map(acteur => acteur.nom).join(', ')}</span></p>
                                    <p class=" text-white text-start line-clamp-2">Genre(s) : <span class="font-light">${film.genres.map(genre => genre.nom).join(', ')}</span></p>
                                </div> -->
                            </div>
                        </div>
                    `
                })

                this.forthComing ? this.adaptBody(this.forthcomingContainer) : this.adaptBody(this.availableContainer)
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // Pour un effet fluide
                });
            })

        },

        adaptBody(container) {
            setTimeout(() => {
                let heightToApply = container.clientHeight
                document.getElementById('filmsContainer').style.height = heightToApply + 'px'
            },500)

        }

    }))


});

Alpine.start();









