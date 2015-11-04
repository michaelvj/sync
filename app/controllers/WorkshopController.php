<?php

use Carbon\Carbon;

class WorkshopController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('back.workshop.index', array(
            // Sort by title, a -> z
            'workshops' => Workshop::orderBy('title', 'asc')->paginate()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!Auth::user()->hasAccess('workshop.create'))
        {
            App::abort(403);
        }

        return View::make('back.workshop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = Auth::user();

        if(!$user->hasAccess('workshop.create'))
        {
            App::abort(403);
        }

        $input = Input::all();
        // Sanitize text
        $input['text'] = Purifier::clean($input['text']);

        $validator = Workshop::validate($input);

        if($validator->passes())
        {
            // Fill without dates because those have to be converted
            // manually.
            $workshop = new Workshop(array_except($input, array(
                'shows_at',
                'expires_at',
                'begins_at',
                'ends_at'
            )));

            $workshop->shows_at = ($input['shows_at'] === '') ? new Carbon() : new Carbon($input['shows_at']);
            // Either null or datetime
            $workshop->expires_at = ($input['expires_at'] === '') ? null : new Carbon($input['expires_at']);

            $workshop->begins_at = new Carbon($input['begins_at']);
            $workshop->ends_at  = new Carbon($input['ends_at']);

            // Is not sent when unchecked
            $workshop->is_featured = (isset($input['is_featured'])) ? (bool) $input['is_featured'] : false;

            if(Input::hasFile('featured_image') && $input['featured_image']->isValid())
            {
                $filename = $workshop->featured_image = Str::random(10) . '.' . $input['featured_image']->guessExtension();

                $input['featured_image']->move(base_path('assets/uploads'), $filename);

                $workshop->featured_visible = true;
            }

            // Attach to user,
            // Save in database
            $user->workshops()->save($workshop);

            return Redirect::route('admin.workshops.index');
        }
        else
        {
            return Redirect::route('admin.workshops.create')->withInput()->withErrors($validator);
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
        $workshop = Workshop::findOrFail($id);

        if(!$user->hasAccess('workshop.update.other') && !$user->owns($workshop))
        {
            App::abort(403);
        }

        return View::make('back.workshop.edit', array(
            'workshop' => $workshop
        ));
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

        $workshop = Workshop::findOrFail($id);

        if(!$user->hasAccess('workshop.update.other') && !$user->owns($workshop))
        {
            App::abort(403);
        }

        $input = Input::all();
        // Sanitize text
        $input['text'] = Purifier::clean($input['text']);

        $validator = Workshop::validate($input);

        if($validator->passes())
        {
            // Fill without dates because those have to be converted
            // manually.
            $workshop->fill(array_except($input, array(
                'shows_at',
                'expires_at',
                'begins_at',
                'ends_at'
            )));

            $workshop->shows_at = ($input['shows_at'] === '') ? new Carbon() : new Carbon($input['shows_at']);
            // Either null or datetime
            $workshop->expires_at = ($input['expires_at'] === '') ? null : new Carbon($input['expires_at']);

            $workshop->begins_at = new Carbon($input['begins_at']);
            $workshop->ends_at  = new Carbon($input['ends_at']);

            // Is not sent when unchecked
            $workshop->is_featured = (isset($input['is_featured'])) ? (bool) $input['is_featured'] : false;

            if(Input::hasFile('featured_image') && $input['featured_image']->isValid())
            {
                $filename = $workshop->featured_image = Str::random(10) . '.' . $input['featured_image']->guessExtension();

                $input['featured_image']->move(base_path('assets/uploads'), $filename);

                $workshop->featured_visible = true;
            }

            // Save in database
            $workshop->save();

            return Redirect::route('admin.workshops.index');
        }
        else
        {
            return Redirect::route('admin.workshops.create')->withInput()->withErrors($validator);
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
        $workshop = Workshop::findOrFail($id);

        if(!$user->hasAccess('workshop.update.other') && !$user->owns($workshop))
        {
            App::abort(403);
        }

        // Destroy the Workshop
        $workshop->delete();

        return Redirect::route('admin.workshops.index')->withErrors('Workshop verwijderd.');
    }

    public function screen()
    {
        $uncheckedWorkshops = $_POST['uncheckedWorkshops'];
        $checkedWorkshops = $_POST['checkedWorkshops'];

        foreach(Workshop::whereIn('id', explode(",", $uncheckedWorkshops))->get() as $workshop)
        {
            $workshop->is_screen = false;
            $workshop->save();
        }        

        foreach(Workshop::whereIn('id', explode(",", $checkedWorkshops))->get() as $workshop)
        {
            $workshop->is_screen = true;
            $workshop->save();
        }

        return Redirect::back();
    }

}