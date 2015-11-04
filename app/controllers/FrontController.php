<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 3/27/14
 * Time: 1:30 PM
 */

class FrontController extends BaseController {

    /**
     * Get index
     *
     * @return Response
     */
    public function getIndex()
    {
        $featured_news = News::visible()
            ->where('is_screen', '=', true)
            ->featured()
            ->orderBy('shows_at', 'desc')            
            ->take(1)
            ->get();
        
        $featured_workshop = Workshop::visible()
            ->where('is_screen', '=', true)
            ->featured()
            ->orderBy('begins_at', 'desc')
            ->take(2)
            ->get()
            ->sortBy('begins_at');
        
        if (count($featured_workshop) == 0 && count($featured_news) > 0)
        {
            $featured = News::visible()
                ->where('is_screen', '=', true)
                ->featured()
                ->orderBy('shows_at', 'desc')            
                ->take(2)
                ->get();
        }
        elseif (count($featured_workshop) == 1 && count($featured_news) > 0) 
        {
            if ($featured_news[0]->created_at > $featured_workshop[0]->created_at)
                $featured = array($featured_news[0], $featured_workshop[0]);
            else
                $featured = array($featured_workshop[0], $featured_news[0]);                
        } 
        elseif (count($featured_workshop) >= 2 && count($featured_news) > 0)
        {            
            if ($featured_news[0]->created_at > $featured_workshop[0]->created_at)
                $featured = array($featured_news[0], $featured_workshop[0]);
            elseif ($featured_news[0]->created_at > $featured_workshop[1]->created_at)
                $featured = array($featured_workshop[0], $featured_news[0]);
            else
                $featured = $featured_workshop;
        } else {
            $featured = $featured_workshop;
        }

        return View::make('front.index', array(
            'featured'  => $featured,
            'news'      => News::visible()
                                ->orderBy('shows_at', 'desc')
                                ->where('category_id', '=', 1)
                                ->take(3)->get(),
            'workshops' => Workshop::visible()
                                ->orderBy('begins_at', 'desc')
                                ->take(12)
                                ->get(),
            'notes'     => News::visible()
                                ->orderBy('shows_at', 'desc')
                                ->where('category_id', '=', 2)
                                ->take(3)->get()
        ));
    }

    /**
     * Get News. Return News index when $id is empty
     *
     * @param string $id    Opt. Numerical string. Id of the news
     * @param string $title Opt.
     * @return Response
     */
    public function getNews($id = null, $title = null)
    {
        // No id means index or category
        if($id === null)
        {
            // Make View with featured news
            return View::make('front.overview', array(
                'title'     => 'Nieuws',
                'featured'  => News::visible()
                                    ->news()
                                    ->featured()
                                    ->orderBy('shows_at', 'desc')
                                    ->take(2)
                                    ->get(),
                'items'     => News::with('user', 'category')
                                    ->news()
                                    ->visible()
                                    ->orderBy('shows_at', 'desc')
                                    ->paginate(12)
            ));
        }

        // Find News by id, or throw 404
        $news = News::with('user')->visible()->findOrFail($id);

        // Redirect to url with title.
        if($title !== $news->webTitle)
        {
            return Redirect::route('news', array($id, $news->webTitle));
        }

        // Make View with current News and featured News
        return View::make('front.single.news', array(
            'news' => $news
        ));
    }

    public function getCalls($id = null, $title = null)
    {
        // No id means index or category
        if($id === null)
        {
            // Make View with featured news
            return View::make('front.overview', array(
                'title'     => 'Oproepen',
                'featured'  => News::visible()
                                ->calls()
                                ->featured()
                                ->orderBy('shows_at', 'desc')
                                ->take(2)
                                ->get(),
                'items'     => News::with('user', 'category')
                                    ->calls()
                                    ->visible()
                                    ->orderBy('shows_at', 'desc')
                                    ->paginate(12)
            ));
        }

        // Find News by id, or throw 404
        $news = News::with('user')->visible()->findOrFail($id);

        // Redirect to url with title.
        if($title !== $news->webTitle)
        {
            return Redirect::route('news', array($id, $news->webTitle));
        }

        // Make View with current News and featured News
        return View::make('front.single.news', array(
            'news' => $news
        ));
    }

    /**
     * Get Workshop. Return Workshop index when $id is empty
     *
     * @param string $id    Opt. Numerical string. Id of the workshop
     * @param string $title Opt.
     * @return Response
     */
    public function getWorkshops($id = null, $title = null)
    {
        // No id means index.
        if($id === null)
        {
            // Make View with featured news
            // and 12 normal items.
            return View::make('front.overview', array(
                'title' => 'workshops',
                'featured' => Workshop::visible()
                                    ->featured()
                                    ->orderBy('begins_at', 'desc')
                                    ->take(2)
                                    ->get(),
                'items' => Workshop::with('user')
                                    ->visible()
                                    ->orderBy('begins_at', 'desc')
                                    ->paginate(12)
            ));
        }

        // Find Workshop by id, or throw 404
        $workshop = Workshop::with(array('user', 'signups'))->visible()->findOrFail($id);

        // Redirect to url with title.
        if($title !== $workshop->webTitle)
        {
            return Redirect::route('workshops', array($id, $workshop->webTitle));
        }

        // Make View with current News and featured News
        return View::make('front.single.workshop', array(
            'workshop' => $workshop,
        ));
    }

