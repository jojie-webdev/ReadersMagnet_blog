<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'post_title', 'post_content', 'excerpt', 'image','posted',
    ];

    // public $timestamps = false;

    //One to One Relationship
    public function users()
    {
        return $this->belongsTo('App\User', 'post_users', 'post_id', 'user_id')->withDefault();
    }

    //Many to Many Relationship
    public function category() {
        return $this->belongsTo('App\Category');    
    }

    //Category to be displayed in Show View
    //https://stackoverflow.com/questions/29165410/how-to-join-three-table-by-laravel-eloquent-model
    public function postCategory() {

        // $notes = DB::table('post_category')->where("category_id", "=", $user->id)->get();
        $posts = Post::with('category')->get();
        dd($posts);

    }

}
