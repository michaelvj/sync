@if(count($items) > 0)
    @foreach($items as $item)
        <section class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{ link_to_route($item->routeName, $item->title, array($item->id, $item->webTitle), array('title' => $item->title)) }}</h3>
                    <p class="excerpt">
                        {{ $item->excerpt }}
                    </p>
                    @if($item->is_featured OR $item->category)
                    <p class="category">
                        @if($item->is_featured)
                            <span class="glyphicon glyphicon-star" title="Uitgelicht"></span>
                        @endif

                        @if($item->category)
                            {{ link_to_route('categories', $item->category->name, array($item->category->id, $item->category->webTitle)) }}
                        @endif
                    </p>
                    @endif
                </div>
                <div class="panel-footer clearfix">
                    @if ($item->routeName == "workshops")
                        <p class="pull-left">{{ $item->begins_at->format('H:i, d M') }}</p>
                    @else
                        <p class="pull-left">{{ $item->shows_at->format('H:i, d M') }}</p>
                    @endif
                    @if(!is_null($item->user)) 
                        <p class="pull-right">
                            {{{ $item->user->firstname[0] }}}.
                            {{{ $item->user->lastname }}}
                        </p>
                    @endif
                </div>
            </div>
        </section>
    @endforeach

    @if($items instanceOf \Illuminate\Pagination\Paginator)
        <div class="col-xs-12 text-center">
            {{ $items->fragment('posts')->links() }}
        </div>
    @endif
@else
    <section class="col-md-12">
        <div class="panel panel-default no-results">
            <div class="panel-body">
                <h3>Geen resultaten</h3>
            </div>
        </div>
    </section>
@endif