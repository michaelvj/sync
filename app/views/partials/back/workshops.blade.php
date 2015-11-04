@section('script')
<script type="text/javascript">
    var checkedWorkshops = [];
    var uncheckedWorkshops = [];
    $("[name='workshop[]']").click(function() {
        if($(this).is(":checked")) {
            if (checkedWorkshops.indexOf($(this).val()) == -1) {
                checkedWorkshops.push($(this).val());
            }
            if (uncheckedWorkshops.indexOf($(this).val()) != -1) {
                uncheckedWorkshops.splice(uncheckedWorkshops.indexOf($(this).val()), 1)
            }
        } else {
            if (uncheckedWorkshops.indexOf($(this).val()) == -1) {
                uncheckedWorkshops.push($(this).val());
            }
            if (checkedWorkshops.indexOf($(this).val()) != -1) {
                checkedWorkshops.splice(checkedWorkshops.indexOf($(this).val()), 1)
            }
        }
        $("[name='checkedWorkshops']").val(checkedWorkshops.join());
        $("[name='uncheckedWorkshops']").val(uncheckedWorkshops.join());
    });
</script>
@stop
{{ Form::open(array(
    'route' => 'admin.workshops.screen'
)) }}
{{ Form::hidden('checkedWorkshops') }}
{{ Form::hidden('uncheckedWorkshops') }}
<table class="table">
    <thead>
        <tr>
            <th class="text-center">
                <input class="toggle-all" type="checkbox" />
            </th>
            <th>Titel</th>
            <th>Docent</th>
            <th>Datum workshop</th>
            <th>Verloopt op</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php $today = new \Carbon\Carbon(); ?>
        @foreach($workshops as $item)
            @if($item->is_featured)
                <tr class="info">
            @else
                <tr>
            @endif
                <td class="text-center">
                    {{ Form::checkbox('workshop[]', $item->id, $item->is_screen) }}
                </td>
                <td>
                    {{ link_to_route('admin.workshops.edit', $item->title, array($item->id)) }}
                </td>
                <td>
                    {{{ $item->teacher_name }}}
                </td>
                <td>
                    {{ $item->created_at->format('H:i, d-m-Y') }}
                </td>
                <td>
                    @if($item->expires_at === null)
                        Nooit
                    @else
                        {{ $item->expires_at->format('H:i, d-m-Y') }}
                    @endif
                </td>
                <td>
                    {{ link_to_route('admin.workshops.signups.index', 'Inschrijvingen', array($item->id)) }}
                </td>
                <td>
                    @if($user->hasAccess('workshop.edit.other') || $user->owns($item))
                        {{ link_to_route('workshops', 'Bekijken', array($item->id, $item->webTitle)) }}
                    @else
                        &nbsp;
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-center">
                <input class="toggle-all" type="checkbox" />
            </td>
            <td colspan="7">
                {{ Form::submit('Zet selectie op nieuws-scherm', array(
                    'class' => 'btn btn-primary btn-xs'
                )) }}
            </td>
        </tr>
    </tfoot>
</table>

{{ Form::close() }}