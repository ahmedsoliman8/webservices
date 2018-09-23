<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected  $table="views";

    public  function services(){
        return $this->belongsTo('App\Service','service_id');
    }
}
