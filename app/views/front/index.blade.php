@extends('front.main')

@section('title')
    SYNC
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

<div class="row">
    <div id="ws-carousel" class="col-md-4 carousel slide">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <span class="glyphicon glyphicon-cog pull-left">&nbsp;</span>
                    Workshops
                    @if(ceil(count($workshops) / 3) > 1)
                        <ol class="carousel-indicators pull-right">
                            @for($i = 0; $i < (ceil(count($workshops) / 3)); $i++)
                            @if($i === 0)
                            <li data-target="#ws-carousel" class="active" data-slide-to="{{ $i }}"></li>
                            @else
                            <li data-target="#ws-carousel" data-slide-to="{{ $i }}"></li>
                            @endif
                            @endfor
                        </ol>
                    @endif
                </h2>
            </div>

                <div class="carousel-inner">
                    <?php $i = 0; $first = true;?>
                    @foreach($workshops as $item)
                        @if($first === true)
                            <?php $first = false; ?>
                            <div class="item active">
                        @elseif($i === 0)
                            <div class="item">
                        @endif
                            <section class="list-group-item">
                                <h1 class="list-group-item-heading ellipsis">
                                    {{ link_to_route('workshops', $item->title, array($item->id, $item->webTitle)) }}
                                </h1>
				<img src="/assets/uploads/Il3r7uC7t0.png">
                               <!-- <img class="pull-right" src="http://chart.googleapis.com/chart?cht=qr&chs=100&choe=UTF-8&chld=H&chl={{ url('workshops', $item->id) }}" alt="QR link"/> -->
                                <div class="media-body screen-excerpt">
                                    <p>
                                        {{ $item->excerpt }}
                                    </p>
                                </div>
                            </section>

                        @if($i === 2)
                            </div>
                            <?php $i = -1; ?>
                        @endif
                        <?php $i++; ?>
                    @endforeach
                    @if(count($workshops) % 3 !== 0)
                       <?php $i = 3 - (count($workshops) % 3); ?>
                            @for(; $i > 0; $i--)
                                <section class="list-group-item">
                                    <h1 class="list-group-item-heading">&nbsp;</h1>
                                    <div class="screen-excerpt"></div>
                                </section>
                            @endfor
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <span class="glyphicon glyphicon-warning-sign pull-left">&nbsp;</span>
                        Oproepen
                    </h2>
                </div>
                <div class="list-group">
                    @foreach($notes as $item)
                    <section class="list-group-item">
                        <h1 class="list-group-item-heading ellipsis">
                            {{ link_to_route('news', $item->title, array($item->id, $item->webTitle)) }}
                        </h1>
			<img src="/assets/uploads/Il3r7uC7t0.png">
                       <!-- <img class="pull-right" src="http://chart.googleapis.com/chart?cht=qr&chs=100&choe=UTF-8&chld=H&chl={{ url('news', $item->id) }}" alt="QR link"/> -->
                        <div class="media-body screen-excerpt">
                            <p>
                                {{ $item->excerpt }}
                            </p>
                        </div>
                    </section>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <span class="glyphicon glyphicon-bullhorn pull-left">&nbsp;</span>
                        Nieuws
                    </h2>
                </div>
                <div class="list-group">
                    @foreach($news as $item)
                    <section class="list-group-item">
                        <h1 class="list-group-item-heading ellipsis">
                            {{ link_to_route('news', $item->title, array($item->id, $item->webTitle)) }}
                        </h1>
			<img src="/assets/uploads/Il3r7uC7t0.png">
                       <!-- <img class="pull-right" src="http://chart.googleapis.com/chart?cht=qr&chs=100&choe=UTF-8&chld=H&chl={{ url('news', $item->id) }}" alt="QR link"/> -->
                        <div class="media-body screen-excerpt">
                            <p>
                                {{ $item->excerpt }}
                            </p>
                        </div>
                    </section>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
