<?php

namespace App\Http\Controllers;

use App\Fav;
use App\Service;
use Illuminate\Support\Facades\Auth;

class FavController extends Controller
{

    public  function AddFav($service_id){
        $services = Service::findOrfail($service_id);
        if($services){
            $user=Auth::user();
            if($user->id != $services->user_id){
                $favItBefore=Fav::where('user_id',$user->id)->where('service_id',$services->id)->count();
                if($favItBefore==0){
                    $fav=new Fav();
                    $fav->user_id=$user->id;
                    $fav->service_id=$services->id;
                    $fav->own_user=$services->user_id;
                    if($fav->save()){
                        return Fav::where('user_id',$user->id)->count();
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

    public  function getUserFav(){
     $user=Auth::user();
     return Fav::where('user_id',$user->id)->with('services','getOwnUserService')->orderBy('id','desc')->get();
    }

    public  function deleteFav($id){
        $fav=Fav::findOrfail($id);
        $user=Auth::user();
        if($fav){
            if($fav->user_id == $user->id ){
                if($fav->find($id)->delete()){
                   return 'done';
                }
            }
            abort('403');
        }
        abort('403');
        return 'false';
    }
}
