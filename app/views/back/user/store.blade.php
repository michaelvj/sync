@extends('back.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>Geslaagd</h1>
            <hr />
            <p>Er is een account aangemaakt voor {{{ $new_user->firstname }}} {{{ $new_user->lastname }}}.</p>
            <p>Email: <b>{{{ $new_user->email }}}</b></p>
            <p>Wachtwoord: <b>{{ $password }}</b></p>
            <p><a href="mailto:{{{ $new_user->email }}}?subject={{ urlencode('SYNC Account')&body={{ urlencode("Email: $new_user->email, Wachtwoord: $password") }}">Mail deze gebruiker zijn wachtwoord</a></p>
        </div>
    </div>
@stop