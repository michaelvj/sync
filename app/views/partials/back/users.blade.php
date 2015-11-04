<table class="table">
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Groep</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $item)
            <tr>
                <td>{{{ $item->firstname }}}</td>
                <td>{{{ $item->lastname }}}</td>
                <td>{{{ $item->email }}}</td>
                <td>{{ $item->group->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>