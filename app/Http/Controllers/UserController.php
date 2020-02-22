<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view("authUser/profile");
    }

    public function OtherUserProfileView(User $user)
    {
        return view("users/wall", compact("user"));
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = Auth::user();
        $user->update($request->validated());

        if($request->password)
        {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $this->storeImage($user);

        return redirect()->back();
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
}
