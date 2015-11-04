@extends('back.main')

@section('title')
    @if(Request::segment(2) === 'calls')
        Oproepen
    @else
        Nieuws
    @endif
@stop

@section('topnav')
    <a href="{{ route('admin.news.create') }}" class="btn btn-default navbar-btn">
        <span class="glyphicon glyphicon-bullhorn"></span>
        Nieuw nieuwsbericht
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
                        @yield('title')
                    </h1>
                </div>
                <div class="table-responsive">
                    @include('partials.back.news')
                </div>
                <div class="panel-body text-center">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>
@stop