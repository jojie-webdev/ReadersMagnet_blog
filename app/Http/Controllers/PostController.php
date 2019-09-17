<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use \App\Post;
use \App\Category;
use App\Mail\Thankyou;
use App\Mail\Disapproved;
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
            if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
                $posts = Post::all();
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
        $username = Auth::user()->username;
        $user_email = Auth::user()->email;
        
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
        $post->posted = 0;
        $post_category = $request->input('category');
        
        $post->user_id = $user;

        
        //get all user activity date
        $post_created = Post::select('created_at')
                        ->whereDate('created_at', '=', date('Y-m-d'))
                        ->where('user_id', '=', $user)
                        ->get();

        $message = 'You can only post 6 articles per day please click the back arrow at the top left';

        // return count($post_created);
        $count_date = count($post_created);

        if($count_date >= 3) {
            return "<script type='text/javascript'>alert('$message');</script>";
        }

        $post->save();

        //Save post_category
        $category= DB::table('post_category')->insert(
            ['post_id' => $post->id, 'category_id' => $post_category]
        ); 

        //Save no. of post user
        DB::table('users')
            ->where('id', $user)
            ->increment('no_of_post', 1);

        //SEND THAKYOU EMAIL 
        // $to_name =$username;
        // $to_email = $user_email;
        
        // Mail::to($to_email)
        // ->send(new Thankyou($to_name));

        return back()->with('message', 'Your Post has been submitted! Thank you!');
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

    public function posted(Request $request, $id)
    {   
        // $this->validate($request, [
    	// 	'reason' => 'required|max:2048|string',
        // ]);\
        $value =  $request->input('approved');

        if($value == 2) {
            $this->validate($request, [
                'name' => 'required|max:255|string',
                'email' => 'required|email|max:255',
                'reason' => 'required'
            ]);

            $post_id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $reason =  $request->input('reason');   
            
            Mail::to($email)
                    ->send(new Disapproved($request));

                    
            POST::where('id', $post_id)
            ->update(['posted' => $value]);
            // redirect
            return back()->with('message', 'Article change status to Disapproved!');
        } else {

            POST::where('id', $id)
            ->update(['posted' => $value]);
            // redirect
            return back()->with('message', 'Article change status to Posted!');
        }
    }
}
