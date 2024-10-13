<div x-data="filmsCaroussel" x-init="init" class="relative overflow-hidden w-full group">
    <div class="flex transition-transform duration-1000 ease-in-out" :style="`transform: translateX(-${currentIndex * 100}%)`">
        @foreach ($films as $film)
            <div class="top-20 left-0 w-full bg-cover bg-center bg-no-repeat border-b-4 border-t-4 border-b-slate-200 border-t-slate-200 min-w-full" style="background-image: url({{$film->url_backdrop}}); height: 60vh;">
                <div class="z-10 relative">
                    <div class="h-[50vh] grid grid-rows-2">
                        <div></div>
                        <div class="pl-20 flex flex-col">
                            <img class="w-1/3" src="{{ $film->url_logo }}" alt="" />
                            <a class="w-fit ml-20 mt-5 p-2 bg-black text-xl text-white rounded-2xl font-bold border-2 border-black hover:bg-white hover:text-black hover:border-black transition-all ease-in-out duration-500" href="{{route('film.show', $films->where('est_favori', 1)->first()->slug)}}">Je réserve ma séance !</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach     
    </div>

    {{-- <button @click="prev" cursor="pointer" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-4 py-2">
        ⟨
    </button>

    <!-- Bouton suivant -->
    <button @click="next" cursor="pointer" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-4 py-2">
        ⟩
    </button> --}}

    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 opacity-0 group-hover:opacity-80 transition-all ease-in-out duration-500 delay-500">
        @foreach ($films->values() as $index => $film)
            <button @click="currentIndex = {{ $index }}; resetAutoSlide()" class="w-3 h-3 rounded-full" :class="currentIndex === {{ $index }} ? 'bg-white' : 'bg-gray-400'"></button>
        @endforeach
    </div>

    <script>
        window.films = @json($films->values());
        console.log(films)
    </script>
</div>

