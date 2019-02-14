<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_title', 'post_content', 'excerpt', 'image',
    ];

    // public $timestamps = false;

    //One to One Relationship
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    //Many to Many Relationship
    public function post_to_cat()
    {
        return $this->belongsToMany( 'App\Post' );
    }
}
