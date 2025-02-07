@extends('layouts.layoutNavigation')

@section('title' , 'Réservation')

@section('content')

<style>
    .qrCode rect{
        fill: none;
    }
    .qrCode path{
        fill: black;
    }

    @media (prefers-color-scheme: dark) {
        .qrCode path{
            fill: white;
        }
    }
</style>

<div class="w-full min-h-[calc(100vh-56px)] h-full mt-[56px] flex flex-col max-xs:pt-6 pt-24 items-center justify-start xs:items-center px-2 gap-6">
    <div class="flex flex-col gap-2 xs:hidden">
        <h1 class="text-2xl text-center font-semibold dark:text-white">{{$seance->film->titre}}</h1>
        <p class="text-center font-light dark:text-white">{{date('d/m/Y - H:i', strtotime($seance->datetime_seance))}}</p>
        <div class="mt-1 flex flex-col justify-center items-center">
            <h2 class="dark:text-white mb-1">places réservées :</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($reservation->reservationlignes as $place)
                    <p class="dark:text-white dark:bg-slate-500 bg-zinc-400/30 border-[0.5px] text-center rounded text-xs flex justify-center items-center px-1 py-[0.15rem]">{{$place->place->rangee . $place->place->numero}}</p>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex justify-center items-center h-[12rem] max-w-[40rem] mx-1">
        <div class=" h-[12rem] py-[4.75rem] w-[4rem] rounded-l-lg border-l border-y dark:border-zinc-500 flex justify-center items-center bg-zinc-200/30 dark:bg-zinc-700/30 border-zinc-300">
            <p class="-rotate-90 dark:text-zinc-500 text-zinc-400/70 text-2xl font-semibold " style="font-family: 'doto'">Solaris</p>
        </div>
        <div class="h-[12rem] w-[1rem] flex flex-col gap-[0.9rem] justify-between bg-zinc-200/30 dark:bg-zinc-700/30">
            <div class="h-[1rem] w-full border-x border-b border-zinc-300 rounded-b-lg bg-zinc-50 dark:bg-zinc-900 dark:border-zinc-500"></div>
            <div class="h-[2rem] w-full border border-zinc-300 rounded-lg bg-zinc-50 dark:bg-zinc-900 dark:border-zinc-500"></div>
            <div class="h-[2rem] w-full border border-zinc-300 rounded-lg bg-zinc-50 dark:bg-zinc-900 dark:border-zinc-500"></div>
            <div class="h-[2rem] w-full border border-zinc-300 rounded-lg bg-zinc-50 dark:bg-zinc-900 dark:border-zinc-500"></div>
            <div class="h-[1rem] w-full border-x border-t border-zinc-300 rounded-t-lg bg-zinc-50 dark:bg-zinc-900 dark:border-zinc-500"></div>
        </div>
        <div class="h-[12rem] p-4 pl-4 flex justify-center items-center gap-4 border-y border-r rounded-r-lg bg-zinc-200/30 dark:bg-zinc-700/30 border-zinc-300 dark:border-zinc-500">
            <div class="h-fit">
                <div class="qrCode overflow-hidden rounded">
                    {{
                        QrCode::format('svg')
                            ->size(160)
                            ->color(0, 0, 0)
                            ->style('round')  // styles possibles : square, dot, round
                            ->eye('square')   // forme des "yeux" du QR code
                            ->generate($reservation->reference)
                    }}
                </div>
            </div>
            <div class="!h-[9rem] my-1 border border-zinc-400/20 max-xs:hidden"></div>
            <div class="flex flex-col justify-start h-full max-xs:hidden text-sm" style="font-family: 'courier prime'">
                <h1 class="dark:text-white text-lg font-bold">{{ $seance->film->titre }}</h1>
                <p class="dark:text-white font-light">{{date('d/m/Y - H:i', strtotime($seance->datetime_seance))}}</p>
                <div class="mt-1 flex flex-col justify-center items-start">
                    <h2 class="dark:text-white mt-2 font-semibold">places réservées :</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($reservation->reservationlignes as $place)
                            <p class="dark:text-white dark:bg-slate-500 bg-zinc-400/30 border-[0.5px] text-center rounded text-xs flex justify-center items-center px-1 py-[0.15rem]">{{$place->place->rangee . $place->place->numero}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-sm font-light italic text-zinc-500">Ce QR code est à présenter à l'entrée du cinéma.</p>

    {{-- <div class="flex flex-col justify-center items-center h-fit w-[18rem] mb-6 xs:hidden">
        <div class=" h-[4rem] w-full rounded-t-lg border-t border-x flex justify-center items-center bg-zinc-700/30">
            <p class=" dark:text-zinc-500 text-2xl font-light">Solaris</p>
        </div>
        <div class="h-[1rem] w-[18rem] flex justify-between bg-zinc-700/30">
            <div class="h-[1rem] w-[1.2rem] border-y border-r rounded-r-lg bg-zinc-900"></div>
            <div class="h-[1rem] w-[2.4rem] border rounded-lg bg-zinc-900"></div>
            <div class="h-[1rem] w-[2.4rem] border rounded-lg bg-zinc-900"></div>
            <div class="h-[1rem] w-[2.4rem] border rounded-lg bg-zinc-900"></div>
            <div class="h-[1rem] w-[2.4rem] border rounded-lg bg-zinc-900"></div>
            <div class="h-[1rem] w-[2.4rem] border rounded-lg bg-zinc-900"></div>
            <div class="h-[1rem] w-[1.2rem] border-y border-l rounded-l-lg bg-zinc-900"></div>
        </div>
        <div class="h-fit w-[18rem] p-4 pl-4 flex-col justify-center items-center gap-4 border-x border-b rounded-b-lg bg-zinc-700/30">
            <div class="h-fit">
                <div class="qrCode w-fit mx-auto pt-2">
                    {{
                        QrCode::format('svg')
                            ->size(240)
                            ->color(0, 0, 0)
                            ->style('round')  // styles possibles : square, dot, round
                            ->eye('square')   // forme des "yeux" du QR code
                            ->generate($reservation->reference)
                    }}
                </div>
            </div>
            <div class="w-[16rem] mx-auto border dark:border-zinc-500 mt-6 mb-2"></div>
            <div class="flex flex-col justify-start h-full">
                <h1 class="dark:text-white text-xl font-semibold">{{ $seance->film->titre }}</h1>
                <div class="mt-2">
                    <h2 class="dark:text-white text-xl">places réservées :</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($reservation->reservationlignes as $place)
                            <p class="dark:text-white bg-slate-500 size-6 text-center rounded">{{$place->place->rangee . $place->place->numero}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection