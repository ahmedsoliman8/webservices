<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Comment;
use App\Order;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware("admin");
    }

    public  function index(){
        $limit=env("limit");
        $orders=Order::with("GetMyOrders","getUserAddService","services")->paginate( $limit);
        return view("admin.orders.all",compact("orders"));
    }

    public function show($status){
        $limit=env("limit");
        $explode=explode("-",$status);

        $array=[
          "id",'created_at'
        ];
        //dd($explode);
        if(in_array($explode[0],$array)){
            $orders=Order::orderBy($explode[0],$explode[1])->with("GetMyOrders","getUserAddService","services")->paginate( $limit);
        }else{
            $orders=Order::where("status",$explode[0])->with("GetMyOrders","getUserAddService","services")->paginate( $limit);
        }
        return view("admin.orders.all",compact("orders"));

    }

    public  function  edit($id){
        $order=Order::where("id",$id)->with("GetMyOrders","getUserAddService","services","comment")->get()[0];
        return view("admin.orders.edit",compact("order"));
    }

    public function search(Request $request){
        $limit=env("limit");
        $search=strip_tags($request->search);
        $orders=Order::where("id",$search)
            ->with("GetMyOrders","getUserAddService","services")
            ->paginate( $limit);

        return view("admin.orders.all",compact("orders"));
    }
    public  function delete($order_id){
        Order::findOrfail($order_id)->delete();
        return Redirect("/admin/orders");
    }

    public function deleteComment($comment_id){
        Comment::findOrfail($comment_id)->delete();
        return redirect()->back();
    }

    public function changeOrderStatus(Request $request){
      $order=  Order::findOrfail($request->order_id);
      $service=Service::findOrfail($order->services_id);
      if($order){
          if($request->status != 4){
        Buy::where("order_id",$request->order_id)->where("rev_id",$request->rev_id)->where("user_id",$request->user_id)->delete();

          }else{
              if(Buy::where("order_id",$request->order_id)->where("rev_id",$request->rev_id)->where("user_id",$request->user_id)->count() == 0)
              {
                  $buy=new  Buy();
                  $buy->rev_id=$order->user_id;
                  $buy->user_id=$order->user_order;
                  $buy->order_id=$order->id;
                  $buy->buy_price=$service->price;
                  $buy->finish=1;
                  $buy->save();
              }

          }
          $user=Auth::user();
          if($request->status ==0){
            $status="AdminMakeNew";
          }
          elseif ($request->status ==1){
              $status="AdminMakeOld";
          }  elseif ($request->status ==2){
              $status="AdminAcceptOrder";
          } elseif ($request->status ==3){
              $status="AdminRejectOrder";
          } elseif ($request->status ==4){
              $status="AdminCloseOrder";
          }
          makeNewNotification($order->user_order,$user->id,$status,$order->id);
          makeNewNotification($order->user_id,$user->id,$status,$order->id);

          $order->status=$request->status;
          $order->save();
      }
        return redirect()->back();
    }


    public function getAllOrders($id){
        $limit=env("limit");
        $orders=Order::where("services_id",$id)->with("GetMyOrders","getUserAddService","services")->paginate( $limit);
        return view("admin.orders.all",compact("orders"));
    }

    public function getAllUserOrdersMade($id){
        $limit=env("limit");
        $orders=Order::where("user_order",$id)->with("GetMyOrders","getUserAddService","services")->paginate( $limit);
        return view("admin.orders.all",compact("orders"));
    }

    public function getAllMyServicesOrders($id){
        $limit=env("limit");
        $orders=Order::where("user_id",$id)->with("GetMyOrders","getUserAddService","services")->paginate( $limit);
        return view("admin.orders.all",compact("orders"));
    }



}
