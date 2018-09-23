<?php

namespace App\Http\Controllers;

use App\Order;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware("admin");
    }

    public  function index(){
        $limit=env("limit");
        $users=User::withCount("services","ordersIMade","getMyServiceOrder")->paginate( $limit);

        return view("admin.users.all",compact("users"));
    }

    public function show($status){
        $limit=env("limit");
        $explode=explode("-",$status);

        $array=[
            "id",'created_at'
        ];

        if(in_array($explode[0],$array)){
             $users=User::orderBy($explode[0],$explode[1])->paginate($limit);

        }else{
            $users=User::where("admin",$explode[0])->paginate($limit);
        }
        return view("admin.users.all",compact("users"));

    }

    public function search(Request $request){
        $limit=env("limit");
        $search=strip_tags($request->search);
        $users=User::Where("id",  $search)
            ->orwhere("name","LIKE","%".$search."%")
            ->orderBy("id","desc")
            ->paginate( $limit);
        return view("admin.users.all",compact("users"));
    }
    public function  edit($id){
        $user=User::where("id",$id)->get()[0];
        $services=Service::where("user_id",$user->id)->get();
        $orders=Order::where("user_id",$user->id)->get();
        $ordersUser=Order::where("user_order",$user->id)->get();

        $getWaitProfit=\App\Profit::where('user_id',$user->id)->where('status',0)->sum('profit_price');
        $getDoneProfit=\App\Profit::where('user_id',$user->id)->where('status',1)->sum('profit_price');
        $userProfit=\App\Buy::where('rev_id',$user->id)->where('finish',1)->sum('buy_price');

        $doneProfit=\App\Profit::where('user_id',$user->id)->sum('profit_price');

        $p=$userProfit - $doneProfit;


        return view("admin.users.edit",compact("user","services","orders","ordersUser","getWaitProfit","getDoneProfit","p"));
    }

    public function  update($id,Request $request){

        $user=User::findOrfail($id);
        if($user){
            $user->name=$request->name;
            $user->admin=$request->admin;
            $user->email=$request->email;
            if($request->file('image')){
                $url=public_path().'/images/users/';
                if($user->image != ""){
                    if(file_exists($url.$user->image)){
                        @unlink($url.$user->image);
                    }
                }

                $image=$this->UploadImages($user->name,$request,'');
                $user->image=$image;
            }
            $user->save();
        }
       return redirect()->back();
    }

    protected function UploadImages($username,$request,$url){
        if($url==''){
            $url=public_path().'/images/users/';
        }

        $image = $request->file('image');
        $imageName=time().'_'.$username.'_'.$image->getClientOriginalName();

        $img = Image::make( $image );
        $img->fit(100, 100);
        $img->save($url.$imageName,60);
        return $imageName;
    }

}
