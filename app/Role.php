<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;
class Role extends EloquentUser
{
   
    protected $table = 'roles';
    //public $child_roles;
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'is_group',
       
    ];

    /**
     * The Eloquent users model name.
     *
     * @var string
     */
    protected static $usersModel = 'App\User';//'Cartalyst\Sentinel\Users\EloquentUser';

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(static::$usersModel, 'role_users', 'role_id', 'user_id')->withTimestamps();
    }
}
