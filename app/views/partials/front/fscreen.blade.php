@if(count($featured) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                Uitgelicht
            </h2>
        </div>
        <div class="list-group screen">
            @foreach($featured as $item)
                <section class="list-group-item featured">
                    <div class="pull-left screentime">
                        @if($item->routeName === 'workshops')
                            <time datetime="{{ $item->shows_at }}" class="text-center pull-left">
                                <p class="h1">{{ $item->begins_at->formatLocalized('%d') }}</p>
                                <p class="h4">{{ $item->begins_at->formatLocalized('%B') }}</p>
                            </time>
                            <span class="glyphicon glyphicon-cog pull-left text-center"></span>
                        @elseif($item->routeName === 'news')
                            <time datetime="{{ $item->shows_at }}" class="text-center pull-left">
                                <p class="h1">{{ $item->shows_at->formatLocalized('%d') }}</p>
                                <p class="h4">{{ $item->shows_at->formatLocalized('%B') }}</p>
                            </time>
                            <span class="glyphicon glyphicon-bullhorn pull-left text-center"></span>
                        @endif
                    </div>

                    <div id="carousel-{{ $item->id }}" class="carousel slide pull-right hidden-xs">
                        <div class="carousel-inner">
                            <div class="item active text-center">
                                <img src="http://chart.googleapis.com/chart?cht=qr&chs=150x150&choe=UTF-8&chld=H&chl={{ url($item->routeName, $item->id) }}" alt="QR link"/>
                            </div>

                            @if($item->featured_image && $item->featured_visible)
                                <div class="item text-center">
                                    <img src="/assets/uploads/{{ $item->featured_image }}" />
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="media-body">
                        <h1 class="list-group-item-heading ellipsis">
                            {{ link_to_route($item->routeName, $item->title, array($item->id, $item->webTitle)) }}
                        </h1>
                        <p class="list-group-item-text">
                            {{ $item->getExcerptAttribute(40) }}
                        </p>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
@endif