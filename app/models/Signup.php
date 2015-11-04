<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 3/27/14
 * Time: 8:57 PM
 */

class Signup extends Eloquent {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'signups';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = array('student_number', 'firstname', 'lastname', 'email');

    /**
     * Get the Workshop of a Signup.
     *
     * @return mixed
     */
    public function workshop()
    {
        return $this->belongsTo('Workshop');
    }

    /**
     * Validate a new signup
     *
     * @param  array $input
     * @return Validator
     */
    public static function validateNew(array $input)
    {
        $rules = array(
            'student_number'    => 'required|numeric',
            'firstname'         => 'required|alpha_spaces|max:35', // Names don't have numbers in them
            'lastname'          => 'required|alpha_spaces|max:35',
            'email'             => 'required|email|max:255'
        );

        return Validator::make($input, $rules);
    }
} 