    /**
     * Register for a workshop, then return to Workshop
     *
     * @param $id       Numerical string. Id of the Workshop
     * @param $title    Opt.
     * @return Response
     */
    public function postWorkshops($id, $title = null)
    {
        // Get Input
        $input = Input::only('student_number', 'firstname', 'lastname', 'email');
        // Get Validator
        $validator = Signup::validateNew($input);

        // Form is valid
        if($validator->passes())
        {
            // Fetch workshop
            $workshop = Workshop::with('signups')->find($id);

            // Workshop exists
            if($workshop && count($workshop->signups) + 1 <= $workshop->max_signups)
            {
                // Check if user is already signed up
                $signups = $workshop->signups->filter(function($s) use ($input){
                    return $s->student_number == $input['student_number'];
                });

                // Already signed up
                if(count($signups) > 0)
                {
                    return Redirect::route('workshops', array($id, $title))->withErrors('Je bent al ingeschreven.')
                                                                            ->withInput(Input::except('password'));
                }

                // Make new Signup
                $signup = new Signup($input);

                // Attach Signup to Workshop
                $workshop->signups()->save($signup);

                // Make cookie
                Cookie::queue($workshop->webTitle, $signup->email, 2628000);

                return Redirect::route('workshops', array($id, $title));
            }
        }

        // Go back to Workshop
        return Redirect::route('workshops', array($id, $title))->withErrors($validator)->withInput();
    }

    /**
     * Get Category. Doesn't have an index.
     *
     * @param $id           Numerical string. Id of the Category
     * @param null $title   Opt.
     * @return Response
     */
    public function getCategory($id = null, $title = null)
    {
        // No category index

        $category = Category::findOrFail($id);

        // Redirect to url with title
        if($title !== $category->webTitle)
        {
            return Redirect::route('categories', array($category->id, $category->webTitle));
        }

        // Pick from array or default
        $sort = in_array(Input::get('sort'), array('title', 'shows_at', 'updated_at')) ? Input::get('sort') : 'shows_at';
        $order = in_array(Input::get('order'), array('asc', 'desc')) ? Input::get('order') : 'desc';

        return View::make('front.category', array(
            'category' => $category,
            'items' => $category->news()->orderBy($sort, $order)->paginate()
        ));
    }

    /**
     * Get the tv-layout.
     *
     * @return Response
     */
    public function getScreen() {
        $featured_news = News::visible()
            ->where('is_screen', '=', true)
            ->featured()
            ->orderBy('shows_at', 'desc')            
            ->take(1)
            ->get();
        
        $featured_workshop = Workshop::visible()
            ->where('is_screen', '=', true)
            ->featured()
            ->orderBy('begins_at', 'desc')
            ->take(2)
            ->get()
            ->sortBy('begins_at');
        
        if (count($featured_workshop) == 0 && count($featured_news) > 0)
        {
            $featured = News::visible()
                ->where('is_screen', '=', true)
                ->featured()
                ->orderBy('shows_at', 'desc')            
                ->take(2)
                ->get();
        }
        elseif (count($featured_workshop) == 1 && count($featured_news) > 0) 
        {
            if ($featured_news[0]->created_at > $featured_workshop[0]->created_at)
                $featured = array($featured_news[0], $featured_workshop[0]);
            else
                $featured = array($featured_workshop[0], $featured_news[0]);                
        } 
        elseif (count($featured_workshop) >= 2 && count($featured_news) > 0)
        {            
            if ($featured_news[0]->created_at > $featured_workshop[0]->created_at)
                $featured = array($featured_news[0], $featured_workshop[0]);
            elseif ($featured_news[0]->created_at > $featured_workshop[1]->created_at)
                $featured = array($featured_workshop[0], $featured_news[0]);
            else
                $featured = $featured_workshop;
        } else {
            $featured = $featured_workshop;
        }

        //>where('is_screen', true)
        return View::make('front.screen', array(
            'featured'  => $featured,
            'news'      => News::visible()
                                ->where('is_screen', '=', true)
                                ->orderBy('shows_at', 'desc')
                                ->where('category_id', '=', 1)
                                ->take(3)->get(),
            'workshops' => Workshop::visible()
                                ->where('is_screen', '=', true)
                                ->orderBy('begins_at', 'desc')
                                ->take(12)
                                ->get(),
            'notes'      => News::visible()
                                ->where('is_screen', '=', true)
                                ->orderBy('shows_at', 'desc')
                                ->where('category_id', '=', 2)
                                ->take(3)->get()
        ));
    }
}