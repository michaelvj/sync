@extends('front.main')

@section('title')
    Niet toegestaan!
@stop

@section('content')
<div class="row">
    <article class="col-md-8">
        <div class="panel content">
            <h1>
                403
            </h1>
            <hr />
            <p>
                Dit is een foutmelding. Dat wil zeggen, dat de actie die u probeert uit te voeren, niet is toegestaan.
                Controleer of u het juiste account gebruikt.
            </p>
            <ul>
                <li>{{ link_to(URL::previous(), 'Terug') }}</li>
                <li>{{ link_to_route('admin', 'Administratiepaneel') }}</li>
            </ul>
        </div>
    </article>
    <aside class="sidebar col-md-4">
        @include('partials.front.sidebar')
    </aside>
</div>
@stop