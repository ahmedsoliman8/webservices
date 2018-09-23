<?php

namespace App\Http\Controllers;


use App\Buy;
use App\Profit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pay;

class UserController extends Controller
{
    public  function getAuthUser(){
          return Auth::user();
    }

    public  function getAllChargeOperation(){
        $user=Auth::user();
        $pay= Pay::where('user_id',$user->id)->orderBy("id","desc")->get();
        $sum=Pay::where('user_id',$user->id)->sum('price');
        $array= [
            'user' => $user,'pay' => $pay,'sum' => $sum
        ];
        return $array;

    }
    public  function ShowAllPay(){
        $user=Auth::user();
        $buy= Buy::where('user_id',$user->id)->orderBy("id","desc")->get();
        $sum=Buy::where('user_id',$user->id)->where('finish','!=',2)->sum('buy_price');
        $array= [
            'user' => $user,'buy' => $buy,'sum' => $sum
        ];
        return $array;
    }

    public function ShowAllProfit(){
        $user=Auth::user();
        $profit= Buy::where('rev_id',$user->id)->where('finish','1')->orderBy("id","desc")->get();
        $sum=Buy::where('rev_id',$user->id)->where('finish',1)->sum('buy_price');
        $array= [
            'user' => $user,'profit' => $profit,'sum' => $sum
        ];
        return $array;
    }

    public function showAllBalance(){
        /**
         * charage operations
         * pay operations
         * profit operation
         */
        $user=Auth::user();
        $userProfit=Buy::where('rev_id',$user->id)->where('finish',1)->sum('buy_price');
        $userPay=Buy::where('user_id',$user->id)->where('finish','!=',2)->sum('buy_price');
        $userCharge=Pay::where('user_id',$user->id)->sum('price');
        $profitDone=  Profit::where("user_id",$user->id)->sum("profit_price");

        $getWaitProfit=Profit::where("user_id",$user->id)->where("status",0)->sum("profit_price");
        $getDoneProfit=Profit::where("user_id",$user->id)->where("status",1)->sum("profit_price");

        $p= $userProfit -  $profitDone;

        $array= [
            'user' => $user,
            'userProfit' =>   $p,
            'userPay' => $userPay,
            'userCharge' => $userCharge,
            'waitProfit' =>  $getWaitProfit,
            "DoneProfit" => $getDoneProfit
        ];
        return $array;

    }

    public  function ShowAllOrderProfit (){
        $user=Auth::user();
        $profit= Profit::where('user_id',$user->id)->orderBy("id","desc")->get();
        $sumWaiting=Profit::where('user_id',$user->id)->where("status",0)->sum("profit_price");
        $sumDone=Profit::where('user_id',$user->id)->where("status",1)->sum("profit_price");

        $array= [
            'user' => $user,'profit' => $profit,'sumWaiting' => $sumWaiting,"sumDone"=>$sumDone
        ];
        return $array;
    }

    public function GetProfit(Request $request){
        $profit= intval($request->profit);
        $user=Auth::user();
        $userProfit= intval( Buy::where('rev_id',$user->id)->where('finish',1)->sum('buy_price'));
        $profitDone= intval( Profit::where("user_id",$user->id)->sum("profit_price"));
        $p=$userProfit - $profitDone;
        if( $profitDone < $userProfit ){
            if($p > 10){
                if($profit <= $p  && $profit > 0 ){
                    $prof=new Profit();
                    $prof->user_id=$user->id;
                    $prof->profit_price=$profit;
                    $prof->status=0;
                    $prof->time=time();
                    if($prof->save()){

                        return $profit;
                    }
                    abort('403');
                }
                abort('403');
            }

            abort('403');
        }
        abort('403');
        return "error";
    }
}
