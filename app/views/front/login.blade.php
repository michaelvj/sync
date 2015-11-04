@extends('front.main')

@section('title')
    Inloggen
@stop

@section('content')
    <div class="row">
        <section class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Inloggen</h1>
                </div>
                <div class="panel-body">
                    @include('partials.errors')
                    {{ Form::open(array(
                        'route' => 'login',
                        'method' => 'POST'
                    )) }}
                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array(
                            'class' => 'form-control',
                            'required'
                        )) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('pass', 'Wachtwoord') }}
                        {{ Form::password('pass', array(
                            'class' => 'form-control',
                            'required'
                        )) }}
                    </div>
                    <div class="pull-right">
                        {{ Form::submit('Inloggen', array(
                            'class' => 'btn btn-primary'
                        )) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </section>
    </div>
@stop