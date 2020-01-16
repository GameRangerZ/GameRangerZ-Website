@extends('layouts.app')

@section('content')
    <div class="container py-5 my-5">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Unsere Partner</h1>
            </div>
            <div class="col-lg-3">
                <figure class="figure">
                    <img class="figure-img img-fluid rounded" src="{{asset("img/netcup.webp")}}" alt="Netcup Logo">
                    <figcaption class="figure-caption">Der Hosting Provider Netcup</figcaption>
                </figure>
            </div>
            <div class="col-lg-8">
                <h2>Netcup</h2>
                <p class="text">
                    Alle unsere Server sind bei dem Hostingprovider Netcup gehostet. Hier kann man recht günstig
                    qualitativ hochwertige Server bekommen. Der DDoS Schutz hat uns schon das ein oder andere mal
                    gerettet, wenn ein Script-Kiddie mal wieder unseren TeamSpeak down haben wollte.
                    Der Support ist außerdem sehr freundlich und schnell.
                </p>
            </div>
        </div>
    </div>
@endsection