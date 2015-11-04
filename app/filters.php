<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/**
 * Link with auto active class
 *
 * @param $route The route's name
 * @param $title The link text
 * @param $parameters The route's parameters
 * @return string Link wrapped in <li> with optional active class
 */
HTML::macro('top_nav_link', function($route, $title, $parameters = array()){
    $uri = route($route, $parameters);
    $html = '<li ';

    if(starts_with(Request::url(), $uri))
    {
        $html .= 'class="active" ';
    }

    $html .= '>' . link_to($uri, $title) . '</li>';

    return $html;
});

/**
 * Sidebar link with auto active class
 *
 * @param $route The route's name
 * @param $title The link text
 * @param $parameters The route's parameters
 * @param $attributes The attributes for the link
 * @return string Link with optional active class
 */
HTML::macro('side_nav_link', function($route, $title, $parameters = array(), $attributes = array())
{
    $uri = route($route, $parameters);

    if(starts_with(Request::url(), $uri))
    {
        // Append class
        if(isset($attributes['class']))
        {
            $attributes['class'] .= ' active';
        }
        // Set class
        else
        {
            $attributes['class'] = 'active';
        }
    }

    return link_to($uri, $title, $attributes);
});

/**
 * Add featured items to all single layouts
 */
View::composer('partials.front.sidebar', function($view)
{
    $news = News::visible()->featured()->take(3)->get();
    $workshops = Workshop::visible()->featured()->take(3)->get();

    $featured = $news->merge($workshops)->sortBy('shows_at')->reverse();

    $view->with('featured', $featured);
});

/**
 * Add User to all admin layouts
 */
View::composer('back.*', function($view)
{
    $view->with('user', Auth::user());
});