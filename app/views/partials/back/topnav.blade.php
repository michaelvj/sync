<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            {{ link_to_route('admin', 'SYNC', null, array('class' => 'navbar-brand')) }}

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="main-nav">
            <div class="context-menu-xs btn-group btn-group-justified visible-xs">@yield('topnav')</div>

            <ul class="nav navbar-nav visible-xs">
                <li class="nav-divider"></li>
                {{ HTML::top_nav_link('admin.news.index', 'Nieuws') }}
                {{ HTML::top_nav_link('admin.workshops.index', 'Workshops') }}
                <li class="nav-divider"></li>
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        Naar de website
                        <span class="glyphicon glyphicon-new-window"></span>
                    </a>
                </li>
                <li>
                    {{ link_to_route('logout', 'Uitloggen') }}
                </li>
            </ul>

            <div class="context-menu pull-right hidden-xs">
                @yield('topnav')
            </div>

        </div>
    </div>
</nav>