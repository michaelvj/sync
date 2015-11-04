@extends('back.main')

@section('title')
    Inschrijvingen voor {{{ $workshop->title }}}
@stop

@section('topnav')
    <div class="btn-group">
        <button type="submit" class="btn btn-danger navbar-btn remote-submit">
            <span class="glyphicon glyphicon-trash"></span>
            Selectie verwijderen
        </button>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs">
                <li>
                    {{ link_to_route('admin.workshops.edit', 'Workshop', array($workshop->id)) }}
                </li>
                <li class="active">
                    {{ link_to_route('admin.workshops.signups.index', 'Inschrijvingen', array($workshop->id)) }}
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">
                        Inschrijvingen voor {{{ $workshop->title }}}
                        <span class="pull-right">
                            {{ $workshop->signups->count() }} / {{ $workshop->max_signups }}
                        </span>
                    </h1>
                </div>
                {{ Form::open(array(
                    'id' => 'signups-form',
                    'route' => array('admin.workshops.signups.destroy', $workshop->id, 0),
                    'method' => 'delete'
                )) }}
                    <div class="table-responsive">
                        @include('partials.back.signups')
                    </div>
                    <noscript class="clearfix">
                        {{ Form::submit('Verwijder selectie', array(
                            'class' => 'btn btn-danger pull-right'
                        )) }}
                    </noscript>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop