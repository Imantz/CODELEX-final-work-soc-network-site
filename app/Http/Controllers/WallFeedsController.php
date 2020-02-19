<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWallFeed;
use App\Like;
use App\User;
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
        //TODO resolve this.
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
            ->select("text","wall_feeds.user_id","wall_feeds.id","wall_feeds.created_at")
            ->orderBy("created_at","DESC")
            ->get();
            $users = User::all();
            $posts = WallFeed::all();

        return view('authUser/wall', compact("wallFeeds", "users", "posts"));
    }

    public function store(StoreWallFeed $request)
    {

        Auth::user()->WallFeeds()->create($request->validated());

        return redirect("/");
    }

    public function getLike(User $user , WallFeed $wallFeed)
    {
        $wallFeed->likes()->updateOrCreate(["user_id"=>Auth::user()->id]);
        return redirect()->back();
    }

    public function unlike(User $user , WallFeed $wallFeed)
    {
        $wallFeed->likes()->where("user_id",Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function delete(WallFeed $wallFeed)
    {
        $wallFeed->delete();
        return redirect("/");
    }
}
