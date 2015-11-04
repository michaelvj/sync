<h1>Workshop: {{{ $workshop->title }}}</h1>
<p>Van {{ $workshop->begins_at->formatLocalized('%d %B, %H:%M') }} tot {{ $workshop->ends_at->formatLocalized('%d %B, %H:%M') }}</p>
<p>Leraar: {{{ $workshop->teacher_name }}}</p>
<p>Locatie: {{{ $workshop->location }}}</p>
<br />
<small>Gestuurd door SYNC. Je ontvangt deze mail omdat je bent ingeschreven voor deze workshop. Dit is een &eacute;&eacute;nmalig bericht.</small>