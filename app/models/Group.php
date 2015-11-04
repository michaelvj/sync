<?php

class Group extends Eloquent {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'permissions');

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get all Users in a Group.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany("User");
    }
}