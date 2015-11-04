@extends('back.main')

@section('title')
    Nieuw Nieuwsbericht
@stop

@section('content')
    @include('partials.errors')

    {{ Form::open(array(
        'files' => true,
        'route' => 'admin.news.store',
    )) }}

        @include('partials.back.form')

        {{ Form::submit('Plaatsen', array(
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
            $("#shows_at").on("dp.change",function (e) {
               $('#expires_at').data("DateTimePicker").setMinDate(e.date);
            });
            $("#expires_at").on("dp.change",function (e) {
               $('#shows_at').data("DateTimePicker").setMaxDate(e.date);
            });
        });
    </script>
@stop