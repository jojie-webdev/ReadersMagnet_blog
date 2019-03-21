<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;
use DB;
use Excel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $month = $request->input('month');
        $year = $request->input('year');

        if ($month !== 'all') {
            $users = DB::table('users')
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->get();
                return view('admin.index', ['users' => $users]);
        }   

        $users = DB::table('users')->get();
        return view('admin.index', ['users' => $users]);
    }

    public function posts(Request $request)
    {
        $user = Auth::user();
        $month = $request->input('month');
        $year = $request->input('year');

        $excel = $request->input('excel');


        if($excel === 'Search & Download') {
            $posts = Post::query(); 

            $posts = Post::whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->get();

                    Excel::create('articles', function($excel) use ($posts) {
                        $excel->sheet('mySheet', function($sheet) use ($posts)
                        {
                            $sheet->fromArray($posts);
                        });
                    })->download('xls');
        }

        if ($month !== 'all') {
            $posts = Post::query(); 

            $posts = Post::whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $month)
                        ->get();

                    return view('posts.index', ['posts' => $posts]);

        }

        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }
}
