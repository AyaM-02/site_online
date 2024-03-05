<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
class MessagesController extends Controller
{
    public function index($receiver){
        //
        $verzonden = message::where('user_sender_id',Auth::id())->where('user_receiver_id',$receiver)->get();

        $ontvangen = message::where('user_sender_id',$receiver)->where('user_receiver_id',Auth::id())->get();

        return view('/messages/index',['verzondenBerichten'=>$verzonden,'ontvangenBerichten'=>$ontvangen, 'receiver'=>$receiver]);
    }
    
    public function sendbericht($receiver,request $request){
        
        $data = $request->all();


        $bericht = new Message;
        $bericht->user_sender_id = Auth::id();
        $bericht->user_receiver_id = $receiver;
        $bericht->text =  $data['bericht'];

        $bericht->save();

        return redirect()->route('messages.index',$receiver);

    }
}
