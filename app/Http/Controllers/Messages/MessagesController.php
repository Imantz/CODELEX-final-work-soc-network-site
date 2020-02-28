<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        return view("layouts/messages", ["user"=>$user]);
    }
}
