<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected  $table="services";

    public  function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public  function cat(){
        return $this->belongsTo('App\Cat','cat_id');
    }

    public  function  order(){
        return $this->hasMany('App\Order','services_id');
    }

    public  function  vote(){
        return $this->hasMany('App\Vote','services_id');
    }

    public  function  view(){
        return $this->hasMany('App\View','service_id');
    }


}
