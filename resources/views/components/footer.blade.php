<div {{ $attributes->merge(['class' => "flex flex-col justify-between w-full h-24 px-4 py-2 "]) }}>

    {{-- A propos/Infos Pratiques--}}
    {{-- <div class="pb-2 flex justify-around px-2">
        <div>
            <h3 class="text-neutral-50 text-sm font-semibold mb-1">A propos</h3>
            <ul class="text-neutral-50 text-xs gap-1 flex flex-col ">
                <li>Mentions légales</li>
                <li>Notre histoire</li>
                <li>Politique de confidentialité</li>
            </ul> 
        </div>

    </div> --}}

    {{-- Liens réseaux sociaux --}}
    <div class="w-full flex justify-center gap-4 pb-1">
        <a href="https://instagram.com/">
            <svg class="dark:fill-white fill-black" viewBox="0 0 256 256" width="44" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M128,84a44,44,0,1,0,44,44A44.04978,44.04978,0,0,0,128,84Zm0,80a36,36,0,1,1,36-36A36.04061,36.04061,0,0,1,128,164ZM172,32H84A52.059,52.059,0,0,0,32,84v88a52.059,52.059,0,0,0,52,52h88a52.059,52.059,0,0,0,52-52V84A52.059,52.059,0,0,0,172,32Zm44,140a44.04978,44.04978,0,0,1-44,44H84a44.04978,44.04978,0,0,1-44-44V84A44.04978,44.04978,0,0,1,84,40h88a44.04978,44.04978,0,0,1,44,44ZM188,76a8,8,0,1,1-8-8A8.00917,8.00917,0,0,1,188,76Z"></path> </g></svg>
        </a>
        
        <a href="https://facebook.com">
            <svg class="dark:fill-white fill-black" viewBox="0 0 256 256" width="44" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M228,128A100,100,0,1,0,127.98877,228l.01123.001.01123-.001A100.11345,100.11345,0,0,0,228,128Zm-96,91.90771V148.001h28a4,4,0,0,0,0-8H132v-28a20.02229,20.02229,0,0,1,20-20h16a4,4,0,0,0,0-8H152a28.03145,28.03145,0,0,0-28,28v28H96a4,4,0,0,0,0,8h28v71.90673a92,92,0,1,1,8,0Z"></path> </g></svg>
        </a>
        
        <a href="https://bsky.app" class="flex justify-center items-center">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="44" class="stroke-black dark:stroke-white"  viewBox="0 0 24 24"  fill="none"  stroke-width="0.7"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-bluesky"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.335 5.144c-1.654 -1.199 -4.335 -2.127 -4.335 .826c0 .59 .35 4.953 .556 5.661c.713 2.463 3.13 2.75 5.444 2.369c-4.045 .665 -4.889 3.208 -2.667 5.41c1.03 1.018 1.913 1.59 2.667 1.59c2 0 3.134 -2.769 3.5 -3.5c.333 -.667 .5 -1.167 .5 -1.5c0 .333 .167 .833 .5 1.5c.366 .731 1.5 3.5 3.5 3.5c.754 0 1.637 -.571 2.667 -1.59c2.222 -2.203 1.378 -4.746 -2.667 -5.41c2.314 .38 4.73 .094 5.444 -2.369c.206 -.708 .556 -5.072 .556 -5.661c0 -2.953 -2.68 -2.025 -4.335 -.826c-2.293 1.662 -4.76 5.048 -5.665 6.856c-.905 -1.808 -3.372 -5.194 -5.665 -6.856z" /></svg>
        </a>
        
    </div>

    {{-- Copyright --}}
    <div class="w-full">
        <p class="dark:text-neutral-50 text-[0.5rem] text-center">Copyright Nicolas Carpita 2025</p>
        <p class="dark:text-neutral-50 text-[0.5rem] text-center" >Movies datas provided by The Movie Database</p>
    </div>
</div>