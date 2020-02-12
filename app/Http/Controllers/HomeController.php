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
        //FIXME !!


        //where wall_feeds.user_id = ANY (select follower_id from followers
        //                            where user_id = 5) or wall_feeds.user_id = 5;
        $wallFeeds = DB::table('wall_feeds')
            ->distinct("text")
            ->select("wall_feeds.user_id","wall_feeds.text","wall_feeds.name","wall_feeds.created_at")
            ->from("wall_feeds")
            ->join("followers","wall_feeds.user_id","=","followers.user_id")
            ->where("wall_feeds.user_id",Auth::user()->id)

            ->orderBy('created_at', 'DESC')
            ->get();

        return view('authUser/wall', compact("wallFeeds"));
    }
    public function show()
    {
        return view("authUser/profile");
    }
}
