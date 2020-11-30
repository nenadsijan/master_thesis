<?php

namespace App;
use Mail;
use Illuminate\Notifications\Notifiable;
//import Eloquent user from config to our model
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;

class Role_User extends EloquentUser{
use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_id',
     
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
           ];

 
}
