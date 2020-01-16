@extends('layouts.app')

@section('content')
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-md-2">
                        <h1 class="brand-heading code-light text-shadow">Game<span class="red">RangerZ</span></h1>
                        <p class="intro-text">GameRangerZ klingt anders, haut rein.</p> <a href="#about" class="btn btn-circle page-scroll">

                            <i class="fa fa-angle-double-down animated"></i>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- About Section -->
    <section id="about" class="content-section text-center">
        <div class="about-section section">
            <div class="container">
                <div class="col-xl-8 offset-lg-2">
                    <h2>&#xDC;ber Uns</h2>
                    <p>Der Gaming-Clan GameRangerZ wurde 2014 aus ein paar Freunden gegr&#xFC;ndet,
                        seitdem wird bei uns eigentlich immer t&#xE4;glich gezockt.</p>
                    <p>Gespielt wird eigentlich alles.</p>
                    <p>Aktuell aber viel <a href="https://euw.leagueoflegends.com/">LoL</a>,
                        <a
                                href="https://www.battlefield.com/">Battlefield 1</a>, <a href="https://arma3.com/">ArmA 3</a> oder auch <a href="https://counter-strike.net/">CS:GO</a>
                    </p>
                    <p>Wir besitzen einen eigenen Server, auf dem wir einiges Hosten (TeamSpeak,
                        GameServer, Homepage, etc.)</p>
                    <p>Au&#xDF;erdem haben wir einen <a href="https://youtube.com/gamerangerz">Youtube</a> und
                        auch einen <a href="https://twitch.tv/gamerangerz">Twitch-Kanal</a>
                    </p>
                    <p></p>
                </div>
            </div>
        </div>
    </section>
    <!-- TeamSpeak Section -->
    <section id="teamspeak" class="content-section text-center">
        <div class="teamspeak-section section">
            <div class="container">
                <div class="col-xl-8 offset-lg-2">
                    <h2>TeamSpeak</h2>
                    <p>Du suchst einen TeamSpeak Server f&#xFC;r Dich und Deine Freunde oder
                        m&#xF6;chtest einfach mit jemanden zocken?</p>
                    <p>Dann bist bei uns genau richtig!</p>
                    <p>Verbinde dich einfach mit GameRangerZ.de oder klick auf den Button!</p>
                    <a
                            href="ts3server://gamerangerz.de" class="btn btn-danger btn-lg">TS3 Beitreten</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Hosting Section -->
    <section id="hosting" class="content-section text-center">
        <div class="hosting-section section">
            <div class="container">
                <div class="col-xl-8 offset-lg-2">
                    <h2>Hosting</h2>
                    <p>Du m&#xF6;chtest mit deinen Kumpels was zocken, aber hast keine Lust teure
                        Hosting Geb&#xFC;hren zu zahlen?</p>
                    <p>Oder du suchst einfach nach einem Hoster f&#xFC;r deine Website?</p>
                    <p>Dann melde dich bei uns und wir hosten dir deinen Server!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="content-section text-center">
        <div class="contact-section section">
            <div class="container">
                <div class="col-xl-8 offset-lg-2">
                    <h2>Kontakt</h2>
                    <p>Du m&#xF6;chtest mit uns reden?</p>
                    <p>Dann komm am besten auf unseren <a href="ts3server://gamerangerz.de">TeamSpeak-Server</a>!</p>
                    <p>Oder schreib uns auf folgenden Platformen an:</p>
                    <ul class="list-inline banner-social-buttons">
                        <li class="list-inline-item"> <a href="https://youtube.com/GameRangerZ" class="btn btn-secondary btn-lg"><i class="fa fa-youtube fa-fw"></i> <span class="network-name">YouTube</span></a>
                        </li>
                        <li class="list-inline-item"> <a href="https://twitter.com/GameRangerZ" class="btn btn-secondary btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li class="list-inline-item"> <a href="#" class="btn btn-secondary btn-lg cryptedmail" data-name="victor.lange1998"
                                                         data-domain="gmail" data-tld="com" onclick="window.location.href = &apos;mailto:&apos; + this.dataset.name + &apos;@&apos; + this.dataset.domain + &apos;.&apos; + this.dataset.tld; return false;">

                                <i class="fa fa-envelope fa-fw"></i> <span class="network-name">E-Mail</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection