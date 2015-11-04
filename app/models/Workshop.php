<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 3/27/14
 * Time: 8:52 PM
 */

/**
 * Class Workshop
 * Workshop extends News because they are share like 90% properties.
 * A workshop has no category though.
 */
class Workshop extends News {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'workshops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('title', 'text', 'shows_at', 'expires_at',
                                'begins_at', 'ends_at', 'teacher_name', 'teacher_email', 'location',
                                'max_signups', 'is_featured');

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = array('shows_at', 'expires_at', 'begins_at', 'ends_at');

    /**
     * Get all the Signups of a Workshop.
     *
     * @return mixed
     */
    public function signups()
    {
        return $this->hasMany('Signup');
    }
    
    public function getShowdateAttribute() 
    {
        return $this->begins_at;
    }

    /**
     * Get a validator instance for new Workshop.
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

            'begins_at'     => 'date',
            'ends_at'       => 'date|after:begins_at',
            'max_signups'   => 'required|numeric|min:1',
            'teacher_name'  => 'required',
            'teacher_email' => 'required|email',
            'location'      => ''
        );

        return Validator::make($input, $rules);
    }
} 