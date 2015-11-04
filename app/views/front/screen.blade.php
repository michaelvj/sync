@extends('front.main')

@section('title')
    Screen
@stop

@section('script')
    <script type="text/javascript">
        setInterval(function(){
            window.location.reload();
        }, 5 * 60 * 1000);
        
        $(document).ready(function () {
            $('.carousel').carousel({
                interval: 10000
            });
        });
    </script>
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
                    @for($i = 1; $i <= (ceil(count($workshops) / 3)); $i++)
                        @if($i === 1)
                            <div class="item active">
                        @else
                            <div class="item">
                        @endif
                            @for($x = 0; $x < 3; $x++)
                                @if(isset($workshops[$x * $i]))
                                    <?php $item = $workshops[$x * $i]; ?>
                                    <section class="list-group-item">
                                        <h1 class="list-group-item-heading ellipsis">
                                            {{ link_to_route('workshops', $item->title, array($item->id, $item->webTitle)) }}
                                        </h1>
                                        <img class="pull-right" src="http://chart.googleapis.com/chart?cht=qr&chs=100&choe=UTF-8&chld=H&chl={{ url('workshops', $item->id) }}" alt="QR link"/>
                                        <div class="media-body screen-excerpt">
                                            <p>
                                                {{ $item->excerpt }}
                                            </p>
                                        </div>
                                    </section>
                                @elseif($i !== 1)
                                    <section class="list-group-item">
                                        <h1 class="list-group-item-heading">&nbsp;</h1>
                                        <div class="screen-excerpt"></div>
                                    </section>
                                @endif
                            @endfor
                        </div>
                    @endfor
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
                            <img class="pull-right" src="http://chart.googleapis.com/chart?cht=qr&chs=100&choe=UTF-8&chld=H&chl={{ url('news', $item->id) }}" alt="QR link"/>
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
                            <img class="pull-right" src="http://chart.googleapis.com/chart?cht=qr&chs=100&choe=UTF-8&chld=H&chl={{ url('news', $item->id) }}" alt="QR link"/>
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