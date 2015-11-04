@extends('back.main')

@section('title')
    Workshops
@stop

@section('topnav')
    <a href="{{ route('admin.workshops.create') }}" class="btn btn-default navbar-btn">
        <span class="glyphicon glyphicon-calendar"></span>
        Nieuwe workshop
    </a>
@stop

@section('content')
    <?php $today = new \Carbon\Carbon(); ?>

    @include('partials.errors')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>
                        Laatste workshops
                    </h1>
                </div>
                <div class="table-responsive">
                    @include('partials.back.workshops')
                </div>
                <div class="panel-body text-center">
                    {{ $workshops->links() }}
                </div>
            </div>
        </div>
    </div>
@stop