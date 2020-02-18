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

    public function friends(User $user)
    {
        $friends = $user->friends()->except(Auth::user()->id);
        return view("users/friends", compact(["friends","user"]));
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
            return redirect()->back();
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
        {
            return redirect()->back();
        }

        if(Auth::user()->isFriendsWith($user))
        {
            return redirect()->back();
        }

        Auth::user()->addFriend($user);
        Auth::user()->followers()->attach($user->id);

        return redirect()->back();
    }

    public function getAcceptFriend(User $user)
    {

        if(!$user){
            return redirect()->back();
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->back();
        }

        Auth::user()->acceptFriendRequest($user);
        Auth::user()->followers()->attach($user->id);
        $user->followers()->attach(Auth::user()->id);
        return redirect()->back();

    }

    public function getUnfriend(User $user)
    {
        Auth::user()->unfriend($user);
        Auth::user()->followers()->detach($user->id);
        return redirect()->back();
    }
}
