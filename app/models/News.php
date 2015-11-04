<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 3/27/14
 * Time: 2:58 PM
 */

class News extends Eloquent {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = array('webTitle', 'excerpt', 'routeName');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('title', 'text', 'category_id', 'shows_at', 'expires_at', 'is_featured',
                                'featured_image', 'featured_visible', 'is_screen');

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = array('shows_at', 'expires_at');

    /**
     * Get the Category of a News post.
     *
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('Category');
    }

    /**
     * Get the User of a News post.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Filter by visibility.
     * (Current date is between starts_at and expires_at)
     *
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        // current date is greater than shows_at
        return $query->where('shows_at', '<=', new DateTime());
    }

    public function scopeNews($query)
    {
        return $query->where('category_id', 1);
    }

    public function scopeCalls($query)
    {
        return $query->where('category_id', 2);
    }

    /**
     * Filter by featured.
     *
     * @param $query
     * @return mixed
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', '=', true);
    }

    /**
     * Get web safe title of news.
     * Appended to Model.
     *
     * @return string
     */
    public function getWebTitleAttribute()
    {
        return Str::slug($this->title);
    }

    /**
     * Get excerpt of News post.
     * Appended to Model.
     *
     * @param int $length
     * @return string
     */
    public function getExcerptAttribute($length)
    {
        // Default value is set to NULL by Laravel
        $length = ($length === null) ? 20 : $length;

        // Remove all HTML but breaks
        // Otherwise you might end up with unclosed tags
        $excerpt = $this->text;

        // Replace <br /> with <br/> (no space)
        //$excerpt = preg_replace('/<br\s+\/>/', '<br/>', $excerpt);

        return Str::words($excerpt, $length, null);
    }

    /**
     * Get the route name of a model.
     * Usually the same as the table.
     * Appended to Model.
     *
     * @return string
     */
    public function getRouteNameAttribute()
    {
        return $this->table;
    }
    
    public function getShowdateAttribute() 
    {
        return $this->shows_at;
    }

    /**
     * Get a validator instance for new News.
     *
     * @param array $input
     * @return Validator
     */
    public static function validate($input = array())
    {
        $rules = array(
            'title'         => 'required|max:100',
            'text'          => 'required',
            'is_featured'   => '',                              // Not required, no rules for checkbox
            'shows_at'      => 'date',
            'expires_at'    => 'date|after:shows_at',
            'featured_image' => 'image'
        );

        return Validator::make($input, $rules);
    }
} 
