<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SYNC</a>
        </div>

        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="nav navbar-nav">
                {{ HTML::top_nav_link('news', 'Nieuws') }}
                {{ HTML::top_nav_link('calls', 'Oproepen') }}
                {{ HTML::top_nav_link('workshops', 'Workshops') }}
            </ul>
            <p id="clock" class="navbar-text navbar-right">
            </p>
        </div>
    </div>
</nav>