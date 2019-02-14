<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];

    // public $timestamps = false;

    //Many to Many Relationship
    public function cat_to_post()
    {
        return $this->belongsToMany( 'App\Post' );
    }
}
