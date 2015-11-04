@extends('back.main')

@section('title')
    Gebruikers
@stop

@section('topnav')
    <a href="{{ route('admin.users.create') }}" class="btn btn-default navbar-btn">
        <span class="glyphicon glyphicon-user"></span>
        Nieuwe gebruiker
    </a>
@stop

@section('content')
    @include('partials.errors')

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>
                        Gebruikers
                    </h1>
                </div>
                <div class="table-responsive">
                    @include('partials.back.users')
                </div>
                <div class="panel-body text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@stop