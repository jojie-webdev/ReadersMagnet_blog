<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
}
