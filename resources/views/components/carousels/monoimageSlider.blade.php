<div class="relative w-full flex group">
    {{-- <h1 class="text-3xl font-bold text-white mt-10">Nos Films</h1> --}}
    <button class="absolute top-[45%] left-[2%]  bg-zinc-500 text-zinc-200 bg-opacity-80 rounded-full lg:px-2 lg:h-12 w-10 h-10 lg:w-12 z-[1] lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:bg-opacity-80 transition-opacity ease-in-out duration-500 shadow-lg backdrop-blur-sm"
    :class="translation == 0 ? 'hidden' : ''" @click="translation > 0 ? translation-- : translation">❮</button>

    <button class="absolute top-[45%] right-[2%] bg-zinc-500 text-zinc-200 bg-opacity-80  rounded-full lg:px-2 w-10 h-10 lg:h-12 lg:w-12 z-[1] lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:bg-opacity-80 transition-opacity ease-in-out duration-500 shadow-lg backdrop-blur-sm"
    :class="translation == {{count($images)-1}} ? 'hidden' : ''"
     @click="translation < {{count($images)-1}} ? translation++ : translation">
     ❯
    </button>


   

    <div class="w-full rounded overflow-hidden h-fit">
        <div class="flex ease-in-out duration-500 gap-auto justify-between rounded-md w-full h-auto" :style="`transform: translateX(calc(-100% * ${translation}));`">
            @foreach ($images as $image)
                    <div class="w-[100%] flex-shrink-0 h-auto rounded">
                        <img  @click="fullscreenImage = true; document.querySelector('.solaris').classList.add(''); "
                        src="{{ $image }}"
                        class="w-full shadow-md h-auto" />
                    </div>
            @endforeach   
        </div>
    </div>

    <div class="absolute bottom-3 w-full h-3 bg-transparent flex justify-center items-center gap-1 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-500"> 
        @foreach ($images as $image)
            <div class=" rounded-full transition-all ease-in-out duration-500" :class="translation == {{array_search($image, $images)}} ? 'bg-zinc-200 bg-opacity-90 w-3 h-3' : 'bg-zinc-400 bg-opacity-60 w-[0.6rem] h-[0.6rem]'"></div>
        @endforeach

    </div>
    
</div>