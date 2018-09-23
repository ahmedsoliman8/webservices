<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bu extends Model
{
    protected  $table ='bu';
    protected  $fillable=[
        'bu_name', 'bu_price','bu_room', 'bu_rent', 'bu_square', 'bu_type', 'bu_small_dis', 'bu_meta',
        'bu_langtuide', 'bu_laltitude', 'bu_large_dis', 'bu_status',  'user_id','bu_place','image','month','year'

    ];
}
