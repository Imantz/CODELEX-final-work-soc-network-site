<?php

namespace App\Http\Controllers;

use App\User;
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

        [$id,$name,$surname] = explode("-",$username);
        $user = User::where("id","=",$id )->first();

        if($user){
            return view("profile", compact("user"));
        }else{
            return redirect("/");
        }

    }



    public function updateMyProfile()
    {
        $user = User::where("id","=", Auth::user()->id )->first();
        $user->update($this->validateRequest());
        $this->storeImage($user);

        return redirect("/my-profile");
    }

    public function index()
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
