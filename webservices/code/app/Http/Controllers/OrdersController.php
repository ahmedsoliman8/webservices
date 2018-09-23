<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Notification;
use App\Order;
use App\Pay;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
  public  function AddOrder($services_id)
  {
      /**
       * 0 status ----- new order
       * 1 status ----- see by serviceProvider
       * 2 status ----- order agree
       * 3 status -----  cancel order
       * 4 status ----- finish order
       */
      $services = Service::findOrfail($services_id);
      if($services)
      {   $user = Auth::user();
          if($user->id != $services->user_id){
              $orderItBefore = Order::where('user_order',$user->id)->whereIn('status',[0,1,2])->where('services_id', $services->id)->count();
              if ($orderItBefore==0) {
                  $buyCheck=Buy::where('user_id',$user->id)->where('finish','!=',2)->sum('buy_price');
                  $pay=Pay::where('user_id',$user->id)->sum('price');

                  $ifUserHaveMoney=$pay-$buyCheck;

                  if($ifUserHaveMoney >= $services->price){

                      $orders = new Order();
                      $orders->services_id = $services_id;
                      $orders->user_order = $user->id;
                      $orders->user_id = $services->user_id;
                      $orders->status = 0;
                      $orders->type = 0;
                      if ($orders->save()) {
                          $buy=new Buy();
                          $buy->user_id=$user->id;
                          $buy->order_id=$orders->id;
                          $buy->buy_price=$services->price;
                          $buy->rev_id=$orders->user_id;
                          $buy->finish=0;
                          $buy->save();
                          makeNewNotification($services->user_id,$user->id,"ReciveOrder",$orders->id);

                          return 'true';
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

  public  function getMySendOrders($length=null){
      $user=Auth::user();
      if($length==null){
          $services=Order::where('user_order',$user->id)->with('services','getUserAddService')->orderBy('id','desc')->limit(env('limit'))->get();
      }else{
          $services=Order::where('user_order',$user->id)->with('services','getUserAddService')->orderBy('id','desc')->offset($length)->limit(env('limit'))->get();
      }


      $array=[
          'user' => $user,
          'services' => $services
      ];
      return $array;
  }
  public  function GetOrderById($order_id){
      $authUser=Auth::user();
     $order=Order::findOrfail($order_id);
     if($order){
         $user=User::where('id',$order->user_id)->with(['services' => function($query){
             return $query->where('status',1)->limit(3)->orderBy('id','desc');
         }])->get()[0];
         $order_user=User::where('id',$order->user_order)->with(['services' => function($query){
             return $query->where('status',1)->limit(3)->orderBy('id','desc');
         }])->get()[0];
        if($user->id != $order_user->id){
            if($authUser->id==$user->id){
                if( $order->status ==0){
                    $order->status=1;
                    $order->save();

                }

            }
          $order=Order::where('id',$order_id)->with('services')->get()[0];
          $order_count=Order::where('services_id',$order->services_id)->whereIn('status',[4,2,1,0])->count();
            ////seenNotification
            MakeNotificationSeen($authUser->id,"ReciveOrder",$order_id);
            MakeNotificationSeen($authUser->id,"CompleteOrder",$order_id);
            MakeNotificationSeen($authUser->id,"RejectOrder",$order_id);
            MakeNotificationSeen($authUser->id,"DoneOrder",$order_id);

            MakeNotificationSeen($authUser->id,"AddNewComment",$order_id);

            MakeNotificationSeen($authUser->id,"AdminMakeNew",$order_id);
            MakeNotificationSeen($authUser->id,"AdminMakeOld",$order_id);
            MakeNotificationSeen($authUser->id,"AdminAcceptOrder",$order_id);
            MakeNotificationSeen($authUser->id,"AdminRejectOrder",$order_id);
            MakeNotificationSeen($authUser->id,"AdminCloseOrder",$order_id);



          $array=[
            'user' => $user,
             'order_user'=>$order_user,
              'order'=>$order,
              'order_count' => $order_count,
              'auth_user' => $authUser
          ];
          return $array;
        }
        abort(403);
     }
     abort(403);
     return false;
  }



    public  function getMyIncomeOrders($length=null){
        $user=Auth::user();
        if($length==null){
            $services=Order::where('user_id',$user->id)->with('services','GetMyOrders')->orderBy('id','desc')->limit(env('limit'))->get();
        }else{
            $services=Order::where('user_id',$user->id)->with('services','GetMyOrders')->orderBy('id','desc')->offset($length)->limit(env('limit'))->get();
        }


        $array=[
            'user' => $user,
            'services' => $services
        ];
        return $array;
    }

    public  function changeStatus($order_id,$status){
     $order=Order::findOrfail(intval($order_id));
     if($order){
         $array=[2,3];
         if(in_array($status,$array)){
             if($status!=$order->status){
                $order->status= intval($status);
                if($status==3)
                {
                    $buy=Buy::where("order_id",$order_id)->get()[0];
                    $buy->finish=2;
                    $buy->save();

                }
                if($order->save()){

                    if($status==2)
                    {
                        makeNewNotification($order->user_order,$order->user_id,"DoneOrder",$order->id);
                    }else{

                        makeNewNotification($order->user_order,$order->user_id,"RejectOrder",$order->id);
                    }

                    return 'done';
                }
                 abort('403');
             }
             abort('403');
         }
         abort('403');
     }
        abort('403');
       return 'fail';
     }

     public function finishOrder($order_id){
     $user=Auth::user();
     $order=Order::findOrfail(intval($order_id));
     if($order){
         if($user->id==$order->user_order){
             if($order->status==2){
                 $order->status=4;
                 $buy=Buy::where("order_id",$order_id)->get()[0];
                 $buy->finish=1;
                 $buy->save();
                 if($order->save()){
                     makeNewNotification($order->user_id,$user->id,"CompleteOrder",$order->id);
                     return "done";
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
