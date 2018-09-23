<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Message;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public  function sendNewMessage(AddMessageRequest $request){
       $user=Auth::user();
       $recieveUser=User::findOrfail(intval($request->user_id));
       if($recieveUser){
           if($user->id !=   $recieveUser->id){
          $message=new Message();
          $message->title=strip_tags($request->title);
          $message->message=strip_tags($request->message);
          $message->user_message_you=$user->id;
          $message->user_id=$recieveUser->id;
          $message->seen=0;
          if($message->save()){
              makeNewNotification($recieveUser->id,$user->id,"ReciveMessage",$message->id);
              return 'done';
          }
           }
           abort(403);
       }
        abort(403);
       return 'false';
    }
    public function getSendMessagesByUser(){
        $user=Auth::user();

        return Message::where('user_message_you',$user->id)->with('GetRecievedUser')->orderBy('id','desc')->get();
    }
    public function GetMyRecievedMessages(){
        $user=Auth::user();

        return Message::where('user_id',$user->id)->with('GetSendUser')->orderBy('id','desc')->get();
    }
    public function GetThisMessageDetails($message_id){
        $message=Message::findoRfail(intval($message_id));
        if($message){
           $user=Auth::user();
           if($user->id == $message->user_id || $user->id == $message->user_message_you){
               if($message->seen==0 && $message->user_id ==$user->id){
                   $message->seen=1;
                   $message->save();
               }
               ////seenNotification
               MakeNotificationSeen($user->id,"ReciveMessage",$message_id);
               return Message::where('id',$message_id)->with('GetSendUser','GetRecievedUser')->get()[0];
           }
            abort(403);
        }
        abort(403);
        return 'false';
        }

        public  function GetUnreadMessage(){
            $user=Auth::user();

            return Message::where('user_id',$user->id)->where('seen',0)->with('GetSendUser')->orderBy('id','desc')->get();
        }

    public  function GetReadMessage(){
        $user=Auth::user();

        return Message::where('user_id',$user->id)->where('seen',1)->with('GetSendUser')->orderBy('id','desc')->get();
    }




}

