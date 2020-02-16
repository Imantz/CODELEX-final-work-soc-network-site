<?php

namespace App\Http\Controllers;

use App\Follower;
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

         //Check for user name/surname updates and save into user slug column 3-name-surname.
        Auth::user()->update([
            "slug" => Auth::user()->id . "-" . Auth::user()->name . "-" . Auth::user()->surname,
        ]);

        $wallFeeds = DB::table("wall_feeds")
            ->distinct()
            ->leftJoin("follower_user","wall_feeds.user_id","=","follower_user.follower_id")
            ->where(function($query){
                return $query
                    ->where("follower_user.user_id",Auth::user()->id)
                    ->orWhere("wall_feeds.user_id",Auth::user()->id);
            })
            ->select("text","name","wall_feeds.created_at")
            ->orderBy("created_at","DESC")
            ->get();

        return view('authUser/wall', compact("wallFeeds"));
    }
    public function show()
    {
        return view("authUser/profile");
    }
}
