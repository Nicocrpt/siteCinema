<style>





</style>



<div x-data="filmsBanner" x-init="init" class=" block max-w-full relative z-20">
    <div class="swiper mySwiper border-none border-zinc-950 max-h-fit group" style="">
        <div class="swiper-wrapper w-full">
            @foreach ($films as $film)
                <div class="swiper-slide !h-full w-screen bg-center bg-cover bg-no-repeat z-10">
                    <div style="" class=" w-full h-full">
                        <img src="{{ $film->url_backdrop}}" alt="" class="absolute bottom-0 object-cover object-center min-h-full min-w-full !z-0 imgBanner transition-transform linear duration-[30s]">
                    </div>
                    <a href="{{route('film.show', $film->slug)}}" class="grid grid-cols-2 h-full w-full absolute top-0 left-0">
                        <div class="col-0 max-md:col-span-2 flex w-full">
                            <div class="max-md:p-10 md:pl-24 flex flex-col justify-end items-center mb-5 md:pb-24 h-full">
                                {{-- <a href="{{route('film.show', $film->slug)}}"><button class="bg-zinc-950 px-4 py-2 rounded-lg border border-zinc-600 md:hover:bg-zinc-800 transition-color ease-in-out duration-200"><span class="relative z-10" type="submit">Je réserve ma séance !</span></button></a> --}}
                                @if ($film->url_logo)
                                    <img src="{{ $film->url_logo }}" alt="" class=" w-full xs:w-[80%] md:w-full max-w-[60rem] md:pb-6 pb-10 !relative !z-20">
                                @else
                                    <h1 class=" w-full xs:w-[80%] md:w-full max-w-[36rem] md:pb-0 pb-10 !relative !z-20 text-5xl font-bold text-white">{{$film->titre}}</h1>
                                @endif
                            </div>
                            
                        </div>
                        
                    </a>
                    
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-700 z-30">
        </div>
    </div>
</div>


<script>
        window.films = @json($films->values());

</script>
