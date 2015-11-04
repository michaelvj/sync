<div class="panel panel-default">
    <div class="panel-heading">
        Uitgelicht
    </div>
    <div class="list-group">
        @foreach($featured as $item)
            <a href="{{ route($item->routeName, array($item->id, $item->webTitle)) }}" class="list-group-item">
                <h4 class="list-group-item-heading">
                    {{{ $item->title }}}
                    <span class="text-muted pull-right">
                        {{ $item->shows_at->formatLocalized('%d %B') }}
                    </span>
                </h4>
                <p class="list-group-item-text">
                    {{ $item->excerpt }}
                </p>
            </a>
        @endforeach
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        {{ link_to_route('workshops', 'Workshops', null, array('class' => 'panel-title')) }}
    </div>
    <div class="list-group">
        @foreach(Workshop::visible()->take(3)->orderBy('shows_at', 'desc')->get() as $item)
            <a href="{{ route('workshops', array($item->id, $item->webTitle)) }}" class="list-group-item">
                <h4 class="list-group-item-heading">
                    {{{ $item->title }}}
                        <span class="text-muted pull-right">
                            {{ $item->shows_at->formatLocalized('%d %B') }}
                        </span>
                </h4>
                <p class="list-group-item-text">
                    {{ $item->excerpt }}
                </p>
            </a>
        @endforeach
    </div>
</div>

@foreach(Category::with(array('news' => function($query){
    return $query->visible()->where('is_featured', '=', false);
}))->get() as $category)
    @if(count($category->news) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ link_to_route('categories', $category->name, array($category->id, $category->webTitle), array('class' => 'panel-title')) }}
            </div>
            <div class="list-group">
                <?php $news = $category->news->sortBy('shows_at')->reverse()->take(3); ?>
                @foreach($news as $item)
                    <a href="{{ route('news', array($item->id, $item->webTitle)) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">
                            {{{ $item->title }}}
                            <span class="text-muted pull-right">
                                {{ $item->shows_at->formatLocalized('%d %B') }}
                            </span>
                        </h4>
                        <p class="list-group-item-text">
                            {{ $item->excerpt }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endforeach