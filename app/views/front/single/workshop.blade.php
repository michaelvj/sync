@extends('front.main')

@section('title')
    {{{ $workshop->title }}}
@stop

@section('content')
    <?php $now = new \Carbon\Carbon(); ?>

    <div class="row">
        <div class="col-md-8">
            <article class="panel content">
                <h1>
                    {{ link_to_route('news', $workshop->title, array($workshop->id, $workshop->webTitle)) }}
                </h1>
                <div class="meta">
                    <p>
                        Door
                        <b>
                            {{{ $workshop->user->firstname }}} {{{ $workshop->user->lastname }}}
                        </b>
                        op
                        <b>{{ $workshop->shows_at->formatLocalized('%d %B, %H:%M') }}</b>.
                        @if($workshop->updated_at->gt($workshop->shows_at))
                            Laatst bijgewerkt op
                            <b>{{ $workshop->updated_at->formatLocalized('%d %B, %H:%M') }}</b>.
                        @endif
                    </p>
                    <div class="row">
                        <div class="col-sm-6 media">
                            <span class="glyphicon glyphicon-calendar pull-left"></span>
                            <div class="media-body">
                                {{ $workshop->begins_at->formatLocalized('%d %B, %H:%M') }}
                                &ndash;
                                {{ $workshop->ends_at->formatLocalized('%d %B, %H:%M') }}
                            </div>
                        </div>
                        <div class="col-sm-6 media">
                            <span class="glyphicon glyphicon-map-marker pull-left"></span>
                            <div class="media-body">
                                {{{ $workshop->location }}}
                            </div>
                        </div>
                        <div class="col-sm-6 media">
                            <span class="glyphicon glyphicon-user pull-left"></span>
                            <div class="media-body">
                                {{{ $workshop->teacher_name }}}
                            </div>
                        </div>
                        <div class="col-sm-6 media">
                            <span class="glyphicon glyphicon-stats pull-left"></span>
                            <div class="media-body">
                                {{ count($workshop->signups) }}
                                /
                                {{{ $workshop->max_signups }}}
                            </div>
                        </div>
                    </div>
                </div>
                @if($workshop->expires_at !== null && $workshop->expires_at->lte($now))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Dit bericht is niet meer geldig.
                    </div>
                @endif
                <p class="text-center">
                    <a href="#signup" data-toggle="offcanvas" class="btn btn-primary">Inschrijven</a>
                </p>
                <p class="clearfix">
                    @if($workshop->featured_image && $workshop->featured_visible)
                        <a title="Volledige grootte" class="side-image" target="_blank" href="/assets/uploads/{{ $workshop->featured_image }}">
                            <img src="/assets/uploads/{{ $workshop->featured_image }}" alt="Featured image" />
                        </a>
                    @endif
                    {{ $workshop->text }}
                </p>
            </article>
            <section id="signup" class="panel panel-default offcanvas">
                <div class="panel-body">
                    <h1 class="page-header">
                        Inschrijven
                        <button class="close" data-dismiss="offcanvas">&times;</button>
                    </h1>

                    @include('partials.errors')

                    @if(Cookie::has($workshop->webTitle))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Je bent ingeschreven met email-adres <b>{{ Cookie::get($workshop->webTitle) }}</b>.
                    </div>
                    @endif

                    @if($workshop->begins_at->lte($now))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Deze workshop is al geweest.
                        </div>
                    @elseif(count($workshop->signups) == $workshop->max_signups)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Deze workshop is vol.
                        </div>
                    @else
                        <form action="{{ route('workshops', array($workshop->id, $workshop->webTitle)) }}#signup" method="post">
                            {{ Form::token() }}
                            <div class="form-group">
                                {{ Form::label('student_number', 'Stamnummer') }}
                                {{ Form::input('number', 'student_number', null, array(
                                    'class' => 'form-control',
                                    'placeholder' => 'Stamnummer',
                                    'required'
                                )) }}
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    {{ Form::label('firstname', 'Voornaam') }}
                                    {{ Form::text('firstname', null, array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Voornaam',
                                        'maxlength' => 35,
                                        'required'
                                    )) }}
                                </div>
                                <div class="form-group col-sm-6">
                                    {{ Form::label('lastname', 'Achternaam') }}
                                    {{ Form::text('lastname', null, array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Achternaam',
                                        'maxlength' => 35,
                                        'required'
                                    )) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('email', 'Email') }}
                                {{ Form::email('email', null, array(
                                    'class' => 'form-control',
                                    'placeholder' => 'Email',
                                    'maxlength' => 255,
                                    'required'
                                )) }}
                            </div>
                            <div class="pull-right">
                                {{ Form::button('Annuleren', array(
                                    'class' => 'btn btn-link',
                                    'data-dismiss' => 'offcanvas'
                                )) }}
                                {{ Form::submit('Inschrijven', array(
                                    'class' => 'btn btn-primary'
                                )) }}
                            </div>
                        {{ Form::close() }}
                    @endif
                </div>
            </section>
        </div>

        <aside class="sidebar col-md-4">

            <div id="going" class="panel panel-default">
                <div class="panel-heading">
                    Inschrijvingen
                    <span class="pull-right">
                        {{ count($workshop->signups) }}
                        /
                        {{ $workshop->max_signups }}
                    </span>
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="progress progress-striped">
                            <div class="progress-bar" style="width: {{ count($workshop->signups) / $workshop->max_signups * 100}}%;"></div>
                        </div>
                    </div>
                    @foreach($workshop->signups as $item)
                        <p class="list-group-item">
                            {{ $item->firstname }}
                            {{ $item->lastname }}
                        </p>
                    @endforeach
                </div>
            </div>
            @include('partials.front.sidebar')
        </aside>
    </div>
@stop