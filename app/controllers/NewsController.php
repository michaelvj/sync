<?php

use Carbon\Carbon;

class NewsController extends BaseNewsController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('back.news.index', array(
            // Sort by updated_at, newest first
            'news' => News::orderBy('updated_at', 'desc')->news()->paginate()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!Auth::user()->hasAccess('news.create'))
        {
            App::abort(403);
        }

        return View::make('back.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = Auth::user();

        if(!$user->hasAccess('news.create'))
        {
            App::abort(403);
        }

        $news = $this->createNews();

        if($news)
        {
            $news->category_id = 1;

            // Attach to user,
            // Save in database
            $user->news()->save($news);

            // Redirect to news index
            return Redirect::route('admin.news.index');
        }
        else
        {
            return Redirect::route('admin.news.create')->withInput()->withErrors($this->validator);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $news = News::find($id);

        if(!$user->hasAccess('news.update.other') && !$user->owns($news))
        {
            App::abort(403);
        }

        return View::make('back.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = Auth::user();
        $news = News::findOrFail($id);

        if(!$user->hasAccess('news.update.other') && !$user->owns($news))
        {
            App::abort(403);
        }

        $news = $this->updateNews($news);

        if($news)
        {
            $news->category_id = 1;
            // Save the changes
            $news->save();

            // Redirect to news index
            return Redirect::route('admin.news.index');
        }
        else
        {
            return Redirect::route('admin.news.create')->withInput()->withErrors($this->validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $news = News::findOrFail($id);

        if(!$user->hasAccess('news.update.other') && !$user->owns($news))
        {
            App::abort(403);
        }

        // Destroy the news
        $news->delete();

        return Redirect::route('admin.news.index')->withErrors('Nieuwsbericht verwijderd.');
    }

    public function screen()
    {
        $uncheckedNews = $_POST['uncheckedNews'];
        $checkedNews = $_POST['checkedNews'];

        foreach(News::whereIn('id', explode(",", $uncheckedNews))->get() as $news)
        {
            $news->is_screen = false;
            $news->save();
        }        

        foreach(News::whereIn('id', explode(",", $checkedNews))->get() as $news)
        {
            $news->is_screen = true;
            $news->save();
        }

        return Redirect::back();
    }

}