<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\User;

class ChatController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Chat::where('tosend_id',Auth::user()->id)->get();
        return $chats;
    }


    public function user($userId)
    {
        $sendBack = Chat::where('tosend_id',Auth::user()->id)->where('user_id',$userId)->get();
        $mySent =  Chat::where('user_id',Auth::user()->id)->where('tosend_id',$userId)->get();
        $user= User::where('id',$userId)->first();


        $chats = $sendBack->concat($mySent);
        $chats = collect($chats)->sortBy('created_at');
        // return $chats;
        return view('dashboard',compact(['chats','user']));
        // return [$chats,$mySent];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send($userId,Request $request)
    {
        $chat = new Chat();
        $chat->message = $request->message;
        $chat->user_id = Auth::user()->id;
        $chat->tosend_id = $userId;
        $chat->save();
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();
        return response()->json(['chat was removed']);
    }
}
