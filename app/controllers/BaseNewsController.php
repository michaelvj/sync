<?php
/**
 * User: Tom
 * Date: 8/28/14
 * Time: 8:56 AM
 */

use Carbon\Carbon;

class BaseNewsController extends Controller {

    public $validator;

    /**
     * @return News
     */
    protected function createNews(){
        $input = Input::all();
        // Sanitize text
        $input['text'] = Purifier::clean($input['text']);

        $this->validator = News::validate($input);

        if($this->validator->passes())
        {
            // Fill without dates because those have to be converted
            // manually.
            $news = new News(array_except($input, array(
                'shows_at',
                'expires_at',
                'featured_image'
            )));

            $news->shows_at = ($input['shows_at'] === '') ? new Carbon() : new Carbon($input['shows_at']);
            // Either null or datetime
            $news->expires_at = ($input['expires_at'] === '') ? null : new Carbon($input['expires_at']);

            // Is not sent when unchecked
            $news->is_featured = (isset($input['is_featured'])) ? (bool) $input['is_featured'] : false;

            $news->is_screen = (isset($input['is_screen'])) ? (bool) $input['is_screen'] : false;

            if(Input::hasFile('featured_image') && $input['featured_image']->isValid())
            {
                $filename = $news->featured_image = Str::random(10) . '.' . $input['featured_image']->guessExtension();

                $input['featured_image']->move(base_path('assets/uploads'), $filename);

                $news->featured_visible = true;
            }

            return $news;
        }
    }

    protected function updateNews($news)
    {
        $input = Input::all();

        // Sanitize text
        $input['text'] = Purifier::clean($input['text']);

        $validator = News::validate($input);

        if($validator->passes())
        {
            // Fill without dates because those have to be converted
            // manually.
            $news->fill(array_except($input, array(
                'shows_at',
                'expires_at',
                'featured_image'
            )));

            $news->shows_at = ($input['shows_at'] === '') ? new Carbon() : new Carbon($input['shows_at']);
            // Either null or datetime
            $news->expires_at = ($input['expires_at'] === '') ? null : new Carbon($input['expires_at']);

            // Is not sent when unchecked
            $news->is_featured = (isset($input['is_featured'])) ? (bool) $input['is_featured'] : false;

            $news->is_screen = (isset($input['is_screen'])) ? (bool) $input['is_screen'] : false;

            if(Input::hasFile('featured_image') && $input['featured_image']->isValid())
            {
                $filename = $news->featured_image = Str::random(10) . '.' . $input['featured_image']->guessExtension();

                $input['featured_image']->move(base_path('assets/uploads'), $filename);

                $news->featured_visible = true;
            }

            return $news;
        }

        return false;
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
} 