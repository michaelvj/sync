@extends('front.main')

@section('title')
    {{{ $category->name }}}
@stop

@section('content')
    <div class="panel panel-default category-header clearfix">
        <div class="panel-body">
            <h1 class="pull-left">
                {{ link_to_route('categories', $category->name, array(
                    $category->id,
                    $category->webTitle
                )) }}
            </h1>

            {{ Form::open(array(
                'method' => 'get',
                'route' => array('categories', $category->id, $category->webTitle),
                'class' => 'form-inline pull-right'
            )) }}

            {{ Form::select('sort', array(
                'title' => 'Titel',
                'shows_at' => 'Geplaatst op',
                'updated_at' => 'Bijgewerkt op'
            ), Input::get('sort', 'shows_at'), array(
                'class' => 'form-control'
            )) }}

            {{ Form::select('order', array(
                'asc' => 'Oplopend',
                'desc' => 'Aflopend'
            ), Input::get('order', 'desc'), array(
                'class' => 'form-control'
            )) }}

            {{ Form::submit('Sorteren', array(
                'class' => 'btn btn-primary'
            )) }}
            {{ Form::close() }}
        </div>
    </div>

    @if(count($items) > 0)
        <div class="panel panel-default category">
            <div class="list-group">
                @foreach($items as $item)
                    <section class="list-group-item">
                        <time datetime="{{ $item->shows_at }}" class="text-center pull-left">
                            <p class="h1">{{ $item->shows_at->formatLocalized('%d') }}</p>
                            <p class="h4">{{ $item->shows_at->formatLocalized('%B') }}</p>
                        </time>
                        <div class="media-body">
                            <h1 class="list-group-item-heading ellipsis">
                                {{ link_to_route($item->routeName, $item->title, array($item->id, $item->webTitle)) }}
                            </h1>
                            <p class="list-group-item-text">
                                {{ $item->getExcerptAttribute(50) }}
                            </p>
                            <div class="more">
                                {{ link_to_route($item->routeName, 'Verder lezen&hellip;', array($item->id, $item->webTitle)) }}
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            {{ $items->appends(array(
                'sort' => Input::get('sort', 'shows_at'),
                'order' => Input::get('order', 'desc')
            ))->links() }}
        </div>
    @else
        <section class="col-md-12">
            <div class="panel panel-default no-results">
                <div class="panel-body">
                    <h3>Geen resultaten</h3>
                </div>
            </div>
        </section>
    @endif
@stop