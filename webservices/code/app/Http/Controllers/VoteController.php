<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public  function addNewVote($val,$service_id){
        $service=Service::findOrfail($service_id);
        $user=Auth::user();
        if($service){
            if( $service->user_id != $user->id){
                $array=[1,2,3,4,5];
                if(in_array($val,$array)){

                    $serviceItVoteBefore=Vote::where('services_id',$service->id)->where('user_id',$user->id)->count();
                    if($serviceItVoteBefore==0){
                        $vote=new Vote();
                        $vote->user_id=$user->id;
                        $vote->services_id=$service->id;
                        $vote->vote=intval($val);
                        if($vote->save()){
                            return 'done';
                        }
                        abort('403');
                    }
                    abort('403');
                }
                abort('403');
            }
            abort('403');
        }
     abort('403');
        return 'false';
    }



}
