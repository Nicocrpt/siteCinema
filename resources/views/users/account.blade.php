<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my account</title>
</head>
<body>
    <h1>Hello {{$user->prenom}}</h1>
    @foreach ($user->reservations as $reservation)
        <h3>{{$reservation->reference}}, {{$reservation->seance->datetime_seance}}, {{$reservation->id}}</h3>
        <p>{{$reservation->seance->film->titre}}</p>
        <div>
            @foreach ($reservation->reservationligne as $ligne)
                <p>{{$ligne->place->rangee . $ligne->place->numero}}</p>
                
            @endforeach
        </div>
    @endforeach
</body>
</html>