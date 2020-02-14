<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
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

    public function follow(User $user)
    {
        Follower::create([
            "user_id"=>Auth::user()->id,
            "follower_id" => $user->id
        ]);

        return redirect()->route("profile",$user);
    }

    public function unfollow(User $user)
    {
        Follower::where("user_id",Auth::user()->id)
            ->where("follower_id",$user->id)
            ->delete();
        return redirect()->route("profile",$user);
    }
}
