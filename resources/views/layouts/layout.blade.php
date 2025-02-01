<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="relative no-transition w-full bg-zinc-950  overscroll-none solaris"
    x-data="{
        open : false, 
        dropdown : false,
        scrolled: false,
        loading : true,
        burgerMenu: false
    }"
    x-init="window.onload = () => loading = false; document.body.classList.remove('no-transition');"
    :class="open ? 'overflow-hidden' : 'overflow-auto'"
    >
    <header  
        class="transition-all ease-in-out duration-700 h-14 w-full z-30 fixed"
        x-init="$watch('scrolled', () => {if(scrolled) {document.querySelector('main').classList.add('min-h-screen') }})"
        :style="scrolled ? 'background : rgba(20,20,20,0.3); height : 3.5rem; backdrop-filter: blur(15px); padding-bottom: 2px' : 'background : linear-gradient(180deg,rgba(0, 0, 0, 0.3) 5%,rgba(0, 0, 0, 0) 100%)'"
        @scroll.window="scrolled = (window.scrollY > window.innerHeight/20)">
        <x-navbars.navbar background="'bg-transparent'" search="true"/>
        
    </header>
    <x-loading-screen/>
    <x-modals.search-modal class="transition-all ease-in-out duration-300 overflow-hidden min-h-full"/>




    {{-- <x-menus.bottom-navbar class="sm:hidden" :filmPage="View::getSection('title')"/> --}}

    

    <main class="bg-zinc-950">
        @yield('content')
    </main>
    
    <footer>
        <div class="flex flex-col justify-between w-full h-24 px-4 py-4 bg-zinc-950">
            <div class="w-full flex justify-center gap-4 pb-1">
                <a href="https://instagram.com/">
                    <svg class="fill-white" viewBox="0 0 256 256" width="44" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M128,84a44,44,0,1,0,44,44A44.04978,44.04978,0,0,0,128,84Zm0,80a36,36,0,1,1,36-36A36.04061,36.04061,0,0,1,128,164ZM172,32H84A52.059,52.059,0,0,0,32,84v88a52.059,52.059,0,0,0,52,52h88a52.059,52.059,0,0,0,52-52V84A52.059,52.059,0,0,0,172,32Zm44,140a44.04978,44.04978,0,0,1-44,44H84a44.04978,44.04978,0,0,1-44-44V84A44.04978,44.04978,0,0,1,84,40h88a44.04978,44.04978,0,0,1,44,44ZM188,76a8,8,0,1,1-8-8A8.00917,8.00917,0,0,1,188,76Z"></path> </g></svg>
                </a>
                
                <a href="https://facebook.com">
                    <svg class="fill-white" viewBox="0 0 256 256" width="44" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M228,128A100,100,0,1,0,127.98877,228l.01123.001.01123-.001A100.11345,100.11345,0,0,0,228,128Zm-96,91.90771V148.001h28a4,4,0,0,0,0-8H132v-28a20.02229,20.02229,0,0,1,20-20h16a4,4,0,0,0,0-8H152a28.03145,28.03145,0,0,0-28,28v28H96a4,4,0,0,0,0,8h28v71.90673a92,92,0,1,1,8,0Z"></path> </g></svg>
                </a>
                
                <a href="https://x.com">
                    <svg class="fill-white" viewBox="0 0 256 256" width="44" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M243.69531,70.46924A3.99949,3.99949,0,0,0,240,68l-32.79834-.00049a44.09747,44.09747,0,0,0-38.64307-23.99609A44.31838,44.31838,0,0,0,124,87.99951l-.00977,11.1709c-44.07861-9.38477-80.78418-45.62207-81.16308-46a4.00074,4.00074,0,0,0-6.7627,2.11426c-8.5205,46.86181,5.47461,78.11865,18.71534,96.08789a103.47267,103.47267,0,0,0,27.40136,25.87207C66.4668,197.58936,38.88574,208.14551,38.5957,208.25488a3.99983,3.99983,0,0,0-1.92382,5.96387c.26464.39746,2.78417,3.98145,9.53906,7.35889C54.73438,225.83936,66.10254,228,80,228c68.94678,0,126.47021-53.45166,131.624-121.96729l31.2041-31.2041A3.99939,3.99939,0,0,0,243.69531,70.46924Zm-38.78613,30.96484a4.00173,4.00173,0,0,0-1.16357,2.57422C199.60205,169.05029,145.24609,220,80,220c-17.8457,0-27.62695-3.88721-32.50391-6.8667,10.374-4.82812,31.45508-16.34863,43.832-34.91455a3.99941,3.99941,0,0,0-1.53906-5.79639c-.15136-.07568-15.293-7.77832-28.56885-25.79541-16.65429-22.602-22.84765-50.36084-18.4497-82.60156,12.792,11.31055,45.86767,37.46973,84.55761,43.91992a4,4,0,0,0,4.65821-3.94189L132,88.00635v-.00391a36.31979,36.31979,0,0,1,36.459-36,36.07711,36.07711,0,0,1,32.54688,21.59863,4.00012,4.00012,0,0,0,3.66553,2.39844L230.34326,76Z"></path> </g></svg>
                </a>
                
            </div>
        
            {{-- Copyright --}}
            <div class="w-full pb-4">
                <p class="text-neutral-50 text-[0.5rem] text-center">Copyright Nicolas Carpita 2025</p>
                <p class="text-neutral-50 text-[0.5rem] text-center" >Movies datas provided by The Movie Database</p>
            </div>
        </div>
    </footer>
</body>
</html>