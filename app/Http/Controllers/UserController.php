<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(User $user)
    {
        return view("users/wall", compact("user"));
    }

    public function show()
    {
        return view("authUser/profile");
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
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
