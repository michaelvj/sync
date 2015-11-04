
<div class="form-group">
    {{ Form::label('title', 'Titel') }}
    {{ Form::text('title', null, array(
        'class' => 'form-control',
        'maxlength' => 100,
        'autofocus',
        'required'
    )) }}
</div>

<div class="row">
    <div class="col-xs-12 col-sm-9">
        <div class="form-group">
            {{ Form::label('featured_image', 'Afbeelding') }}
            {{ Form::file('featured_image', array(
            'class' => 'form-control',
            'accept' => 'image/*'
            )) }}
        </div>
    </div>
    <div class="hidden-xs col-sm-3 preview">
        <b>Huidige afbeelding</b>
        <div class="thumbnail text-center">
            @if(isset($news) && $news->featured_image && $news->featured_visible)
                <img class="img-responsive" src="/assets/uploads/{{ $news->featured_image }}" />
            @elseif(isset($workshop) && $workshop->featured_image && $workshop->featured_visible)
                <img class="img-responsive" src="/assets/uploads/{{ $workshop->featured_image }}" />
            @else
                <span class="glyphicon glyphicon-picture"></span>
                Geen afbeelding
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('text', 'Bericht') }}
    <div id="text-toolbar">
        <div class="btn-group">
            <a class="btn btn-default" data-wysihtml5-command="bold">
                <span class="glyphicon glyphicon-bold"></span>
            </a>
            <a class="btn btn-default" data-wysihtml5-command="italic">
                <span class="glyphicon glyphicon-italic"></span>
            </a>
        </div>
        <a class="btn btn-default" data-wysihtml5-command="createLink">
            <span class="glyphicon glyphicon-link"></span>
        </a>
        <div data-wysihtml5-dialog="createLink" class="form-inline" style="display: none;">
            <div class="input-group">
                <input data-wysihtml5-dialog-field="href" value="http://" class="form-control">
                <div class="input-group-btn">
                    <a class="btn btn-default" data-wysihtml5-dialog-action="save">
                        <span class="glyphicon glyphicon-ok"></span>
                    </a>
                    <a class="btn btn-default" data-wysihtml5-dialog-action="cancel">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{ Form::textarea('text', null, array(
        'class' => 'form-control',
        'required'
    )) }}
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('is_featured') }}
                    Dit is een uitgelicht artikel
                </label>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('is_screen') }}
                    Dit artikel verschijnt op het nieuws-scherm
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            {{ Form::label('shows_at', 'Zichtbaar vanaf') }}
            {{ Form::input('text', 'shows_at', null, array(
            'class' => 'form-control'
            )) }}
                <span class="help-block">
                    Een leeg veld betekent direct zichtbaar.
                </span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            {{ Form::label('expires_at', 'Verloopt op') }}
            {{ Form::input('text', 'expires_at', null, array(
            'class' => 'form-control'
            )) }}
                    <span class="help-block">
                        Een leeg veld betekent oneindig houdbaar.
                    </span>
        </div>
    </div>
</div>