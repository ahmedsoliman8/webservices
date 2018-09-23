<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected  $table="cats";

    public  function  services(){

        return $this->hasMany('App\Service','cat_id');
    }
}
