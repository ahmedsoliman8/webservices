<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected  $table="votes";

    public  function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public  function services(){
        return $this->belongsTo('App\Service','services_id');
    }

}
