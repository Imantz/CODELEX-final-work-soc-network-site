<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendNewMessageController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        Message::create
        ([
            "title" => $request->title,
            "body" => $request->body,
            "sender_id" => Auth::user()->id,
            "receiver_id" => $id,
        ]);

        return redirect()->back()->with("msg_flash","message sent successfully!");
    }
}
