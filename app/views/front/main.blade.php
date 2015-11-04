<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no">

    <title>@yield('title') &ndash; SYNC</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/front-end.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="/refresh.ico"/>
    
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="fader"></div>

    @include('partials.front.topnav')

    <div class="container">
        @yield('content')
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/js/jquery.js"><\/script>')</script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/front-end.js" ></script>
    <script src="/assets/js/moment/moment.min.js"></script>
    <script src="/assets/js/moment/nl.js"></script>
    @yield('script')
</body>
</html>