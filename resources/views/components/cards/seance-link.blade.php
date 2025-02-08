<a href="{{ route('seances.show', $seance->id)}}">
    <div class="flex justify-center items-center rounded bg-zinc-200 hover:bg-zinc-300 dark:bg-zinc-500 dark:hover:bg-zinc-400 py-2 px-2 shadow gap-2 transition-all ease-in-out duration-200 group">
        <p class="dark:text-white font-semibold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
            @if($seance->dolby_atmos)
                <x-assets.atmos-logo :width="20" :class="'fill-black dark:fill-white'"/>
            @endif
            @if($seance->dolby_vision)
                <x-assets.vision-logo :width="20" :class="'fill-black dark:fill-white'"/>
            @endif
            @if($seance->vf || (!$seance->vf && $seance->film->langue == 'FR'))
                <p class="bg-zinc-700 text-white rounded px-1 dark:group-hover:bg-zinc-500 transition-all ease-in-out duration-200" title="Francais">VF</p>
            @else
                <p class="bg-zinc-900 text-white rounded px-1 " title="{{$seance->film->langue->langue}}">VO</p>
            @endif
    </div>
</a>