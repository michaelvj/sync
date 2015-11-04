@extends('back.main')

@section('title')
    {{{ $workshop->title }}} Aanpassen
@stop

@section('topnav')
    <a href="{{ route('admin.workshops.create') }}" class="btn btn-default navbar-btn">
        <span class="glyphicon glyphicon-calendar"></span>
        Nieuwe workshop
    </a>

    {{ Form::open(array(
        'route' => array('admin.workshops.destroy', $workshop->id),
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

    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    {{ link_to_route('admin.workshops.edit', 'Workshop', array($workshop->id)) }}
                </li>
                <li >
                    {{ link_to_route('admin.workshops.signups.index', 'Inschrijvingen', array($workshop->id)) }}
                </li>
            </ul>
        </div>
    </div>
    {{ Form::model($workshop, array(
        'files' => true,
        'method' => 'PUT',
        'route' => array(
        'admin.workshops.update',
            $workshop->id
        )
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
                    {{ Form::input('number', 'max_signups', null, array(
                    'class' => 'form-control',
                    'min' => 1,
                    'required'
                    )) }}
                </div>
            </div>
        </div>
    </fieldset>
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

            $('#begins_at').datetimepicker();
            $('#ends_at').datetimepicker();

            if(typeof $('#ends_at').data("DateTimePicker").date._i != "undefined")
                $('#begins_at').data("DateTimePicker").setMinDate($('#ends_at').data("DateTimePicker").date);
            if(typeof $('#begins_at').data("DateTimePicker").date._i != "undefined")
                $('#ends_at').data("DateTimePicker").setMaxDate($('#begins_at').data("DateTimePicker").date);

            $("#begins_at").on("dp.change",function (e) {
               $('#ends_at').data("DateTimePicker").setMinDate(e.date);
            });
            $("#ends_at").on("dp.change",function (e) {
               $('#begins_at').data("DateTimePicker").setMaxDate(e.date);
            });
        });
        
    </script>
@stop