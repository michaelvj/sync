<nav class="list-group">
    {{ HTML::side_nav_link('admin.news.index', 'Nieuws', null, array('class' => 'list-group-item')) }}
    {{ HTML::side_nav_link('admin.calls.index', 'Oproepen', null, array('class' => 'list-group-item')) }}
    {{ HTML::side_nav_link('admin.workshops.index', 'Workshops', null, array('class' => 'list-group-item')) }}

    @if($user->hasAccess('user.show'))
        {{ HTML::side_nav_link('admin.users.index', 'Gebruikers', null, array('class' => 'list-group-item')) }}
    @endif

    <hr />
    <a href="{{ route('home') }}" target="_blank" class="list-group-item">
        Naar de website
        <span class="glyphicon glyphicon-new-window"></span>
    </a>

    {{ link_to_route('logout', 'Uitloggen', null, array('class' => 'list-group-item logout')) }}
</nav>