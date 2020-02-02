<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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

    public function updateMyProfile(Request $request, User $user)
    {
            $validatedData = $request->validate([
            'name' => ['required', 'max:10'],
            'surname' => ['required'],
            'img' => ['nullable'],
            'phone' => ['nullable','numeric'],
            'dob' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'zip' => ['nullable'],
            'bio' => ['nullable'],
        ]);

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
            'name'=> $validatedData["name"],
            'surname'=> $validatedData["surname"],
            'img'=> $validatedData["img"],
            'phone'=> $validatedData["phone"],
            'dob'=> $validatedData["dob"],
            'city'=> $validatedData["city"],
            'state'=> $validatedData["state"],
            'zip'=> $validatedData["zip"],
            'bio'=> $validatedData["bio"],
        ]);

        return redirect("/my-profile");
    }

}
