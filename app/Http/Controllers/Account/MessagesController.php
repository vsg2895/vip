<?php

namespace App\Http\Controllers\Account;

use App\Events\MessageSubmited;
use App\Events\MessageDeleted;
use App\Events\MessageUpdated;
use App\Events\UserJoined;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\ChatUserMessage;
use App\ChatMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    // Pagination items count
    protected $pagination_items_count = 10;

    // Auth Validation
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Messages
    public function index(Request $request, $locale = 'hy')
    {
        // Call socket
//        broadcast(new UserJoined(Auth::user()->id));

        // Get middleware data
        $data = $request->data;

        // Get users data
//        $users = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'desc')->get();
//        $users = DB::table('chat_user_messages')->where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->groupBy('sender_id')->get();
        $users_ids = ChatUserMessage::where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->distinct('sender_id', 'receiver_id')->get(['sender_id', 'receiver_id'])->toArray();
        $auth_user_unread_messages = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'seen_status' => 0])->distinct('sender_id')->get();
//        dd($auth_user_unreaded_messages);
        $array_user_values = [];
        foreach ($users_ids as $elem) {
            array_push($array_user_values, $elem['sender_id'] != Auth::user()->id ? $elem['sender_id'] : $elem['receiver_id']);
        }
        $users = User::whereIn('id', $array_user_values)->get();
        // Push data
        $data['users'] = $users;
        $data['auth_user_unread_messages'] = $auth_user_unread_messages;
        $data['has_chat'] = true;
        // Push data
        $data['page_name_account_aside'] = 'messages';
//        dd($users);
        // Check request type
        if ($request->ajax()) { // Axios request
            // Send data to view
//            dd('ajax-message');
            return view('account.messages.index-content')->with($data);
        } else {
            // Send data to view
//            dd('post-message');
            return view('account.messages.select-chat')->with($data);
        }
    }

    // Conversation
    public function conversation(Request $request, $locale = 'hy', $user_id)
    {
        // Call socket
//        broadcast(new UserJoined(Auth::user()->id));
//        Session::put('active_chat_user', $user_id);
//        Session::save();
        // Get middleware data
        $data = $request->data;
        // Get users data
//        $users = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'desc')->get();
        $users_ids = ChatUserMessage::where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->distinct('sender_id', 'receiver_id')->get(['sender_id', 'receiver_id'])->toArray();
        $array_user_values = [];
        foreach ($users_ids as $elem) {
            array_push($array_user_values, $elem['sender_id'] != Auth::user()->id ? $elem['sender_id'] : $elem['receiver_id']);
        }
        $users = User::whereIn('id', $array_user_values)->get();
        // Get friend data
        $friend = User::findOrFail($user_id);
        // Get messages data
        $messages = ChatUserMessage::with('message')
            ->where(['sender_id' => Auth::user()->id, 'receiver_id' => $friend->id])
            ->orWhere(function ($query) use ($friend) {
                $query->where('receiver_id', Auth::user()->id)
                    ->where('sender_id', $friend->id);
            })
            ->orderBy('id', 'asc')
            ->get();

        // Push data
        $has_chat = true;
        $active_chat_user = $user_id;
        $data['users'] = $users;
        $data['friend'] = $friend;
        $data['messages'] = $messages;
        $data['has_chat'] = $has_chat;
        $data['active_chat_user'] = $active_chat_user;
        $data['page_name_account_aside'] = 'messages';

        // Meke unreaded messages count update data
        $update_data = array(
            'seen_status' => 1
        );
        // Update
        $unreaded_messages = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'sender_id' => $friend->id, 'seen_status' => 0])->update($update_data);
        // Get unreaded messages
        $user_unreaded_messages_count = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'seen_status' => 0])->count();
        $auth_user_unread_messages = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'seen_status' => 0])->distinct('sender_id')->get();

//        @dump($user_unreaded_messages_count);
        // Push data
        $data['user_unreaded_messages_count'] = $user_unreaded_messages_count;
        $data['auth_user_unread_messages'] = $auth_user_unread_messages;
        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view

            return response()
                ->json([
                    'view' => view('account.messages.conversation-only', compact('active_chat_user','has_chat','messages','users', 'user_unreaded_messages_count', 'auth_user_unread_messages', 'friend'))->render(),
                    'data' => $data,
                ]);
//            return view('account.messages.conversation-only',compact('user_unreaded_messages_count','auth_user_unread_messages'))->with($data);
        } else {
            // Send data to view
            return view('account.messages.conversation')->with($data);
        }
    }

    // Send Message Action
    public function send_message(Request $request, $locale = 'hy', $receiver_id)
    {
        // Check data
//        dump($request->all());
        $receiver = User::where(['id' => $receiver_id])->first();
//dump($receiver);
        // Validation
        if (!Auth::check() || $receiver == NULL) {
            // Error Response
            echo 0;
            exit;
        }

        // Validation
        $request->validate([
            'message' => 'required|max:9999999'
        ]);

        // Make data
        $chat_message = new ChatMessage;
        $chat_message->message = $request->message;
        $chat_message->type = 1;

        // Save data
        $chat_message->save();

        // Make data
        $chat_user_message = new ChatUserMessage;
        $chat_user_message->message_id = $chat_message->id;
        $chat_user_message->sender_id = Auth::user()->id;
        $chat_user_message->receiver_id = $receiver_id;
        $chat_user_message->seen_status = 0;
        $chat_user_message->delever_status = 1;

        // Save data
        $chat_user_message->save();

        // Call socket
//        dd()
//        broadcast(new MessageSubmited($request->message, $chat_user_message->sender_id, $chat_user_message->id))->toOthers();
        event(new MessageSubmited($request->message, $chat_user_message->sender_id, $chat_user_message->id));
        return response()->json(['message' => $request->message, 'sender_id' => $chat_user_message->sender_id, 'message_id' => $chat_user_message->id]);
//        echo $chat_user_message->id;
//        exit;
    }

    // Update function
    public function update(Request $request, $locale = 'hy', $id)
    {
        // Get message data
        $message = ChatMessage::findOrFail($id);

        // Validation
        $request->validate([
            'message' => 'required|max:999999'
        ]);

        // Make data
        $message->message = $request->message;

        // Update
        $message->save();

        // Call socket
        broadcast(new MessageUpdated($request->message, Auth::user()->id, $id));

        // Success response
        echo 1;
        exit;
    }

    // Delete function
    public function destroy(Request $request, $locale = 'hy', $message_id)
    {
        // Get message
        $message = ChatMessage::where('id', $message_id)->first();

        // Validation
        if (isset($message) && $message != NULL && Auth::check()) {
            // Delte message and his relations
            ChatMessage::findOrFail($message_id)->delete();

            //  Call socket
            broadcast(new MessageDeleted(Auth::user()->id, $message_id));

            // Success response
            echo 1;
            exit;
        } else { // Access disabled
            // Error response
            echo 0;
            exit;
        }
    }
}
