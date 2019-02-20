<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \App\Post;
use \App\Category;
use DB;
use Excel;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                $posts = DB::table('posts')->latest()->get();
                // $posts = Post::all();
                // dd($posts);
                
                return view('posts.index', ['posts' => $posts]);
            }else{
                return redirect('/home');		
            }
        }else{
            return redirect('/home');	
        }
    }

    public function postExcel($type)
    {
        $data = Post::get()->toArray();
            
        return Excel::create('articles', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guide()
    {
        return view('posts.guide');
    }


    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Add new note
        $user = Auth::user()->id;
        $post = new Post($request->all());

        $data = $request->validate([
            'post_title' => 'required',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'category' => 'string|max:255',
        ]);

        //initalize image
        $image = " ";

        //If has a image to be uploaded
        if($request->hasfile('image')) 
        { 
            $file = $request->file('image');
            $extension = rand() .'.'.$file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path("uploads/"), $filename);
            $post->image = $filename;
        }
        $post->post_title = $request->input('post_title');
        $post->post_content = $request->input('post_content');
        $post->excerpt = $request->input('excerpt');
        $post_category = $request->input('category');

    
        $post->user_id = $user;
        $post->save();

        //Save post_category
        $category= DB::table('post_category')->insert(
            ['post_id' => $post->id, 'category_id' => $post_category]
        ); 

        return back()->with('message', 'Thank you for submitting your article. A team will review your submission and will give you feedback via e-mail within the next 72 hours.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get Category name by post id
        $category = DB::table('categories')
            ->join('post_category', 'post_category.category_id', '=', 'categories.id')
            ->select("category_name") 
            ->where("post_category.post_id", "=", $id)
            ->first()->category_name;
        // dd($category);
        
        return view('posts.show', ['post' => Post::findOrFail($id), 'category'=> $category] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'test';
        // delete
         $post = Post::find($id);
         $post->delete();
 
         // redirect
         return back()->with('message', 'Article Successfully DELETED!!');
    }
}
