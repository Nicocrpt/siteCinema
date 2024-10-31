<div x-show="guestModal" x-data="{translate: 0}" class="absolute h-screen w-screen flex justify-center items-center left-0 top-0 bg-black bg-opacity-50 backdrop-blur z-50"
x-transition:enter="transition-all ease-in-out duration-300"
x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
x-transition:leave="transition-all ease-in-out duration-300"
x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div @click.away="guestModal = false" class="overflow-hidden w-[95%] max-w-[700px] h-1/2 bg-gray-50 dark:bg-zinc-900 rounded-md shadow-lg flex flex-col justify-center gap-2 items-center z-50">
        <div class="w-full max-w-[500px] flex flex-col gap-2 justify-center items-center overflow-hidden">
            <h1 class="text-2xl dark:text-white font-semibold">Vous n'êtes pas connecté</h1>
            <div class="flex transition-all ease-in-out duration-300 w-full rounded-lg" :style="translate ? `transform: translateX(-${translate}%)` : ``">
                <button @click="translate = 100" class=" w-full h-12 flex-shrink-0 bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 rounded-md transition-all ease-in-out duration-300" x-transition:enter="transition-all ease-in-out duration-500" x-transition:enter-start="opacity-100" x-transition:enter-end="opacity-0" x-transition:leave="transition-all ease-in-out duration-500" x-transition:leave-start="opacity-0" x-transition:leave-end="opacity-100">Réserver en tant qu'invité</button>
                <div class="w-full flex-shrink-0 flex flex-col gap-2 z-50 px-4">
                    <input id="enteredEmail" class="h-12 w-full bg-white bg-opacity-20 border-none rounded text-2xl p-2 pl-4 pr-4 text-white focus:outline-none" placeholder="Votre email">
                    <button @click="document.getElementById('email').value = document.getElementById('enteredEmail').value ; document.getElementById('reservationForm').submit()" class="h-12 w-full bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 rounded-md transition-all ease-in-out duration-300">Je réserve !</button>
                </div>
            </div>
        </div>
        
        
    </div>
</div>