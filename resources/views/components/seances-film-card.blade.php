<div class="grid grid-cols-8 border-solid border-2 border-gray-800 m-5 w-5/6 p-4 rounded-xl">
    <img src="{{$film->url_affiche}}" alt="">
    <div class="col-span-7 flex flex-col justify-between">
        <p class="text-center"><span class="text-2xl font-bold">{{$film->titre}}</span> - {{$film->realisateurs[0]->nom}}</p>
        <div class="flex justify-evenly ml-20 mr-20">
            @foreach ($film->seances as $seance)
                <a href="{{ route('seances.show', $seance->reference)}}">
                    <div class="flex flex-col justify-center items-center bg-amber-100 rounded-xl p-2 mt-4">
                        <p class="text-slate-600 font-bold">{{ date('d',strtotime($seance->datetime_seance)) }}</p>
                        <p class="text-slate-600 font-bold">{{ date('H:i', strtotime($seance->datetime_seance))}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>