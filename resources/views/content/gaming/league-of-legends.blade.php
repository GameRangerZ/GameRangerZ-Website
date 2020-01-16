@extends('layouts.app')

@section('content')
    <div class="container py-5 my-5">
        <div class="row">
            <div class="col">
                <h1 class="text-center">League of Legends</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <img class="img-fluid" alt="League of Legends Banner" src="{{asset("/img/league-of-legends.webp")}}">
            </div>
            <div class="col-lg-12 my-5">
                <h2>Die Liga der Legenden</h2>
                <p class="text">
                    Die GameRangerZ sind auch in der Summoners Rift zu finden.
                    Wir haben Mitglieder von Bronze bis Diamond, jeder findet hier seine Mitspieler.
                </p>
                <h2>Was ist League of Legends?</h2>
                <p class="text">
                    League of Legends ist ein schnelles, kompetitives Onlinespiel von Riot.
                    Es treten zwei Teams gegeneinander an und versuchen die gegenerischen Türme sowie den Nexus zu zerstören, welcher das Spiel entscheidet.
                    Zu Beginn des Spiels wählen die Spieler ihren Champion, welcher individuelle Fähigkeiten besitzt.
                    Im Verlauf des Spiels können die Spieler ihren Champion durch den Kauf von Gegenständen beim Händler verbessern.
                    League of Legends veröffentlicht regelmäßig neue Champions und hat so ein sehr hohes Wiederspielpotential für Spieler jeden Niveaus.
                </p>
                <h2>Wann spielt ihr?</h2>
                <p class="text">
                    Da jeder von uns auch sein eigenes Leben hat, spielen wir immer nach Feierabend. Die meisten von
                    uns triffst du in der Woche ab 18 Uhr und am Wochenende an. Wir legen großen Wert darauf, dass das
                    Reallife immer Vordergrund steht und sich keiner Verpflichtet fühlt.
                </p>
                <h2>Kann man euch beitreten?</h2>
                <p class="text">
                    Die GameRangerZ sind immer auf der Suche nach neuen Leuten, die fürs Team leben. Join doch einfach
                    mal auf unseren Community-TeamSpeak und guck dich um, natürlich darfst du auch deine Freunde mitbringen 😉
                </p>
            </div>
        </div>
    </div>
@endsection