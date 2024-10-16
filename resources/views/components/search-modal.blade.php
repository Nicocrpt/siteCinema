<div class="absolute bg-stone-950 bg-opacity-95 !top-0 !left-0 transition-all ease-in-out duration-300"  style="width: 100%; height: 100%; z-index: 9999; backdrop-filter: blur(15px);" x-show="open" x-transition:enter="transition ease-out duration-300" 
x-transition:enter-start="opacity-0 " 
x-transition:enter-end="opacity-100" 
x-transition:leave="transition ease-in duration-300" 
x-transition:leave-start="opacity-100" 
x-transition:leave-end="opacity-0">
    <div class="w-full h-full relative flex justify-center">
        <button @click="open = false" class="absolute top-5 right-5 text-white rounded-full font-bold hover:bg-slate-200 hover:bg-opacity-20 transition-all ease-in-out duration-300 p-2"><svg class="h-6 w-6 hover:opacity-90 opacity-70 font-bold" fill="white" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512.481 421.906L850.682 84.621c25.023-24.964 65.545-24.917 90.51.105s24.917 65.545-.105 90.51L603.03 512.377 940.94 850c25.003 24.984 25.017 65.507.033 90.51s-65.507 25.017-90.51.033L512.397 602.764 174.215 940.03c-25.023 24.964-65.545 24.917-90.51-.105s-24.917-65.545.105-90.51l338.038-337.122L84.14 174.872c-25.003-24.984-25.017-65.507-.033-90.51s65.507-25.017 90.51-.033L512.48 421.906z"></path></g></svg></button>

        

        <div class="mt-72 flex flex-col items-center">
            <h1 class="text-3xl font-bold text-white mb-24">Que souhaitez vous voir ?</h1>
            <form action="" class="flex justify-center gap-2">
            
                <input type="text" class=" bg-white bg-opacity-20 border-none rounded-xl  text-2xl p-2 pl-4 pr-4 w-96 text-white focus:outline-none h-12">
                <button class="text-2xl  rounded-xl font-bold bg-cyan-600 hover:bg-cyan-500 transition-all ease-in-out duration-300"><svg class="h-12 w-12 p-2 text-stone-200 hover:opacity-90 opacity-70" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>
                
            </form>
        </div>
        
    </div>
    <div >
        
        
    </div>
    
</div>