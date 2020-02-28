<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageSendController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $msg = Message::where("id", $id)->get()[0];

        Message::where("id",$id)->delete();

        Message::create
        ([
                "title" => $msg->title,
                "body" => $request->body,
                "sender_id" => Auth::user()->id,
                "receiver_id" => $msg->sender_id,
        ]);

        return redirect()->back()->with("msg_flash","message sent successfully!");
    }
}
