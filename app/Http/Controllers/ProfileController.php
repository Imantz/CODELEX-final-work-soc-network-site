<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        return view("profile", compact("user"));
    }
}
