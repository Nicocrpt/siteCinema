<div {{ $attributes->merge(['class' => 'block md:hidden']) }} x-data="{ burgerMenu: false }">
    <div class="md:hidden flex items-center gap-4">
        <svg @click="burgerMenu = !burgerMenu" class="w-[50px] h-[50px] md:w-10 md:h-10 p-1 rounded-md  cursor-pointer transition-all ease-in-out duration-300" fill="#ffffff" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>icn/menu</title><path d="M2 3h12a1 1 0 0 1 0 2H2a1 1 0 1 1 0-2zm0 4h12a1 1 0 0 1 0 2H2a1 1 0 1 1 0-2zm0 4h12a1 1 0 0 1 0 2H2a1 1 0 0 1 0-2z" id="a"></path></g></svg>
    </div>
    <div x-show="burgerMenu" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-[92%] backdrop-blur-md z-40"
        x-transition:enter="transform ease-in-out duration-300" x-transition:enter-start="translate-x-[-100%]" x-transition:enter-end="translate-x-0" x-transition:leave="transform ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-[-100%]">
        <div class="w-full h-full relative">
            <button class="absolute top-5 right-5" @click="burgerMenu = false" x-show="burgerMenu" x-transition:enter="transition transform ease-in-out duration-[420ms] delay-100"
            x-transition:enter-start="opacity-0 rotate-90"
            x-transition:enter-end="opacity-100 rotate-0"
            x-transition:leave="transition transform ease-in-out duration-300"
            x-transition:leave-start="opacity-100 rotate-0" x-transition:leave-end="opacity-0 rotate-90">
                <svg viewBox="0 0 24 24" width="70" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z" fill="#ffffff"></path> </g></svg>
            </button>

            <div class="mx-28 pt-40">
                <ul class="text-white text-6xl flex flex-col gap-12">
                    <x-animated-li href="{{route('index')}}" content="Accueil" show="burgerMenu" delay="delay-[125ms]"/>
                    <x-animated-li href="{{route('films.index')}}" content="Films" show="burgerMenu" delay="delay-[150ms]"/>
                    <x-animated-li href="{{route('seances.index')}}" content="Seances" show="burgerMenu" delay="delay-[200ms]"/>
                    <x-animated-li href="" content="A propos" show="burgerMenu" delay="delay-[250ms]"/>
                    <x-animated-li href="{{route('home')}}" content="Mon compte" show="burgerMenu" delay="delay-[325ms]"/>
                    
                </ul>
            </div>
        </div>
    </div>

</div>