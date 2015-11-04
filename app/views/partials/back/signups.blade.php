<table class="table">
    <thead>
        <tr>
            <th>Stamnummer</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th class="text-center">
                <input class="toggle-all" type="checkbox" />
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($workshop->signups as $item)
            <tr>
                <td>{{{ $item->student_number }}}</td>
                <td>{{{ $item->firstname }}}</td>
                <td>{{{ $item->lastname }}}</td>
                <td>
                    <a href="mailto:{{{ $item->email }}}">
                        {{{ $item->email }}}
                    </a>
                </td>
                <td class="text-center">
                    {{ Form::checkbox('signup[]', $item->id) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>