<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected  $table="profit";

    public  function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
