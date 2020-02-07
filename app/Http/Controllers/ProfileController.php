<?php

namespace App\Http\Controllers;

use App\User;
use App\WallFeed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($username)
    {
        $user_details = explode("-",$username);
        [$user_id,$user_name,$user_surname] = $user_details;
        $user = User::where("id","=", $user_id )
            ->where("name","=",$user_name)
            ->where("surname","=",$user_surname)
            ->first();

        if($user){
            $wallFeeds = $this->wall_feeds($user->id);
            return view("profile-wall", compact("user","wallFeeds"));
        }else{
            return redirect("/");
        }
    }

    private function wall_feeds($id)
    {
        $wallFeeds = WallFeed::all()->where("user_id", $id);
        return $wallFeeds;
    }

    public function updateMyProfile()
    {
        $user = User::where("id","=", Auth::user()->id )->first();
        $user->update($this->validateRequest());
        $this->storeImage($user);

        return redirect("/my-profile");
    }

    public function allUsers()
    {
        $users = User::all()->except(Auth::id());
        return view("all-users", compact("users"));
    }

    private function storeImage(User $user)
    {
        if(request()->hasFile("img")){
            $user->update([
                "img" => request()->img->store("uploads","public"),
            ]);
        }
    }

    public function validateRequest()
    {
        return tap(
            request()->validate([
                'name' => ['required', 'max:10'],
                'surname' => ['required'],
                'phone' => ['nullable','numeric'],
                'dob' => ['nullable'],
                'city' => ['nullable'],
                'state' => ['nullable'],
                'zip' => ['nullable'],
                'bio' => ['nullable'],
            ]), function(){
            if(request()->hasFile("img"))
            {
                request()->validate([
                    "img"=>["file","image","max:5000"]
                ]);
            }
        });
    }
}
