<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public  function GetNotification(){
        $user=Auth::user();
        $not=Notification::where('user_id',$user->id)->with('user')->orderBy("id","desc")->get();
       $array=[
         "user" => $user,
         "not" => $not
       ];
        return $array;
    }

    public  function getAllInfo(){
        $cat=Cat::get(['id','name']);
        if(Auth::user()){
            $user=Auth::user();
            $fav=getFavNumber($user->id);
            $note=getAllNotification($user->id);
            $orders=getAllPayOrders($user->id);

            return [
                "login" => "doneLogin",
                "fav"  => $fav,
                "note" =>  $note,
                "orders" => $orders,
                'cat' => $cat
            ];
        }
        return [ "login" => "errorLogin" , "cat" => $cat];

    }

    public  function getNotUser(){
        $user=Auth::user();
        $note= getAllNotificationObjects($user->id);
        MakeAllUserNotificationSeen($user->id);

        $noteSum=getAllNotification($user->id);

        return [
            "note" => $note,
            "noteSum" => $noteSum
        ];
    }

}
