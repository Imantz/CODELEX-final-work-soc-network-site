<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //create slug and update every time when changes name/surname
        Auth::user()->update([
            "slug" => Auth::user()->id . "-" . Auth::user()->name . "-" . Auth::user()->surname,
        ]);
    }
}
