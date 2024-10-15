@extends('layouts.layout')
@section('title' , 'Accueil')

@section('content')
    <div class="flex-col items-center justify-center" x-data="seats()">
        <h1 class="text-3xl text-center m-10 font-bold">Résumé de votre selection</h1>

        <div class="grid grid-cols-6 shadow-inner border-solid border-2 border-gray-300 m-auto w-1/2 h-1/2 p-4 rounded-xl">
            <img src="{{$seance->film->url_affiche}}" alt="" class="col-span-2 rounded-xl">
            <div class="col-span-4 flex flex-col p-5 pl-10">
                <span class="flex gap-2"><p class="text-4xl font-bold">{{$seance->film->titre}}</p><img src="{{Storage::url($seance->film->certification->url_logo)}}" alt="" class="w-8"></span>
                <p class="text-2xl mt-5">Séance du {{ date('d/m/Y',strtotime($seance->datetime_seance)) }} à {{ date('H:i',strtotime($seance->datetime_seance)) }}</p>
                <div class="flex items-center">
                    <p class="text-3xl mt-3">Salle {{$seance->salle->id}}</p>
                    @if ($seance->dolby_atmos)
                        <img src="{{Storage::url('seanceAttributes/dolbyAtmos.png')}}" alt="" class="w-20 ml-5">  
                    @endif
                    @if ($seance->dolby_vision)    
                        <img src="{{Storage::url('seanceAttributes/dolbyVision.png')}}" alt="" class="w-20 ml-5"> 
                    @endif
                    @if ($seance->vf)
                        <p class="bg-slate-400 text-white rounded-xl p-1 pl-2 pr-2 ml-5">VF</p>
                    @else
                        <p class="bg-slate-400 text-white rounded-xl p-1 pl-2 pr-2 ml-5" title="{{$seance->film->langue->langue}}">VOST</p>
                    @endif
                </div>
                <div class="flex mt-5 text-xl">
                    <p><span class="font-bold">{{count($places)}} Place(s) selectionnée(s) :</span>
                        @foreach ($places as $place)
                            @if ($place === end($places))
                                <span class="place{{array_search($place, $places)}}" id="place{{array_search($place, $places)}}">{{$place}}</span>
                            @else
                                <span>
                                    <span class="place{{array_search($place, $places)}}" id="place{{array_search($place, $places)}}">{{$place}}</span>
                                    <span>, </span>
                                </span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class=" mt-10 space-x-4" x-data="selectPrices()">
                    
                    <form action="{{route('reservations.store')}}" method="POST" class="flex flex-col">
                        <input type="hidden" name="places" id="places" value="{{ implode(',', $places)}}">
                        <input type="hidden" name="seance" id="seance" value="{{ $seance->id }}">

                        <div class="flex gap-3 mb-3">
                            <p id="labelSTD" class="text-xl p-2 pl-0">Tarif normal (9,00 €)</p>
                            <button @click="updateValueSTD" id="minusSTD" type="button" class="bg-gray-300 pl-4 pr-4 text-xl font-bold rounded-full">-</button>
                            <input id="priceSTD" type="text" name="TarifNormal" id="TarifNormal" value="0" class="w-10 text-center text-xl font-bold" readonly>
                            <button @click="updateValueSTD" id="plusSTD" type="button" class="bg-yellow-300 pl-4 pr-4 text-xl font-bold rounded-full">+</button>
                        </div>
                        <div class="flex gap-3">
                            <p id="labelET" class="text-xl p-2 pl-0">Tarif étudiant (6,00 €)</p>
                            <button @click="updateValueET" id="minusET" type="button" class="bg-gray-300 pl-4 pr-4 text-xl font-bold rounded-full">-</button>
                            <input id="priceET" type="text" name="TarifEtudiant" id="TarifEtudiant" value="0" class="w-10 text-center text-xl font-bold" readonly>
                            <button @click="updateValueET" id="plusET" type="button" class="bg-yellow-300 pl-4 pr-4 text-xl font-bold rounded-full">+</button>
                        </div>
                        
                        {{-- <div class="flex items-center gap-2">
                            <p class="text-xl">Tarif normal (9,00 €)</p>
                            <select name="TarifNormal" id="TarifNormal" class="rounded-xl">
                                <option value="0">0</option>
                                @foreach ($places as $place)
                                    <option value="{{array_search($place, $places)+1}}">{{array_search($place, $places)+1}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2 flex items-center gap-2">
                            <p class="text-xl">Tarif étudiant (6,00 €)</p>
                            <select name="TarifEtudiant" id="TarifEtudiant" class="rounded-xl">
                                <option value="0">0</option>
                                @foreach ($places as $place)
                                    <option value="{{array_search($place, $places)+1}}">{{array_search($place, $places)+1}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="flex mt-5 gap-2">
                            <p class="text-xl">Total :</p>
                            <p class="text-xl ml-2 font-bold"><span id="total" class="font-bold"> 0</span>€</p>
                        </div>
         
                        @csrf
                        <button class="
                        font-bold
                        text-red-500 
                        hover:before:bg-red-500
                        border-red-500 
                        relative h-[50px] w-40
                        overflow-hidden 
                        border-2
                        bg-white p-2
                        rounded-full
                        shadow shadow-gray-500/50
                        transition-all before:absolute 
                        before:bottom-0 before:left-0 
                        before:top-0 before:z-0 before:h-full before:w-0 
                        before:bg-red-500 before:transition-all
                        before:duration-500 
                        hover:text-white
                        hover:before:left-0 hover:before:w-full
                        mt-5
                        "><span class="relative z-10" type="submit">Je réserve !</span></button>
                    </form>
                      
                </div>
            </div>
        </div>
        
    </div>
    <script>
        window.selectedPlaces = @json($places);
    </script>
@endsection