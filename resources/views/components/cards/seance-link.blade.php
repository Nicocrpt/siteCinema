<a href="{{ route('seances.show', $seance->reference)}}">
    <div class="flex flex-col justify-center items-center rounded bg-slate-200 hover:bg-slate-300 dark:bg-slate-500 dark:hover:bg-slate-400 p-1 px-2 shadow gap-2 pb-2 transition-all ease-in-out duration-200 group">
        <p class="dark:text-white font-semibold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
        <div class="flex justify-center items-center gap-2">
            @if($seance->dolby_atmos)
                <x-assets.atmos-logo :width="25" :class="'fill-black dark:fill-white'"/>
            @endif
            @if($seance->dolby_vision)
                <x-assets.vision-logo :width="25" :class="'fill-black dark:fill-white'"/>
            @endif
            @if($seance->vf || (!$seance->vf && $seance->film->langue == 'FR'))
                <p class="bg-slate-300 dark:text-white rounded px-1 dark:group-hover:bg-slate-500 transition-all ease-in-out duration-200" title="Francais">VF</p>
            @else
                <p class="bg-slate-300 dark:text-white rounded px-1 " title="{{$seance->film->langue->langue}}">VO</p>
            @endif
        </div>
    </div>
</a>