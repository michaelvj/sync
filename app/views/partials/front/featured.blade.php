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
                        <time datetime="{{ $item->showdate }}" class="text-center pull-left">
                            <p class="h1">{{ $item->showdate->formatLocalized('%d') }}</p>
                            <p class="h4">{{ $item->showdate->formatLocalized('%B') }}</p>
                        </time>
                        @if($item->routeName === 'workshops')
                            <span class="glyphicon glyphicon-cog pull-left text-center"></span>
                        @elseif($item->routeName === 'news')
                            <span class="glyphicon glyphicon-bullhorn pull-left text-center"></span>
                        @endif
                    </div>
                    
                    @if($item->featured_image && $item->featured_visible)
                        <div id="carousel-{{ $item->id }}" class="carousel slide pull-right hidden-xs" data-ride="carousel">
                            <div>
                                <div class="item text-center">
                                    <img src="/assets/uploads/{{ $item->featured_image }}" />
                                </div>
                            </div>
                        </div>
                    @endif


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