<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myFriends()
    {

        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view("authUser/friends", compact(["friends","requests"]));
    }

    public function getAddFriend(User $user){

        if(!$user){
            return redirect()->route("friends")->with("info","User not found");
        }

        if(Auth::user()->id === $user->id){
            return redirect()->route("friends");
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
        {
            return redirect()->route("friends", $user)
                            ->with("info","friend request already pending");
        }

        if(Auth::user()->isFriendsWith($user))
        {
            return redirect()
                ->route("friends",$user)
                ->with("info","already friends");
        }

        Auth::user()->addFriend($user);

        return redirect()->route("profile",$user);
    }

    public function getAcceptFriend(User $user)
    {

        if(!$user){
            return redirect()->route("friends")->with("info","User not found");
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route("friends");
        }

        Auth::user()->acceptFriendRequest($user);
        return redirect()
            ->route("friends",$user)
            ->with("info","friend request accepted");
    }

    public function getUnfriend(User $user)
    {
        Auth::user()->unfriend($user);
        return redirect()->route("profile", $user);
    }
}
