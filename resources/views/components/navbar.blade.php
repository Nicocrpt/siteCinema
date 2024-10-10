<nav class=" p-8 shadow-md ml-5 mr-5 flex justify-between items-center">
    <ul class="row  flex space-x-10">
        <li class="navBar-li"><a href="{{ route('index') }}">Accueil</a></li>
        <li class="navBar-li"><a href="{{ route('films.index') }}">Films</a></li>
        <li class="navBar-li"><a href="{{ route('seances.index') }}">Seances</a></li>
        <li class="navBar-li"><a href="">Evenements spéciaux</a></li>
        <li class="navBar-li"><a href="">Contact</a></li>
    </ul>

    <a href="{{ route('home')}}" class="navBar-account">Mon compte</a>

</nav>