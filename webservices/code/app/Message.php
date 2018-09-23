<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected  $table="messages";

    public  function  GetSendUser(){
        return $this->belongsTo('App\User','user_message_you');
    }


    public  function  GetRecievedUser(){
        return $this->belongsTo('App\User','user_id');
    }

}
