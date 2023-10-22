<?php

namespace App\Http\Controllers;

use App\Events\MessageDeletedEvent;
use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Models\AdminChat;
use App\Models\Conversation;
use App\Models\Item;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function indexAdmin()
    {
        $messages = AdminChat::all();
        return view('chatAdmin', compact('messages'));
    }



/**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function index($Id)
{
//    dd($item->name);
    $currentUserId = auth()->id();
    $item = Item::find($Id);
    $messages = Message::where('user_id', $currentUserId)->get();
    return view('index', ['messages' => $messages, 'item' => $item]);
}



    public function broadcast(Request $request)
    {
        // Validate the request data as needed.
        $this->validate($request, [
            'message' => 'required|string'
            // 'message_id'=>'required|string'
        ]);
        // $conversationId = $request->input('conversation_id'); // Replace with your actual input field name
        // $senderUserId = auth()->id();
        // $recipientUserId = $request->input('recipient_id'); // Replace with your actual input field name
        // $messageContent = $request->input('message');

        // // Create a new Message model and save it to the database.
        // $message = new Message();
        // $message->conversation_id = $conversationId;
        // $message->sender_id = $senderUserId;
        // $message->recipient_id = $recipientUserId;
        // $message->message = $messageContent;
        // $message->user_id = auth()->id();
        // $message->message = $request->input('message');
        // $message->save();

        // Create a new Message model and save it to the database.
        $message = new Message();
        $message->user_id = auth()->id(); // Assuming you're storing the user ID who sent the message.
        $message->message = $request->input('message');
        $message->name = auth()->user()->name;
        $message->save();
        $messageId = $message->id;
        // $message=Message::create([

        //     'name' => Auth::user()->name,
        //     'message' => $request->input('message'),

        //     'password' => Hash::make('superadmin')
        // ]);
        // Broadcast the message to other users.
        broadcast(new PusherBroadcast($request->input('message')))->toOthers();

        // Return a response indicating the message was saved.
        return view('broadcast', ['message' => $request->get('message'),'messageId' => $messageId]);
    }


    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
//     public function showConversation($conversationId)
// {
//     // Retrieve the conversation based on the conversation ID
//     $conversation = Conversation::find($conversationId);

//     if (!$conversation) {
//         // Handle the case where the conversation doesn't exist
//         // You can return an error response or redirect to an error page
//     }

//     // Retrieve the messages associated with this conversation
//     $messages = $conversation->messages;

//     // Pass the conversation and messages to the view
//     return view('conversation.show', ['conversation' => $conversation, 'messages' => $messages]);
// }


public function deleteMessage(Request $request)
{
    try {
        $messageId = $request->input('message_id');

        $message = Message::where('id', $messageId)
            ->where('user_id', auth()->id())
            ->first();

        if ($message) {
            $message->delete();

            return response()->json(['success' => true, 'msg' => 'Message Deleted Successfully!']);
        } else {
            return response()->json(['success' => false, 'msg' => 'Message not found or you do not have permission to delete it.']);
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}

public function destroy($id) {
    // Retrieve the message by ID and delete it
    $message = Message::find($id);
    if ($message) {
        $message->delete();
    }


    return redirect()->route('pusher.index')->with('success', 'Message supprimé avec succès.');
}

public function delete($id) {
    // Retrieve the message by ID and delete it
    $message = Message::find($id);
    if ($message) {
        $message->delete();
    }

    // Redirect back to the page, or to a specific URL
    return redirect()->back();
}

}
