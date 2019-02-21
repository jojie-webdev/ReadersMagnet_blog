<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    
    protected $fillable = [
        'username', 'mobile', 'email', 'password', 'filename', 'no_of_post',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
        $role = Role::with('rolecat')->get();

        foreach($role as $roles){
          echo  $roles->role_id->name;
        }
    }

    public function isAdmin() {

        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'admin')
            {
                return true;
            }
        }
    }

    public function isSuperAdmin() {

        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'super_admin')
            {
                return true;
            }
        }
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function getPostsCountAttribute(){
        return $this->posts()->count();
    }

}
