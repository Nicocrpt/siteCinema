<div class="max-w-screen mt-10 mb-24 flex group" 
    x-data="{translation: 0, scrollRange: 0}" 
    x-init="translation = 0; const ScreenResizer = () => {
            translation = 0
            switch (true) {
                case (window.innerWidth < 640):
                    scrollRange = 50
                    break;
                case (window.innerWidth < 768):
                    scrollRange = 33.333333
                    break;
                case (window.innerWidth < 1024):
                    scrollRange = 25
                    break;
                case (window.innerWidth < 1536):
                    scrollRange = 20
                    break;
                default:
                    scrollRange = 12.5
                    break;
            }
        };
        ScreenResizer();
        window.addEventListener('resize', ScreenResizer)
    
    ">
    {{-- <h1 class="text-3xl font-bold text-white mt-10">Nos Films</h1> --}}
    
    <div class="w-[2%]">
    </div>
    <div class="w-full overflow-hidden rounded-md relative">

        <button class="absolute top-[45%] left-[3%] bg-zinc-500 text-zinc-200 bg-opacity-80 rounded-full lg:px-2 lg:h-12 w-10 h-10 lg:w-12 z-20 lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:bg-opacity-80 transition-opacity ease-in-out duration-500 shadow-lg backdrop-blur-sm"
        :class="translation == 0 ? 'hidden' : ''" @click="translation > 0 ? translation-- : translation">❮</button>
        <button class="absolute top-[45%] right-[3%] bg-zinc-500 text-zinc-200 bg-opacity-80 rounded-full lg:px-2 h-10 w-10 lg:w-12 lg:h-12 z-20 lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:bg-opacity-80 transition-opacity ease-in-out duration-500 shadow-lg backdrop-blur-sm"
        :class="translation == {{$films->count()}}-(100/scrollRange) ? 'hidden' : ''"
        @click="translation < {{$films->count()}}-(100/scrollRange) ? translation++ : translation, console.log(translation), console.log ({{$films->count()}})">❯</button>

        <div class="flex ease-in-out duration-500 gap-auto justify-between rounded-md" :style="`transform: translateX(calc(-${scrollRange}% * ${translation}));`">
            @foreach ($films as $film)
                    <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 2xl:w-[12.5%] flex-shrink-0">
                        <img
                        src="{{ $film->url_affiche }}"
                        class="w-full rounded-lg px-1 shadow-md" />
                    </div>
            @endforeach   
        </div>
    </div>
    

    <div class="w-[2%]">

    </div>
</div>

