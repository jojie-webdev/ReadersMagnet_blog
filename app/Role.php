<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * A role can have many users.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {

        return $this->belongsToMany('App\User');
    }

}

/* Reference: https://medium.com/@ezp127/laravel-5-4-native-user-authentication-role-authorization-3dbae4049c8a */