<h1>Workshop: {{{ $workshop->title }}}</h1>
<p>Van {{ $workshop->begins_at->formatLocalized('%d %B, %H:%M') }} tot {{ $workshop->ends_at->formatLocalized('%d %B, %H:%M') }}</p>
<p>Locatie: {{{ $workshop->location }}}</p>

<h2>Inschrijvingen:</h2>
<table>
    @foreach($workshop->signups as $signup)
        <tr>
            <td>{{{ $signup->student_number }}}</td>
            <td>{{{ $signup->firstname }}} {{{ $signup->lastname }}}</td>
            <td>{{{ $signup->email }}}</td>
        </tr>
    @endforeach
</table>
<br />
<small>Gestuurd door SYNC. Je ontvangt deze mail omdat je bent ingeschreven voor deze workshop. Dit is een &eacute;&eacute;nmalig bericht.</small>