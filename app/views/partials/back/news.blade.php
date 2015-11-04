@section('script')
@parent
<script type="text/javascript">
    var checkedNews = [];
    var uncheckedNews = [];
    $("[name='news[]']").click(function() {
        if($(this).is(":checked")) {
            if (checkedNews.indexOf($(this).val()) == -1) {
                checkedNews.push($(this).val());
            }
            if (uncheckedNews.indexOf($(this).val()) != -1) {
                uncheckedNews.splice(uncheckedNews.indexOf($(this).val()), 1)
            }
        } else {
            if (uncheckedNews.indexOf($(this).val()) == -1) {
                uncheckedNews.push($(this).val());
            }
            if (checkedNews.indexOf($(this).val()) != -1) {
                checkedNews.splice(checkedNews.indexOf($(this).val()), 1)
            }
        }
        $("[name='checkedNews']").val(checkedNews.join());
        $("[name='uncheckedNews']").val(uncheckedNews.join());
    });
</script>
@stop
{{ Form::open(array(
    'route' => 'admin.news.screen'
)) }}
{{ Form::hidden('checkedNews') }}
{{ Form::hidden('uncheckedNews') }}

<table class="table">
    <thead>
    <tr>
        <th class="text-center">
            <input class="toggle-all" type="checkbox" />
        </th>
        <th>Titel</th>
        <th>Auteur</th>
        <th>Geplaatst op</th>
        <th>Bijgewerkt op</th>
        <th>Verloopt op</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
        @foreach($news as $item)
            @if($item->is_featured)
                <tr class="info">
            @else
                <tr>
            @endif
                <td class="text-center">
                    {{ Form::checkbox('news[]', $item->id, $item->is_screen) }}
                </td>
                <td>
                    {{ link_to_route('admin.news.edit', $item->title, array($item->id)) }}
                </td>
                <td>
                    {{{ $item->user->firstname }}}
                    {{{ $item->user->lastname }}}
                </td>
                <td>
                    {{ $item->created_at->format('H:i, d-m-Y') }}
                </td>
                <td>
                    @if($item->updated_at->gt($item->created_at))
                        {{ $item->updated_at->format('H:i, d-m-Y') }}
                    @else
                        Nooit
                    @endif
                </td>
                <td>
                    @if($item->expires_at === null)
                        Nooit
                    @else
                        {{ $item->expires_at->format('H:i, d-m-Y') }}
                    @endif
                </td>
                <td>
                    @if($user->hasAccess('news.update.other') || $user->owns($item))
                        {{ link_to_route('news', 'Bekijken', array($item->id, $item->webTitle)) }}
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