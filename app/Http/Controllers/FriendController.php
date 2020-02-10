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
        return view("authUser/friends", compact(["friends","requests"]));
    }

    public function getAddFriend($id,$name,$surname){

        $user = User::where('id', $id)
            ->where("name",$name)
            ->where("surname",$surname)
            ->first();

        if(!$user){
            return redirect()->route("friends")->with("info","User not found");
        }

        if(Auth::user()->id === $user->id){
            return redirect()->route("friends");
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
        {
            return redirect()->route("friends", ["name"=>$user->name])
                            ->with("info","friend request already pending");
        }

        if(Auth::user()->isFriendsWith($user))
        {
            return redirect()
                ->route("friends",["name"=>$user->name])
                ->with("info","already friends");
        }

        Auth::user()->addFriend($user);

        return redirect("profile/$user->id-$user->name-$user->surname");
    }

    public function getAcceptFriend($username)
    {
        $user = User::where('name', $username)->first();
        if(!$user){
            return redirect()->route("friends")->with("info","User not found");
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route("friends");
        }

        Auth::user()->acceptFriendRequest($user);
        return redirect()
            ->route("friends",["user"=>$user->name])
            ->with("info","friend request accepted");
    }

    public function getUnfriend($user)
    {
        $user = User::where('name', $user)->first();
        Auth::user()->unfriend($user);
        return redirect("profile/$user->id-$user->name-$user->surname");
    }
}
