@extends('back.main')

@section('title')
    Nieuwe Workshop
@stop

@section('content')

    @include('partials.errors')

    {{ Form::open(array(
        'files' => true,
        'route' => 'admin.workshops.store',
    )) }}

    @include('partials.back.form')

    <fieldset>
        <legend>Workshop details</legend>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group">
                    {{ Form::label('teacher_name', 'Naam leraar') }}
                    {{ Form::text('teacher_name', null, array(
                        'class' => 'form-control',
                        'maxlength' => 100,
                        'required'
                    )) }}
                </div>
                <div class="form-group">
                    {{ Form::label('teacher_email', 'Email leraar') }}
                    {{ Form::email('teacher_email', null, array(
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'required'
                    )) }}
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Locatie') }}
                    {{ Form::text('location', null, array(
                        'class' => 'form-control',
                        'maxlength' => 50,
                        'required'
                    )) }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
                <div class="form-group">
                    {{ Form::label('begins_at', 'Begint op') }}
                    {{ Form::text('begins_at', null, array(
                        'class' => 'form-control'
                    )) }}
                </div>
                <div class="form-group">
                    {{ Form::label('ends_at', 'Eindigt op') }}
                    {{ Form::text('ends_at', null, array(
                        'class' => 'form-control'
                    )) }}
                </div>
                <div class="form-group">
                    {{ Form::label('max_signups', 'Maximaal aantal deelnemers') }}
                    {{ Form::input('number', 'max_signups', 20, array(
                        'class' => 'form-control',
                        'min' => 0,
                        'required'
                    )) }}
                </div>
            </div>
        </div>
    </fieldset>
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
            
            $('#begins_at').datetimepicker();
            $('#ends_at').datetimepicker();
            
            $("#begins_at").on("dp.change",function (e) {
               $('#ends_at').data("DateTimePicker").setMinDate(e.date);
            });
            $("#ends_at").on("dp.change",function (e) {
               $('#begins_at').data("DateTimePicker").setMaxDate(e.date);
            });
            
        });
    </script>
@stop