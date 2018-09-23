<?php

function getFavNumber($user_id){
    return \App\Fav::where('user_id',$user_id)->count();
}

function getAllPayOrders($user_id){
    return \App\Order::where("user_order",$user_id)->where("status",0)->count();
}

function getAllNotification($user_id){
    return \App\Notification::where("user_id",$user_id)->where("seen",0)->count();
}

function getAllNotificationObjects($user_id){


   return \App\Notification::where("user_id",$user_id)->with('user')->orderBy("id","desc")->limit(7)->get();
}

function MakeNotificationSeen($userID,$type,$id){
    $notification=\App\Notification::where("notify_id",$id)->where("type",$type)->where("seen",0)->where("user_id",$userID)->get();

    if( count($notification) > 0){
        if(count($notification) == 0){
            $notification[0]->seen=1;
            $notification[0]->save();
        }else{
         foreach ($notification as $not){
            $n=\App\Notification::find($not->id);
             $n->seen=1;
             $n->save();
         }
        }

    }
}

function MakeAllUserNotificationSeen($userID){
    $notification=\App\Notification::where("seen",0)->where("user_id",$userID)->get();
    if( count($notification) > 0){
        if(count($notification) == 0){
            $notification[0]->seen=1;
            $notification[0]->save();
        }else{
            foreach ($notification as $not){
                $n=\App\Notification::find($not->id);
                $n->seen=1;
                $n->save();
            }
        }

    }
}

function makeNewNotification($user_id,$notify_id,$type,$id){
    $not=new \App\Notification();
    $not->user_id = $user_id;
    $not->user_notify_you = $notify_id;
    $not->type=$type;
    $not->seen=0;
    $not->notify_id=$id;
    $not->save();
}