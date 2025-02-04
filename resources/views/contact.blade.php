@extends('layouts.layoutNavigation')
@section('title' , 'Contact')
@section('content')
<div class="h-full bg-zinc-100 dark:bg-zinc-900 w-full">
    <section class="min-h-[calc(100vh-144px)] bg-zinc-50 dark:bg-zinc-800 mx-2 rounded px-2 pt-[128px] flex justify-center">
        <div class="w-[60rem]">
            <h1 class="text-3xl font-semibold dark:text-white mb-4">Où sommes nous ?</h1>
            <p class="dark:text-white">Le Solaris se trouve en plein cœur de la ville de Saint-Roustan, à coté de la salle polyvalente Nadine Rosignac.</p>
            <div class="">
                <img src="{{ asset('storage/assets/solarisPlan.jpg') }}" alt="" class="mt-6 mb-12 w-full">
            </div>
            <h1 class="text-3xl font-semibold dark:text-white mb-4">Nous contacter</h1>
            <p class="dark:text-white">Pour toute question, remarque ou demande spécifique, vous pouvez nous contacter par mail (cinema@solaris.fr) ou directement via le formulaire ci-dessous :</p>

            <form action="" class="my-6 flex flex-col gap-4 w-full mb-20">
                <div class="flex gap-4 w-full">                    
                    <input name="prenom" placeholder="Prénom" type="text" class="dark:bg-zinc-700 dark:text-white rounded w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500">
                    <input name="nom" placeholder="Nom" type="text" class="dark:bg-zinc-700 dark:text-white rounded w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500"">
                </div>
                <input type="text" name="email" placeholder="Email" class="dark:bg-zinc-700 dark:text-white rounded w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500">
                <textarea name="message" id="" placeholder="Ecrivez votre message..." class="dark:bg-zinc-700 dark:text-white rounded min-h-64 max-h-64 w-full placeholder:text-zinc-300 placeholder:dark:text-zinc-500"></textarea>


                <div class="w-full flex justify-end items-center">
                    <button type="submit" class="bg-zinc-900 hover:bg-zinc-800 text-white py-2 px-4 rounded">Envoyer</button>
                </div>
                
            </form>

            {{-- <p class="dark:text-white">Vous pouvez également nous retrouver sur nos réseaux sociaux :</p>
            <div class="w-full flex justify-start gap-8 mt-4 my-24">
                <a href="https://instagram.com/" class="flex flex-col items-center justify-center">
                    <svg class="dark:fill-neutral-300 dark:hover:fill-neutral-50 fill-zinc-700 hover:fill-zinc-950 transition-colors ease-in-out duration-100" viewBox="0 0 256 256" width="72" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M128,84a44,44,0,1,0,44,44A44.04978,44.04978,0,0,0,128,84Zm0,80a36,36,0,1,1,36-36A36.04061,36.04061,0,0,1,128,164ZM172,32H84A52.059,52.059,0,0,0,32,84v88a52.059,52.059,0,0,0,52,52h88a52.059,52.059,0,0,0,52-52V84A52.059,52.059,0,0,0,172,32Zm44,140a44.04978,44.04978,0,0,1-44,44H84a44.04978,44.04978,0,0,1-44-44V84A44.04978,44.04978,0,0,1,84,40h88a44.04978,44.04978,0,0,1,44,44ZM188,76a8,8,0,1,1-8-8A8.00917,8.00917,0,0,1,188,76Z"></path> </g></svg>
                    <p class="text-sm font-light -mt-2">Instagram</p>
                </a>
                
                <a href="https://facebook.com" class="flex flex-col items-center justify-center">
                    <svg class="dark:fill-neutral-300 dark:hover:fill-neutral-50 fill-zinc-700 hover:fill-zinc-950 transition-colors ease-in-out duration-100" viewBox="0 0 256 256" width="72" id="Flat" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M228,128A100,100,0,1,0,127.98877,228l.01123.001.01123-.001A100.11345,100.11345,0,0,0,228,128Zm-96,91.90771V148.001h28a4,4,0,0,0,0-8H132v-28a20.02229,20.02229,0,0,1,20-20h16a4,4,0,0,0,0-8H152a28.03145,28.03145,0,0,0-28,28v28H96a4,4,0,0,0,0,8h28v71.90673a92,92,0,1,1,8,0Z"></path> </g></svg>
                    <p class="text-sm font-light -mt-2">Facebook</p>
                </a>
                
                <a href="https://bsky.app" class="flex flex-col justify-center items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="72" class="stroke-zinc-700 hover:stroke-zinc-950 dark:stroke-neutral-300 dark:hover:stroke-neutral-50 transition-colors ease-in-out duration-100"  viewBox="0 0 24 24"  fill="none"  stroke-width="0.7"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-bluesky"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.335 5.144c-1.654 -1.199 -4.335 -2.127 -4.335 .826c0 .59 .35 4.953 .556 5.661c.713 2.463 3.13 2.75 5.444 2.369c-4.045 .665 -4.889 3.208 -2.667 5.41c1.03 1.018 1.913 1.59 2.667 1.59c2 0 3.134 -2.769 3.5 -3.5c.333 -.667 .5 -1.167 .5 -1.5c0 .333 .167 .833 .5 1.5c.366 .731 1.5 3.5 3.5 3.5c.754 0 1.637 -.571 2.667 -1.59c2.222 -2.203 1.378 -4.746 -2.667 -5.41c2.314 .38 4.73 .094 5.444 -2.369c.206 -.708 .556 -5.072 .556 -5.661c0 -2.953 -2.68 -2.025 -4.335 -.826c-2.293 1.662 -4.76 5.048 -5.665 6.856c-.905 -1.808 -3.372 -5.194 -5.665 -6.856z" /></svg>
                    <p class="text-sm font-light -mt-2">Bluesky</p>
                </a>
                
            </div> --}}
        </div>
        
        
    </section>
    <x-footer class="w-full"/>
</div>
@endsection