<div class="max-w-screen mt-10 mb-24 flex group" 
    x-data="{translation: 0, scrollRange: 0, activeItem : null, lastItem: 0, count: 0,
    onPosterClick(index) {
        
        const ref = `slide${index}`
        if (this.activeItem == index) {
            this.$el.classList.remove('delay-200')
            if ((this.activeItem-this.translation+2)%this.lastItem == 0 && this.count != 0)
            {
                this.$refs[ref].classList.remove('delay-[275ms]')
                
                $el.classList.remove('delay-200')
                this.translation--
                console.log(this.translation)
                
                
                
            }
            
            this.activeItem = null
            this.count = 0
        } else {
            
            this.activeItem = index
            if ((this.activeItem-this.translation+1)%this.lastItem == 0)
            {   
                
                
                this.$refs[ref].classList.add('delay-[275ms]')
                this.translation++
                console.log(this.translation)
                this.count++
            }
        }
    }}" 
    x-init="translation = 0; const ScreenResizer = () => {
            translation = 0
            switch (true) {
                case (window.innerWidth < 640):
                    scrollRange = 50
                    lastItem = 2
                    break;
                case (window.innerWidth < 768):
                    scrollRange = 33.333333
                    lastItem = 3
                    break;
                case (window.innerWidth < 1024):
                    scrollRange = 25
                    lastItem = 4
                    break;
                case (window.innerWidth < 1536):
                    scrollRange = 20
                    lastItem = 5
                    console.log(lastItem)
                    break;
                default:
                    scrollRange = 12.5
                    lastItem = 8
                    break;
            }
        };
        ScreenResizer();
        window.addEventListener('resize', ScreenResizer)
    
    ">
    {{-- <h1 class="text-3xl font-bold text-white mt-10">Nos Films</h1> --}}
    
    <div class="w-[2%]">
    </div>
    <div class="w-full overflow-hidden relative rounded">

        <button class="absolute top-[45%] left-[3%] bg-zinc-500 text-zinc-200 bg-opacity-80 rounded-full lg:px-2 lg:h-12 w-10 h-10 lg:w-12 z-20 lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:bg-opacity-80 transition-opacity ease-in-out duration-300 shadow-lg backdrop-blur-sm"
        :class="translation == 0 ? 'hidden' : ''" @click="translation > 0 ? translation-- : translation">❮</button>
        <button class="absolute top-[45%] right-[3%] bg-zinc-500 text-zinc-200 bg-opacity-80 rounded-full lg:px-2 h-10 w-10 lg:w-12 lg:h-12 z-20 lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:bg-opacity-80 transition-opacity ease-in-out duration-300 shadow-lg backdrop-blur-sm"
        :class="translation == {{$films->count()}}-(100/scrollRange) ? 'hidden' : ''"
        @click="translation < {{$films->count()}}-(100/scrollRange) ? translation++ : translation, console.log(translation), console.log ({{$films->count()}})">❯</button>

        <div x-ref="slider" class="flex ease-in-out duration-300 gap-auto rounded-3xl" :style="`transform: translateX(calc(-${scrollRange}% * ${translation}));`">
            @foreach ($films as $index => $film)
                    <div x-ref="slide{{$index}}" class=" flex-shrink-0 flex-grow transition-[width] ease-in-out duration-300 overflow-hidden h-[70vw] sm:h-[46vw] md:h-[35vw] lg:h-[27.5vw] 2xl:h-[17.2vw]"
                    :class="activeItem == {{$index}} ? 'w-full sm:w-2/3 md:w-1/2 lg:w-2/5 2xl:w-[25%]' : 'w-[50%] sm:w-1/3 md:w-1/4 lg:w-1/5 2xl:w-[12.5%]'">
                        <div class="relative mx-1 h-full overflow-hidden">
                                <div class="overflow-hidden">
                                    <img src="{{ $film->url_affiche }}" class="w-fit shadow-md" />
                                <div @click="onPosterClick({{$index}})" class="absolute top-0 left-0 bg-zinc-900 bg-opacity-50 backdrop-blur w-full h-full transition-opacity ease-in-out duration-200 delay-200" :class="activeItem == {{$index}} ? 'opacity-100' : 'opacity-0'">
                                    <h1 class="text-xl text-white font-semibold mt-3 mb-2 mx-3">{{$film->titre}}</h1>
                                        <div class="h-40 mx-2 overflow-hidden">
                                            <p class="text-white text-xs" style="text-overflow: ellipsis">{{$film->synopsis}}</p>
                                        </div>
                                    
                                    
                                    <a href="{{ route('film.show', $film->slug) }}" class="text-white text-sm m-3 absolute bottom-0 right-0 p-2 bg-zinc-900 hover:bg-zinc-950 rounded">Voir plus</a>
                                </div>
                                </div>
                                
                                

                        </div>
                        
                        
                        {{-- activeItem == {{$index}} ? activeItem = null : activeItem = {{$index}}; (activeItem-translation+1)%lastItem == 0 && activeItem != null ? translation++ : translation = translation --}}



                    </div>
            @endforeach   
        </div>
    </div>
    

    <div class="w-[2%]">

    </div>
</div>

<script>
    function getTransformOrigin(index, lastItem) {
        console.log(index+1)
        console.log(lastItem)
        return (index+1) % lastItem === 0 ? 'transform-origin: right;' : 'transform-origin: left;';
    }
</script>