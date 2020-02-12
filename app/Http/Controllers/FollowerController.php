<?php

namespace App\Http\Controllers;

use App\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followingTo()
    {
        $followers = DB::table('followers')
            ->join('users', 'users.id', '=', 'followers.follower_id')
            ->select('users.*')
            ->where("user_id", Auth::user()->id)
            ->get();

        return view("auth/followers", compact("followers"));
    }

    public function followers()
    {
        $followers = DB::table('followers')
            ->join('users', 'users.id', '=', 'followers.user_id')
            ->select('users.*')
            ->where("follower_id", Auth::user()->id)
            ->get();

        return view("auth/followers", compact("followers"));
    }

    public function follow($id,$name,$surname)
    {
        $follower = new Follower();
        $follower->user_id = Auth::user()->id;
        $follower->follower_id = $id;
        $follower->save();
        return redirect()->route("profile",[$id,$name,$surname]);
    }

    public function unfollow($id,$name,$surname)
    {
        Follower::where("user_id",Auth::user()->id)
            ->where("follower_id",$id)
            ->delete();
        return redirect()->route("profile",[$id,$name,$surname]);
    }
}
