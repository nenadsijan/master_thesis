<?php

namespace App;
use Mail;
use Illuminate\Notifications\Notifiable;
//import Eloquent user from config to our model
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//finding inside database user that is equal to user typed in input
  public static function byEmail($email){

    return static::whereEmail($email)->first();
  }  

    public function roles()
    {
        return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }
}
