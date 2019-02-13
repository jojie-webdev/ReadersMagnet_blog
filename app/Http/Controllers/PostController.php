<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'post_content' => 'string|max:255',
            'excerpt' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'category' => 'string|max:255',
        ]);

        //initalize image
        $image = " ";

        //If has a filename to be uploaded
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
        $post->category = $request->input('category');
        $post->user_id = $user;
        $post->save();
        return back()->with('message', 'Article Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
