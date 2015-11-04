<?php

use Carbon\Carbon;

class CallController extends BaseNewsController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('back.calls.index', array(
            // Sort by updated_at, newest first
            'news' => News::orderBy('updated_at', 'desc')->calls()->paginate()
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

        return View::make('back.calls.create');
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

        if($news = $this->createNews())
        {
            $news->category_id = 2;

            // Attach to user,
            // Save in database
            $user->news()->save($news);

            // Redirect to news index
            return Redirect::route('admin.calls.index');
        }
        else
        {
            return Redirect::route('admin.calls.create')->withInput()->withErrors($this->validator);
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

        return View::make('back.calls.edit', compact('news'));
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

        if($this->updateNews($news))
        {
            $news->category_id = 2;
            // Save the changes
            $news->save();

            // Redirect to news index
            return Redirect::route('admin.calls.index');
        }
        else
        {
            return Redirect::route('admin.calls.create')->withInput()->withErrors($this->validator);
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

        return Redirect::route('admin.calls.index')->withErrors('Nieuwsbericht verwijderd.');
    }

    public function screen()
    {
        $uncheckedCalls = $_POST['uncheckedCalls'];
        $checkedCalls = $_POST['checkedCalls'];

        foreach(News::whereIn('id', explode(",", $uncheckedCalls))->get() as $news)
        {
            $news->is_screen = false;
            $news->save();
        }        

        foreach(News::whereIn('id', explode(",", $checkedCalls))->get() as $news)
        {
            $news->is_screen = true;
            $news->save();
        }

        return Redirect::back();
    }

}