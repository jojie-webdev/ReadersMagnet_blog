<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_title', 'post_content', 'excerpt', 'image', 'category',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
