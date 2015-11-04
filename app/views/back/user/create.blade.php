@extends('back.main')

@section('title')
    Nieuwe gebruiker
@stop

@section('content')
    @include('partials.errors')

    {{ Form::open(array(
        'route' => 'admin.users.store',
    )) }}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('firstname', 'Voornaam') }}
                {{ Form::text('firstname', null, array(
                    'class' => 'form-control',
                    'maxlength' => 35,
                    'required'
                )) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('lastname', 'Achternaam') }}
                {{ Form::text('lastname', null, array(
                    'class' => 'form-control',
                    'maxlength' => 35,
                    'required'
                )) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array(
            'class' => 'form-control',
            'maxlength' => 255,
            'required'
        )) }}
    </div>
    <div class="form-group">
        {{ Form::label('group_id', 'Groep') }}
        {{ Form::select('group_id', $groups, null, array(
            'class' => 'form-control',
            'required'
        )) }}
    </div>

    {{ Form::submit('Maken', array(
        'class' => 'btn btn-primary pull-right'
    )) }}

    {{ Form::close() }}
@stop