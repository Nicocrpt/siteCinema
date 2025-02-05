<style>





</style>



<div x-data="filmsBanner" x-init="init" class=" block max-w-full relative z-20">
    <div class="swiper mySwiper border-none border-zinc-950 max-h-fit group" style="">
        <div class="swiper-wrapper w-full">
            @foreach ($films as $film)
                <div class="swiper-slide !h-full w-screen bg-center bg-cover bg-no-repeat z-20" style="background-image: url('{{ $film->url_backdrop }}'); ">
                    <a href="{{route('film.show', $film->slug)}}" class="grid grid-rows-5 h-full w-full">
                        <div></div>
                        <div class="row-start-3 row-span-3 flex md:row-start-2 md:row-span-4 md:grid md:grid-cols-2">
                            <div class="p-10 flex flex-col justify-end items-center mb-5 md:pb-24 h-full">
                                {{-- <a href="{{route('film.show', $film->slug)}}"><button class="bg-zinc-950 px-4 py-2 rounded-lg border border-zinc-600 md:hover:bg-zinc-800 transition-color ease-in-out duration-200"><span class="relative z-10" type="submit">Je réserve ma séance !</span></button></a> --}}
                                <img src="{{ $film->url_logo }}" alt="" class="w-full max-w-[40rem] md:pb-0 pb-10 !relative !z-10">
                            </div>
                            
                        </div>
                        
                    </a>
                    
                </div>
            @endforeach

        </div>
        <div class="swiper-pagination opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-700 z-30"></div>

    </div>
    {{-- <div class="w-full block absolute bottom-0 h-[6rem] z-[1] pointer-events-none" style="background: linear-gradient(
  0deg,
  rgba(9, 9, 11, 1) 1%,
  rgba(9, 9, 11, 0.9) 5%,        /* #09090b 100% opaque */
  rgba(9, 9, 11, 0.738) 19%,   /* 73.8% opaque */
  rgba(9, 9, 11, 0.541) 34%,   /* 54.1% opaque */
  rgba(9, 9, 11, 0.382) 47%,   /* 38.2% opaque */
  rgba(9, 9, 11, 0.278) 56.5%, /* 27.8% opaque */
  rgba(9, 9, 11, 0.194) 65%,   /* 19.4% opaque */
  rgba(9, 9, 11, 0.126) 73%,   /* 12.6% opaque */
  rgba(9, 9, 11, 0.075) 80.2%, /* 7.5% opaque */
  rgba(9, 9, 11, 0.042) 86.1%, /* 4.2% opaque */
  rgba(9, 9, 11, 0.021) 91%,   /* 2.1% opaque */
  rgba(9, 9, 11, 0.008) 95.2%, /* 0.8% opaque */
  rgba(9, 9, 11, 0.002) 98.2%, /* 0.2% opaque */
  rgba(9, 9, 11, 0) 100%       /* transparent */
);" 
    >--}}

    </div>
</div>


<script>
        window.films = @json($films->values());

</script>
