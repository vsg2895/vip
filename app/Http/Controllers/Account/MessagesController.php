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
        broadcast(new UserJoined(Auth::user()->id));

        // Get middleware data
        $data = $request->data;

        // Get users data
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'desc')->get();
//        $users =

        // Push data
        $data['users'] = $users;
        $data['has_chat'] = true;
        // Push data
        $data['page_name_account_aside'] = 'messages';

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
        broadcast(new UserJoined(Auth::user()->id));

        // Get middleware data
        $data = $request->data;

        // Get users data
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'desc')->get();

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
        $data['users'] = $users;
        $data['friend'] = $friend;
        $data['messages'] = $messages;
        $data['has_chat'] = true;
        $data['page_name_account_aside'] = 'messages';

        // Meke unreaded messages count update data
        $update_data = array(
            'seen_status' => 1
        );

        // Update
        $unreaded_messages = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'sender_id' => $friend->id, 'seen_status' => 0])->update($update_data);

        // Get unreaded messages
        $user_unreaded_messages_count = ChatUserMessage::where(['receiver_id' => Auth::user()->id, 'seen_status' => 0])->count();

        // Push data
        $data['user_unreaded_messages_count'] = $user_unreaded_messages_count;

        // Chek request type
        if ($request->ajax()) { // Axios request
            // Send data to view
            return view('account.messages.conversation-only')->with($data);
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
