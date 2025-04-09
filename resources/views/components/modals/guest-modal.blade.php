<div x-show="guestModal" x-data="{translate: 100}" class="absolute h-screen w-screen flex justify-center items-center left-0 top-0 bg-black bg-opacity-50 backdrop-blur z-50"
x-transition:enter="transition-all ease-in-out duration-300"
x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
x-transition:leave="transition-all ease-in-out duration-300"
x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div @click.away="guestModal = false; setTimeout(function() {translate = 100}, 300)" class="overflow-hidden max-w-[95%] w-fit mx-auto bg-gray-50 dark:bg-zinc-900 rounded-md shadow-lg flex flex-col justify-center gap-4 items-center z-50 py-4">
        <div class="w-full max-w-[500px] flex flex-col gap-4 justify-center items-center overflow-hidden transition-all ease-in-out duration-300">
            <h1 class="text-2xl dark:text-white font-semibold">Vous n'êtes pas connecté</h1>
            <div class="flex transition-all ease-in-out duration-300 w-full rounded-lg" :style="translate ? `transform: translateX(-${translate}%);` : ``">
                <div class="w-full flex-shrink-0 flex flex-col gap-2 z-50 px-4 transition-all ease-in-out duration-500" :style="translate == 0 ? `max-height: 500px` : 'max-height: 0px'" :class="translate == 0 ? 'scale-y-[100%] opacity-100' : 'scale-y-[70%] opacity-0' ">
                    <x-auth.register-form id="registerForm" :clickAction="'$event.preventDefault(); translate = 200'"/>
                </div>
                <div class="w-full h-parent justify-center flex-shrink-0 flex flex-col gap-4 z-50 px-4" x-transition:enter="transition-all ease-in-out duration-500" x-transition:enter-start="opacity-100" x-transition:enter-end="opacity-0" x-transition:leave="transition-all ease-in-out duration-500" x-transition:leave-start="opacity-0" x-transition:leave-end="opacity-100">
                    <button @click="translate = 200" class=" w-full h-12 flex-shrink-0 bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 rounded-md transition-all ease-in-out duration-300 flex justify-center items-center"><span>Me connecter</span></button>
                    <button @click="translate = 0" class="w-full h-12 flex-shrink-0 flex justify-center items-center bg-cyan-700 hover:bg-cyan-600 text-white py-2 px-4 border-l border-l-cyan-900 rounded-md transition-all ease-in-out duration-300"><p>M'inscrire</p></button>
                </div>
                
                <div class="w-full flex-shrink-0 flex flex-col gap-2 z-50 px-4 transition-all ease-in-out duration-500" :style="translate == 200 ? `max-height: 300px` : 'max-height: 0px'" :class="translate == 200 ? 'scale-y-[100%] opacity-100' : 'scale-y-[70%] opacity-0' ">
                    <x-auth.login-form :clickAction="'$event.preventDefault(); translate = 0'"/>
                </div>
            </div>
        </div>
        
        
    </div>
</div>