<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('email', 'password', 'firstname', 'lastname', 'group_id');

    /**
     * Users are not really deleted
     *
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Validate input for a login-attempt.
     *
     * @param array $input
     * @return Validator
     */
    public static function validateLogin(array $input)
    {
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required'
        );

        return Validator::make($input, $rules);
    }

    /**
     * Validate a new User
     *
     * @param array $input
     * @return Validator
     */
    public static function validate($input = array())
    {
        // No password validation.
        // Password is created random
        $rules = array(
            'firstname' => 'required|alpha|max:35',
            'lastname'  => 'required|alpha|max:35',
            'email'     => 'required|email|max:255|unique:users,email',
            'group_id'  => 'required|exists:groups,id'
        );

        return Validator::make($input, $rules);
    }

    /**
     * Get the Group of the User
     *
     * @return Group
     */
    public function group()
    {
        return $this->belongsTo("Group");
    }

    /**
     * Get all the News posts of the User.
     *
     * @return mixed
     */
    public function news()
    {
        return $this->hasMany('News');
    }

    /**
     * Get all the Workshops of the User.
     *
     * @return mixed
     */
    public function workshops()
    {
        return $this->hasMany('Workshop');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Check if a User has a certain permission
     *
     * @param array|string $permissions
     * @param boolean $all
     * @return boolean
     */
    public function hasAccess($permissions, $all = true)
    {
        // Permissions are json encoded in db.
        // Decode them to an array
        $allowed = json_decode($this->group->permissions, true);

        // Amount of checked permissions
        $checked = 0;

        if (!is_array($permissions))
        {
            $permissions = (array)$permissions;
        }

        // Check each permission
        foreach ($permissions as $permission)
        {
            // walk over permission
            foreach (explode('.', $permission) as $segment)
            {
                if (isset($allowed[$segment]))
                {
                    // Parent permission is true means child is allowed
                    if ($allowed[$segment] === true)
                    {
                        $checked++;
                    }
                    // Move one level deeper in the array
                    else if (is_array($allowed[$segment]))
                    {
                        $allowed = $allowed[$segment];
                    }
                }
            }
        }

        // Must have all permissions
        if ($all)
        {
            return count($permissions) === $checked;
        }
        // Must have at least 1 permission
        else
        {
            return $checked >= 1;
        }
    }

    /**
     * Checks if a User owns the object
     *
     * @param $object The object to check, e.g. News
     * @return bool
     */
    public function owns($object)
    {
        if ($object instanceof User)
        {
            return $this->id === $object->id;
        }

        return $this->id === $object->user_id;
    }
}