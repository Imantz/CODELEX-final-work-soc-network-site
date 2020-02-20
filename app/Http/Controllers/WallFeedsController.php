<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWallFeed;
use App\User;
use App\WallFeed;
use Illuminate\Support\Facades\Auth;

class WallFeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index():string
    {

        // When new user register. This line make slug.
        // and follow to name / surname change. update.

        //FIXME.. hmm middleware? job? or just change and bind slug? o.O

        Auth::user()->update([
            "slug" => Auth::user()->id . "-" . Auth::user()->name . "-" . Auth::user()->surname,
        ]);



        // There get ID of persons who im following to.

        $id_following_to = [Auth::user()->id];

        foreach (Auth::user()->followingTo->all() as $user)
        {
            $id_following_to [] = $user->follower_id;
        }



        //Get all users who im following to. So can get name for posts..

        $users = User::whereIn("id",$id_following_to)->get();



        //Get all user posts and posts of persons who im following to.

        $wallFeeds = WallFeed::whereIn("user_id",$id_following_to)
            ->orderBy("created_at","DESC")
            ->get();



        return view('authUser/wall', compact("wallFeeds","users"));
    }

    public function store(StoreWallFeed $request):string
    {

        //Validate post input field and save to DB.

        Auth::user()->WallFeeds()->create($request->validated());

        return redirect("/");
    }

    public function delete(WallFeed $wallFeed):string
    {
        //Delete post

        $wallFeed->delete();

        return redirect("/");
    }
}
