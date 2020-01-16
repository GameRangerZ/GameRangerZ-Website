@extends('layouts.app')

@section('content')
<div class="container py-5 my-5">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center"><span class="code-light text-shadow">Das Game<span class="red">RangerZ</span> Airsoft Team</span></h1>
        </div>
        <div class="col-lg-4">
            <figure class="figure">
                <img class="figure-img img-fluid rounded" src="{{asset("/img/airsoft.webp")}}" alt="Airsoft Sch&#xFC;tze liegend">
                <figcaption class="figure-caption">Felix lauert liegend dem Gegner auf</figcaption>
            </figure>
        </div>
        <div class="col-lg-8">
            <h2>Was ist Airsoft?</h2>
            <p class="text">
                Airsoft oder auch Softair ist in vielen Ländern ein anerkannter Sport. Dieser wird mit meist
                originalgetreu nachgebildeten Modellwaffen, den Airsoft-Guns (ASG), auch "Marker" genannt, ausgeübt.
                Der Reiz des Airsoftsportes ist jedoch nicht wahlloses "Rumgeballere", sondern strategisches Vorgehen,
                ausgeprägtes Teamplay und Spielspaß. Bei den Spielen gilt es, ein bestimmtes Ziel zu erreichen.
                Und wenn das ohne Schusswechsel möglich ist, versucht man den Gegenspieler zu umgehen.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <h2>Wieso euer eingenes Team?</h2>
            <p class="text">
                Wir haben uns entschlossen unser eigenes Airsoft-Team zu starten, da wir im Clan das starke
                Verlangen nach Airsoft verspürten und uns persönlich schon sehr gut kannten, sodass wir
                ein wunderbares aufeinander abgestimmtes Team sind.</p>
            <p class="text">
                Unser Team ist natürlich auch auf dem <a target="_blank" href="https://www.airsoft-verzeichnis.de/index.php?status=forum&forennummer=0000070000#"> Airsoft-Verzeichnis</a>
                zu finden.
            </p>
        </div>
        <div class="col-lg-4">
            <figure class="figure">
                <img class="figure-img img-fluid rounded" src="{{asset("/img/airsoft_patch.webp")}}" alt="GameRangerZ Team Patch">
                <figcaption class="figure-caption">Unser GameRangerZ Team Patch</figcaption>
            </figure>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <figure class="figure">
                <img class="figure-img img-fluid rounded" src="{{asset("/img/airsoft_gewehr.webp")}}" alt="Airsoft in Stellung">
                <figcaption class="figure-caption">Victors Krytac Trident MK2 SPR</figcaption>
            </figure>
        </div>
        <div class="col-lg-8 float-right">
            <h2>Wo spielt ihr?</h2>
            <p class="text">
                Wir spielen fast überall, wo es sich lohnt hinzufahren. Bisher haben wir zwar nur im Norden
                Deutschlands gespielt: Vom Containerdepot am Hafen, über Kiesgruben
                bis zur alten NVA Kaserne im Wald durften wir schon alles erleben. Jedoch sind wir
                immer gespannt auf neue Events!

                Zudem ist die <a target="_blank" href="https://airsoftoperations.eu/">Dark-Zone von Airsoft Operations</a> sehr
                zu empfehlen!
            </p>
        </div>
    </div>
</div>
@endsection