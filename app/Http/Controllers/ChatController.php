<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppChatModel\Chat;
use App\Models\AppMessageModel\Message;
use App\Models\AppUserModel\User;

class ChatController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }

    public function get_user_chat(Request $request)
    {
        $chat_from = $request->input('chat_from');
        $chat_to = $request->input('chat_to');
        $user_type = $request->input('user_type');
        if($user_type === 'user') {
            $chat;
            $chat_to = User::where('user_type','admin')->first();
            $chat = Chat::where('chat_from', $chat_from)                //First check check from which is user id and check to which is admin id
                                    ->where('chat_to', $chat_to->id)
                                    ->first();
            if(!$chat) {                                                    //if chat not initiated form user to admin then check wether chat initiated from admin to user
                $chat = Chat::where('chat_from', $chat_to->id)
                            ->where('chat_to', $chat_from)
                            ->first();  
            }
            if($chat) {
            $messages = Message::where('fk_chat_id', $chat->id)
                                    ->orderBy('timestamp', 'asc')
                                    ->with('user')
                                    ->get();
            return response()->json($messages, 200);
            }
        }
        if($user_type === 'admin') {
            $chat;
           $chat = Chat::where('chat_from', $chat_from)
                           ->where('chat_to', $chat_to)
                           ->first();
            if(!$chat) {
                $chat = Chat::where('chat_from', $chat_to)
                ->where('chat_to', $chat_from)
                ->first();  
            }
          $messages = Message::where('fk_chat_id', $chat->id)
                           ->orderBy('timestamp', 'asc')
                           ->with('user')
                           ->get();
           return response()->json($messages, 200);
        }
    }

    public function add_user_message(Request $request)
    {
            $body = $request->input('body');
            $chat;
            $chat_to = User::where('user_type','admin')->first();
            $chat = Chat::where('chat_from', $request->user()->id)                //First check check from which is user id and check to which is admin id
                                    ->where('chat_to', $chat_to->id)
                                    ->first();
            if(!$chat) {                                                   
            $chat = Chat::where('chat_from', $chat_to->id)                         //if chat not initiated form user to admin then check wether chat initiated from admin to user       
                                    ->where('chat_to', $request->user()->id)
                                    ->first();
            if(!$chat) {
            $chat = Chat::create(                                                //create new chat thread if chat is neither created from user to admin or from admin to user
                    [
                        'chat_from' => $request->user()->id,
                        'chat_to' => $chat_to->id
                    ]
                    );
            }      
            }
            $messages = Message::create(
                [
                    'body' => $body,
                    'fk_chat_id' => $chat->id,
                    'fk_user_id' => $request->user()->id
                ]
                );
            return response()->json($messages, 200);
    }
}
