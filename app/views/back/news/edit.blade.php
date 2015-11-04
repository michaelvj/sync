@extends('back.main')

@section('title')
    {{{ $news->title }}} Aanpassen
@stop

@section('topnav')
    <a href="{{ route('admin.news.create') }}" class="btn btn-default navbar-btn">
        <span class="glyphicon glyphicon-bullhorn"></span>
        Nieuw nieuwsbericht
    </a>

    {{ Form::open(array(
        'route' => array('admin.news.destroy', $news->id),
        'method' => 'DELETE',
        'class' => 'btn-group navbar-btn'
    )) }}

    <button type="submit" class="btn btn-danger">
        <span class="glyphicon glyphicon-trash"></span>
        Verwijderen
    </button>

    {{ Form::close() }}
@stop

@section('content')
    @include('partials.errors')

    {{ Form::model($news, array(
        'files' => true,
        'method' => 'PUT',
        'route' => array(
            'admin.news.update',
            $news->id
        )
    )) }}

        @include('partials.back.form')

        {{ Form::submit('Bijwerken', array(
            'class' => 'btn btn-primary pull-right'
        )) }}
    {{ Form::close() }}
@stop

@section('script')
    <script src="/assets/js/moment/moment.min.js"></script>
    <script src="/assets/js/moment/nl.js"></script>
    <script src="/assets/js/datetimepicker.min.js"></script>
    <script src="/assets/js/wysihtml5/simple.js"></script>
    <script src="/assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
    <script>
        $(function(){
            var editor = new wysihtml5.Editor("text", { // id of textarea element
                toolbar: 'text-toolbar',
                parserRules:  wysihtml5ParserRules // defined in parser rules set
            });
            
            $('#shows_at').datetimepicker();
            $('#expires_at').datetimepicker();
            
            if(typeof $('#shows_at').data("DateTimePicker").date._i != "undefined")
                $('#expires_at').data("DateTimePicker").setMinDate($('#shows_at').data("DateTimePicker").date);
            if(typeof $('#expires_at').data("DateTimePicker").date._i != "undefined")
                $('#shows_at').data("DateTimePicker").setMaxDate($('#expires_at').data("DateTimePicker").date);
            
            $("#shows_at").on("dp.change",function (e) {
                $('#expires_at').data("DateTimePicker").setMinDate(e.date);
            });
            $("#expires_at").on("dp.change",function (e) {
                $('#shows_at').data("DateTimePicker").setMaxDate(e.date);
            });
        });
    </script>
@stop