<?php

namespace App\Http\Controllers;

use App\User;

use App\WallFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        //TODO Querry! to get only Auth::user and Auth::user()->following persons wall feeds

        $wallFeeds = WallFeed::where("user_id",Auth::user()->id)->get();

        return view('authUser/wall', compact("wallFeeds"));
    }
    public function show()
    {
        return view("authUser/profile");
    }
}
