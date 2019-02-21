<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use \App\User;
use \App\Role;
use DB;
use Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        // $role = Auth::user();
        // $users = DB::table('users')->simplePaginate(6);
        // $users = DB::table('users')->simplePaginate(12);
        if($user->isAdmin() || $user->isSuperAdmin())  {
            $users = DB::table('users')->get();
            return view('admin.index', ['users' => $users]);
        }
        return view('users.index');
        // return DataTables::of(User::query())->make(true);

    }

    public function downloadExcel($type)
    {
        $data = User::get()->toArray();
            
        return Excel::create('users', function($excel) use ($data) {
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
    public function create()
    {
        return view('users.displaydata');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = Auth::user();
        // dd($user);
        return view('users.profile', compact('user'));
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
        $user = Auth::user();
        $data = $request->validate([
            'username' => 'required',
            'mobile' => ['required', 'string','max:255'],
            'password' => 'nullable',
            'confirm-password' => 'nullable',
            'filename' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);

        //initalize image
        $image = " ";

        //If has a filename to be uploaded
        if($request->hasfile('filename')) 
        { 
            $file = $request->file('filename');
            $extension = rand() .'.'.$file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path("uploads/"), $filename);
            $user->filename = $filename;

        }
        
        //Password Validation
        if ($request->input('password') !== $request->input('confirm-password')) {
            return back()->with('message-error', 'Password Confirmation does not matched!!!');
        }
        else if (empty($request->input('password') && $request->input('confirm-password'))) {
            $user->username = $request->input('username');
            $user->mobile = $request->input('mobile');
            $user->save();

            //get path
            // return back()->with('message', 'Updated Successfully!')->with('path', $image);
            return back()->with('message', 'Updated Successfully!');
        }
        else {
            $user->username = $request->input('username');
            $user->mobile = $request->input('mobile');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return back()->with('message', 'Updated Successfully!!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        return back()->with('message', 'User Successfully DELETED!!');
    }
}
