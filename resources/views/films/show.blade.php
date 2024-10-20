@extends('layouts.layoutNavigation')
@section('title' , 'Films')
@section('content')

<style>
    .video-container {
            position: relative;
            width: 100%; /* Le conteneur prend toute la largeur */
            padding-bottom: 60%; /* 21:9 = 42.86% */
            overflow: hidden;
             /* Optionnel, pour fond noir */
    }


    .video-container iframe {
        position: absolute;
        top: -13.39%;
        left: 0;
        width: 100vw;
        height: 100%;
        z-index: 10;
         /* Correspond à un ratio 16:9 */
            /* Utiliser un clip-path pour découper la vidéo et simuler le format 21:9 */
    }
</style>
<div class="relative">
    <div class="video-container bg-black">
        <iframe src="{{ $film->url_trailer.'?modestbranding=1&controls=20&showinfo=0&rel=0' }}" frameborder="0" allowfullscreen style="shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]"></iframe>
    </div>

    <div class="absolute top-0 dark:bg-zinc-800 bg-zinc-300  border-t-4 border-t-zinc-900 shadow-md" style="z-index: 20; margin-top: calc(100*0.4286vw); width: 100%; min-height:100%">
        <div class=" dark:text-white  p-5">
            <h1 class="text-3xl dark:text-white font-bold">Séances disponibles</h1>
            <div class="flex gap-5 flex-col">
                @foreach ($datesSeances as $dateSeance)
                    @if($dateSeance == date('d/m/Y'))
                        <p class=" dark:text-white rounded-xl p-1 pl-2 pr-2">Aujourd'hui</p>
                    @else
                        <p class="my-5 text-2xl dark:text-white font-semibold">{{$dateSeance}}</p>
                    @endif

                    <div class="flex gap-10">
                        @foreach ($film->seances as $seance)
                            @if(strftime('%A %d %B', strtotime($seance->datetime_seance)) == $dateSeance)
                                <a href="{{ route('seances.show', $seance->reference)}}">
                                    <div class="flex flex-col justify-center items-center rounded bg-slate-400 p-1 px-2 hover:shadow-md gap-2 pb-2">
                                        <p class="dark:text-white font-bold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
                                        <div class="flex justify-center items-center gap-2">
                                            @if($seance->dolby_atmos)
                                                <x-atmos-logo :width="25"/>
                                            @endif
                                            @if($seance->dolby_vision)
                                                <x-vision-logo :width="25"/>
                                            @endif
                                            @if($seance->vf || (!$seance->vf && $seance->film->langue == 'FR'))
                                                <p class="bg-slate-300 dark:text-white rounded px-1" title="Francais">VF</p>
                                            @else
                                                <p class="bg-slate-300 dark:text-white rounded px-1 " title="{{$seance->film->langue->langue}}">VO</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endforeach


                
            </div>
            
        </div>
    </div>
</div>

@endsection

