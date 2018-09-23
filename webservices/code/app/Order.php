<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $table="orders";

    public  function comment(){
        return $this->hasMany('App\Comment','order_id');
    }

    public  function  services(){
        return $this->belongsTo('App\Service','services_id');
    }

    public  function  GetMyOrders(){
        return $this->belongsTo('App\User','user_order');
    }

    public  function  getUserAddService(){
        return $this->belongsTo('App\User','user_id');

    }


}
