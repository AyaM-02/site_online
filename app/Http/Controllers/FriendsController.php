<?php

namespace App\Http\Controllers;


use App\Models\Game;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index(){
        return view('/friends/index',['users'=>User::all(),'Friends'=>Friend::where('user_sender_id',Auth::id())->get(),'games'=>Game::all()]);

    }

    public function addfriend($id){
        $friend = new Friend;
        $friend->user_sender_id = Auth::id();
        $friend->ontvanger_id = $id;
        $friend->status = "verzonden";
        $friend->date_accepted = Carbon::now();
        $friend->save();

        $friend2 = new Friend;
        $friend2->user_sender_id =  $id;
        $friend2->ontvanger_id =Auth::id();
        $friend2->status = "gekregen";
        $friend2->date_accepted = Carbon::now();
        $friend2->save();

        return redirect()->route('friends.index');
    }

    public function acceptfriend($id){
        
        Friend::where('user_sender_id', Auth::id())
        ->where('ontvanger_id', $id)
        ->update(['status' => 'accepted']);

        Friend::where('ontvanger_id', Auth::id())
        ->where('user_sender_id', $id)
        ->update(['status' => 'accepted']);

        return redirect()->route('friends.index');
    }

    public function declinefriend($id){
        
        Friend::where('user_sender_id', Auth::id())
        ->where('ontvanger_id', $id)->delete();
        
        Friend::where('ontvanger_id', Auth::id())
        ->where('user_sender_id', $id)->delete();
        
        return redirect()->route('friends.index');
    }
}
