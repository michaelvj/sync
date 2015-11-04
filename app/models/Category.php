<?php

class Category extends Eloquent {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name');

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = array('webTitle');

    /**
     * Get all News in a Category.
     *
     * @return mixed
     */
    public function news()
    {
        return $this->hasMany("News");
    }

    /**
     * Get web-safe title.
     * Appended to Model.
     *
     * @return string
     */
    public function getWebTitleAttribute()
    {
        return Str::slug($this->name);
    }
}