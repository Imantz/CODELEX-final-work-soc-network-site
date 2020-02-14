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

        $followers = DB::table('follower_user')
            ->join('users', 'users.id', '=', 'follower_user.follower_id')
            ->select('users.*')
            ->where("user_id", Auth::user()->id)
            ->get();

        return view("auth/followers", compact("followers"));
    }

    public function followers()
    {

        $followers = DB::table('follower_user')
            ->join('users', 'users.id', '=', 'follower_user.user_id')
            ->select('users.*')
            ->where("follower_id", Auth::user()->id)
            ->get();

        return view("auth/followers", compact("followers"));
    }

    public function follow(User $user)
    {
        Auth::user()->followers()->attach($user->id);

        return redirect()->route("profile",$user);
    }

    public function unfollow(User $user)
    {
        Auth::user()->followers()->detach($user->id);

        return redirect()->route("profile",$user);
    }
}
