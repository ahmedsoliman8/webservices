<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    protected  $table="favs";

    public  function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public  function services(){
        return $this->belongsTo('App\Service','service_id');
    }

    public  function getOwnUserService(){
        return $this->belongsTo('App\User','own_user');
    }
}
