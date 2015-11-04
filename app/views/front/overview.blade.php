@extends('front.main')

@section('title')
    {{ $title or "" }}
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        @include('partials.front.featured')
    </div>

    <div class="col-md-4">
        @include('partials.front.weather')
    </div>
</div>

<div id="posts" class="row items">
    @include('partials.front.posts')
</div>
@stop