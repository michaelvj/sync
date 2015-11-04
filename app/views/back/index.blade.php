@extends('back.main')

@section('title')
    Overzicht
@stop

@section('content')
    <?php $today = new \Carbon\Carbon(); ?>

    <div class="row">
        <div class="col-xs-4">
            <a href="{{ route('admin.news.create') }}" class="thumbnail text-center">
                <span class="glyphicon glyphicon-bullhorn h1"></span>
                <p class="h3 hidden-xs">Nieuw nieuwsbericht</p>
            </a>
        </div>
        <div class="col-xs-4">
            <a href="{{ route('admin.calls.create') }}" class="thumbnail text-center">
                <span class="glyphicon glyphicon-warning-sign h1"></span>
                <p class="h3 hidden-xs">Nieuwe oproep</p>
            </a>
        </div>
        <div class="col-xs-4">
            <a href="{{ route('admin.workshops.create') }}" class="thumbnail text-center">
                <span class="glyphicon glyphicon-calendar h1"></span>
                <p class="h3 hidden-xs">Nieuwe workshop</p>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>
                        Nieuws
                        {{ link_to_route('admin.news.index', 'Meer&hellip;', null, array('class' => 'btn btn-default btn-sm pull-right')) }}
                    </h1>
                </div>
                <div class="table-responsive">
                    @include('partials.back.news')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>
                        Oproepen
                        {{ link_to_route('admin.calls.index', 'Meer&hellip;', null, array('class' => 'btn btn-default btn-sm pull-right')) }}
                    </h1>
                </div>
                <div class="table-responsive">
                    @include('partials.back.calls', array('news' => $calls))
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>
                        Workshops
                        {{ link_to_route('admin.news.index', 'Meer&hellip;', null, array('class' => 'btn btn-default btn-sm pull-right')) }}
                    </h1>
                </div>
                <div class="table-responsive">
                    @include('partials.back.workshops')
                </div>
            </div>
        </div>
    </div>
@stop