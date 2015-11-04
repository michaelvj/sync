@extends('back.main')

@section('title')
    {{{ $edit_user->firstname }}}
    {{{ $edit_user->lastname }}}
    aanpassen
@stop

@section('topnav')
    <div class="btn-toolbar pull-right">
        <a href="{{ route('admin.users.create') }}" class="btn btn-default btn-group navbar-btn">
            <span class="glyphicon glyphicon-user"></span>
            Nieuwe gebruiker
        </a>

        {{ Form::open(array(
            'route' => array('admin.users.destroy', $edit_user->id),
            'method' => 'DELETE',
            'class' => 'btn-group'
        )) }}
        {{ Form::submit('Verwijderen', array(
            'class' => 'btn btn-danger navbar-btn'
        )) }}
        {{ Form::close() }}
    </div>
@stop


@section('content')
    @include('partials.errors')

    {{ Form::model($edit_user, array(
        'method' => 'PUT',
        'route' => array('admin.users.update', $edit_user->id)
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