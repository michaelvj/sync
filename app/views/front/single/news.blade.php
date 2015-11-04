@extends('front.main')

@section('title')
    {{{ $news->title }}}
@stop
<?php $news->featured_visible = true; ?>
@section('content')
    <div class="row">
        <article class="col-md-8">
            <div class="panel content">
                <h1>
                    {{ link_to_route('news', $news->title, array($news->id, $news->webTitle)) }}
                </h1>
                <p class="meta">
                    Door
                    <b>
                        {{{ $news->user->firstname }}} {{{ $news->user->lastname }}}
                    </b>
                    in
                    {{ link_to_route('categories', $news->category->name, array($news->category->id, $news->category->webTitle)) }}
                    op
                    <b>{{ $news->shows_at->formatLocalized('%d %B, %H:%M') }}</b>.
                    @if($news->updated_at->gt($news->shows_at))
                        Laatst bijgewerkt op <b>{{ $news->updated_at->formatLocalized('%d %B, %H:%M') }}</b>.
                    @endif
                </p>
                @if($news->expires_at !== null && $news->expires_at->lte(new \Carbon\Carbon()))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Dit bericht is niet meer geldig.
                    </div>
                @endif
                <p class="clearfix">
                    @if($news->featured_image && $news->featured_visible)
                        <a title="Volledige grootte" class="side-image" target="_blank" href="/assets/uploads/{{ $news->featured_image }}">
                            <img src="/assets/uploads/{{ $news->featured_image }}" alt="Featured image" />
                        </a>
                    @endif
                    {{ $news->text }}
                </p>
            </div>
        </article>
        <aside class="sidebar col-md-4">
            @include('partials.front.sidebar')

        </aside>
    </div>
@stop