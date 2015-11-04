@foreach($errors->all() as $error)
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ $error }}
    </div>
@endforeach