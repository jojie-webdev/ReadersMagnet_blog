<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Post;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        if(Auth::check()){
            //User is Admin
            if(Auth::user()->isAdmin()){
                $posts = DB::table('posts')->latest()->get();
                // return 'test';
                return view('posts.index', ['posts' => $posts]);
            }else{
                //User Has Post
                $user = Auth::user()->id;
                $posts = DB::table('posts')->where("user_id", "=", $user)->latest()->get();
                // $posts = Post::all();
                return view('users.index', ['posts' => $posts]);		
            }
        }else{
            //User Has No Post
            return redirect('/home');	
        }

    }
}
