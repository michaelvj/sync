<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Create a group of routes that:
 * Require Authentication
 * Starts with /admin
 */
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function ()
{
    // Main admin panel
    Route::get('/', array(
        'as' => 'admin',
        function ()
        {
            return View::make('back.index', array(
                'news'      => News::with('user')
                                ->news()
                                ->orderBy('updated_at', 'desc')
                                ->take(5)->get(),
                'calls'     => News::with('user')
                                ->calls()
                                ->orderBy('updated_at', 'desc')
                                ->take(5)->get(),
                'workshops' => Workshop::with('user')->orderBy('updated_at', 'desc')->take(5)->get()
            ));
        }
    ));
    /*
     * index    news            GET
     * create   news/create     GET
     * save     news            POST
     * edit     news/{id}/edit  GET
     * update   news/{id}       POST
     *
     * There is no show because that's for the frontend
     */
    // Users
    Route::resource('users', 'UserController', array(
        'except' => array('show', 'edit', 'update', 'destroy') // Pretty barebone because we're moving to tango soon
    ));

    // News
    Route::resource('news', 'NewsController', array(
        'except' => array('show'),
    ));

    Route::post('news/screen', array(
        'as'   => 'admin.news.screen',
        'uses' => 'NewsController@screen'
    ));

    Route::resource('calls', 'CallController', array(
        'except' => array('show'),
    ));

    Route::post('calls/screen', array(
        'as'   => 'admin.calls.screen',
        'uses' => 'CallController@screen'
    ));

    // Workshops
    Route::resource('workshops', 'WorkshopController', array(
        'except' => array('show'),
    ));

    Route::post('workshops/screen', array(
        'as'   => 'admin.workshops.screen',
        'uses' => 'WorkshopController@screen'
    ));

    // Signups
    // Nested in workshops
    Route::resource('workshops.signups', 'WorkshopSignupController', array(
        'only' => array('index', 'destroy')
    ));
});

// Login Form
Route::get('login', array(
    'as' => 'login',
    function ()
    {
        return View::make('front.login');
    }
));
// Actually login
Route::post('login', 'UserController@login');

// Log out
Route::get('logout', array(
    'as'   => 'logout',
    'uses' => 'UserController@logout'
));


// Entire frontend
Route::controller('/', 'FrontController', array(
    'getIndex'     => 'home',
    'getNews'      => 'news',
    'getCalls'     => 'calls',
    'getWorkshops' => 'workshops',
    'getCategory'  => 'categories',
    'getScreen'    => 'screen'
));

// General errors

if(!Config::get('app.debug'))
{
    App::error(function(Exception $exception, $code)
    {
        if($code === 403)
        {
            return Response::view('403', array(), 403);
        }

        return 'Er ging iets fout. Ga terug en probeer opnieuw.';
    });

// Not found
    App::error(function(\Illuminate\Database\Eloquent\ModelNotFoundException $exception)
    {
        return Response::view('404', array(), 404);
    });
    App::missing(function($exception)
    {
        return Response::view('404', array(), 404);
    });
}

