{{ Form::label('text', 'Bericht') }}
<div id="text-toolbar" style="display: none;">
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