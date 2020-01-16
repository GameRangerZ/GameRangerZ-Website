@extends('layouts.app')

@section('content')
    <div class="container py-5 my-5">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Unsere Partner</h1>
            </div>
            <div class="col-lg-3">
                <figure class="figure">
                    <a href="https://netcup.de" title="Netcup" target="_blank" rel="noopener">
                        <img class="figure-img img-fluid rounded" src="{{asset("img/netcup.webp")}}" alt="Netcup Logo">
                    </a>
                    <figcaption class="figure-caption">Der Hosting Provider Netcup</figcaption>
                </figure>
            </div>
            <div class="col-lg-9">
                <h2>Netcup</h2>
                <p class="text">
                    Alle unsere Server sind bei dem Hostingprovider Netcup gehostet. Hier kann man recht günstig
                    qualitativ hochwertige Server bekommen. Der DDoS Schutz hat uns schon das ein oder andere mal
                    gerettet, wenn ein Script-Kiddie mal wieder unseren TeamSpeak down haben wollte.
                    Der Support ist außerdem sehr freundlich und schnell.
                </p>
            </div>
            <div class="col-lg-3">
                <figure class="figure">
                    <a href="https://gamertransfer.com" title="Gamertransfer" target="_blank" rel="noopener">
                        <img class="figure-img img-fluid rounded-circle" src="{{asset("img/gamertransfer.webp")}}" alt="Netcup Logo">
                    </a>
                    <figcaption class="figure-caption">Deutscher eSport Transfermarkt</figcaption>
                </figure>
            </div>
            <div class="col-lg-9">
                <h2>GamerTransfer</h2>
                <p class="text">
                    GamerTransfer ist eine bekannte LFG-Plattform, welche es Spieler ermöglicht Gruppen und Teams und Clans
                    Tuniergegner und neue Mitspieler zu finden. Wir sind hier natürlich auch gelistet und freuen uns
                    neue Teammitglieder zu rekrutieren.
                </p>
            </div>
        </div>
    </div>
@endsection