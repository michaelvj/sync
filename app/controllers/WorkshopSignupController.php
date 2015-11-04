<?php

class WorkshopSignupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
     * @param int $workshop_id Id the of the parent workshop
	 * @return Response
	 */
	public function index($workshop_id)
	{
        $workshop = Workshop::with('signups')->findOrFail($workshop_id);

		return View::make('back.signup.index', compact('workshop'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $workshop_id Id of the parent workshop
     * @param int $signup_id Id of the signup
	 * @return Response
	 */
	public function destroy($workshop_id, $signup_id)
	{
        $user = Auth::user();
        $workshop = Workshop::findOrFail($workshop_id);

        if(!$user->hasAccess('workshop.update.other') && !$user->owns($workshop))
        {
            App::abort(403);
        }

        // Delete all selected sign-ups
        Signup::destroy(Input::get('signup'));

        return Redirect::route('admin.workshops.signups.index', $workshop_id);
	}
}
