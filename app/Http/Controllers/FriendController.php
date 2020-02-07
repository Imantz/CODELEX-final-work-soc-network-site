<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function myFriends()
    {

        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view("my-friends", compact(["friends","requests"]));
    }

    public function getAddFriend($username){
        $user = User::where('username', $username)->first;
        if(!$user){
            return redirect()->route("myFriends")->with("info","User not found");
        }

        if(Auth::user()->id === $user->id){
            return redirect()->route("friends");
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
        {
            return redirect()->route("myFriends", ["name"=>$user->name])
                            ->with("info","friend request already pending");
        }

        if(Auth::user()->isFriendsWith($user))
        {
            return redirect()
                ->route("myFriends",["name"=>$user->name])
                ->with("info","already friends");
        }

        Auth::user()->addFriend($user);
        return redirect()
            ->route("myFriends",["name"=>$user->name])
            ->with("info","Friend request sent");
    }

    public function getAcceptFriend($username)
    {
        $user = User::where('username', $username)->first;
        if(!$user){
            return redirect()->route("myFriends")->with("info","User not found");
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route("myFriends");
        }

        Auth::user()->acceptFriendRequest($user);
        return redirect()
            ->route("myFriends",["user"=>$user->name])
            ->with("info","friend request accepted");
    }


}
