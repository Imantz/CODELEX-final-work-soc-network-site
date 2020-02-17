<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWallFeed;
use App\WallFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WallFeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $wallFeeds = DB::table("wall_feeds")
            ->distinct()
            ->leftJoin("follower_user","wall_feeds.user_id","=","follower_user.follower_id")
            ->where(function($query){
                return $query
                    ->where("follower_user.user_id",Auth::user()->id)
                    ->orWhere("wall_feeds.user_id",Auth::user()->id);
            })
            ->select("text","wall_feeds.user_id","wall_feeds.created_at")
            ->orderBy("created_at","DESC")
            ->get();

        return view('authUser/wall', compact("wallFeeds"));
    }

    public function store(StoreWallFeed $request)
    {

        Auth::user()->WallFeeds()->create($request->validated());

        return redirect("/");
    }
}
