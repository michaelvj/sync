@extends('front.main')

@section('title')
    Niet gevonden!
@stop

@section('content')
<div class="row">
    <article class="col-md-8">
        <div class="panel content">
            <h1>
                404
            </h1>
            <hr />
            <p>
                Dit is een foutmelding. Dat wil zeggen, dat deze pagina niet gevonden kon worden.
                Het kan zijn dat de url verkeerd is gespeld, of dat deze pagina is verwijderd.
            </p>
            <ul>
                <li>{{ link_to_route('home', 'Terug naar de hoofdpagina') }}</li>
                <li>{{ link_to_route('news', 'Nieuws overzicht') }}</li>
                <li>{{ link_to_route('workshops', 'Workshops overzicht') }}</li>
            </ul>
        </div>
    </article>
    <aside class="sidebar col-md-4">
        @include('partials.front.sidebar')
    </aside>
</div>
@stop