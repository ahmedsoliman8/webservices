<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Http\Requests\AddServicesRequest;
use App\Order;
use App\Service;
use App\User;
use App\View;
use App\Vote;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class ServicesController extends Controller
{
    public function addServices(AddServicesRequest $request){

        $user=Auth::user();
        $array=[5,10,15,20,25];
        if (in_array($request->price,$array)){

            $image=$this->UploadImages($user->name,$request,'');
            $services=new Service();
            $services->name=$request->name;
            $services->des=$request->des;
            $services->image=$image;
            $services->cat_id=$request->cat_id;
            $services->price=$request->price;
            $services->user_id=$user->id;
            $services->status=0;
            if($services->save()){
                return 'done';
            }
            else{
                return 'error';
            }


        }
      return 'checkpricefile';
    }

    protected function UploadImages($username,$request,$url){
        if($url==''){
            $url=public_path().'/images/services/';
        }

        $image = $request->file('image');
        $imageName=time().'_'.$username.'_'.$image->getClientOriginalName();

        $img = Image::make( $image );
        $img->fit(800, 400);
        $img->save($url.$imageName,60);
        return $imageName;
    }

    public function getMyServices($length=null){
        $user=Auth::user();
        if($user){
            $query=DB::table('services');
            $query->join('users','users.id','=','services.user_id');
            $query->leftJoin('views','services.id','=','views.service_id');
            $query->select('services.id','services.name','services.price','services.status','services.des','services.image',DB::raw('users.id as user_id'),DB::raw('users.name as username'),
                DB::raw('COUNT(views.id) as view_count')

            );
            $query->where('services.user_id',$user->id);
        $query->groupBy('services.id');
            if($length==null){
                $query->limit(env('limit'));
            }else{
                $query->offset($length)->limit(env('limit'));
            }
        $query->orderBy('services.id','asc');
        $services=$query->get();
        $array=[
            'services' => $services,
            'user' => $user
        ];
        return $array;
        }

    }

    public function GetServicesById($services_id){
        /**** Add New View ****/
        $services= Service::where('id',$services_id)->with('user')->withCount('vote')->get()[0];
        $ip=$_SERVER['REMOTE_ADDR'];
        if(View::where('ip',$ip)->where('service_id',$services->id)->count()==0){
            $guest=Auth::guest();
            $view=new View();
            $view->service_id=$services_id;
            if($guest){
                $view->user_id=0;
            }else{
                $view->user_id=Auth::user()->id;
            }
            $view->ip=$ip;
            $view->save();
        }
        /*****  getdata  ****/
        $sum=Vote::where('services_id',$services->id)->sum('vote');
        if($services->status != 1){
            if(Auth::guest()){
                abort(403);
            }else{
                if(Auth::user()->id !=$services->user_id){


                    abort(403);
                }

            }

        }
        MakeNotificationSeen($services->user_id,"AdminAcceptServices",$services->id);
        MakeNotificationSeen($services->user_id,"AdminRejectServices",$services->id);
        $order_count=Order::where('services_id',$services_id)->whereIn('status',[4,2,1,0])->count();

        if(Auth::guest()){
            $myownServiceInsameCat=[];
            $otherServiceInsameCat=[];
        }else{
            $user=Auth::user();
            $myownServiceInsameCat=Service::where('cat_id',$services->cat_id)
                ->where('user_id',$user->id)
                ->where('id','!=',$services->id)
                ->with('user')
                ->withCount('view')
                ->orderBy('id','desc')
                ->limit(6)
                ->get();
            $otherServiceInsameCat=Service::where('cat_id',$services->cat_id)
                ->where('status',1)
                ->where('user_id','!=',$user->id)
                ->where('id','!=',$services->id)
                ->with('user')
                ->orderBy('id','desc')
                ->with('vote')
                ->limit(6)
                ->get();
        }

        $mostVoted=Service::join('users','users.id','=','services.user_id')
            ->leftJoin('votes','services.id','=','votes.services_id')
            ->select('services.id','services.name' ,DB::raw('SUM(votes.vote) as vote_sum'))
            ->where('services.cat_id',$services->cat_id)
            ->groupBy('services.id')
            ->where('services.status',1)
            ->where('services.id','!=',$services->id)
            ->having('vote_sum','>',0)
            ->orderBy('vote_sum','desc')
            ->limit(6)
            ->get();

        $mostViewed=Service::join('users','users.id','=','services.user_id')
            ->leftJoin('views','services.id','=','views.service_id')
            ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))
            ->where('services.cat_id',$services->cat_id)
            ->groupBy('services.id')
            ->where('services.status',1)
            ->where('services.id','!=',$services->id)
            ->having('view_count','>',0)
            ->orderBy('view_count','desc')
            ->limit(6)
            ->get();

        ///append to user orders
        $guest=Auth::guest();
        if(!$guest){
            $user=Auth::user();
            $orderCat=Order::join('services','orders.services_id','=','services.id')
                ->where('user_order',$user->id)
                ->pluck('services.cat_id')->all();


            $sideBarSection2=Service::join('users','users.id','=','services.user_id')
                ->select('services.id','services.name')
                ->where('services.id','!=',$services->id)
                ->where('services.status',1)
                ->whereIn('services.cat_id',$orderCat)
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }else{
            $sideBarSection2=null;
        }




        $array=[
            'service' => $services,
            'myownServiceInsameCat' => $myownServiceInsameCat,
            'otherServiceInsameCat' => $otherServiceInsameCat,
            'order_count'=> $order_count,
            'sum' => $sum,
            'mostVoted' => $mostVoted,
            'mostViewed' => $mostViewed,
            'sideBarSection2' => $sideBarSection2
        ];
        return $array;
    }

    public  function getUserServices($user_id,$length=null){
       $user_id=intval($user_id);
       $user=User::findOrfail($user_id);
       if($user){
           $query=DB::table('services');
           $query->join('users','users.id','=','services.user_id');
           $query->leftJoin('votes','services.id','=','votes.services_id');
           $query->select('services.id','services.name','services.image', 'services.price',DB::raw('SUM(votes.vote) as vote_sum'),
               DB::raw('users.name as username'),DB::raw('users.id as user_id'),DB::raw('COUNT(votes.id)as vote_count'));
           $query->groupBy('services.id');
           $query->where('services.status',1);
           $query->where('services.user_id',$user_id);
           if($length==null){
               $query->limit(env('limit'));
           }else{
               $query->offset($length)->limit(env('limit'));
           }
           $query->orderBy('vote_sum','desc');
           $services=$query->get();
           $array=[
               'services' => $services,
               'user' => $user
           ];
           return $array;
       }



    }

    public  function getAllServices($length=null){
        //MainServices
        $query=DB::table('services');
        $query->join('users','users.id','=','services.user_id');
        $query->leftJoin('votes','services.id','=','votes.services_id');
        $query->select('services.id','services.name','services.image', 'services.price',DB::raw('SUM(votes.vote) as vote_sum'),
                DB::raw('users.name as username'),DB::raw('users.id as user_id'),DB::raw('COUNT(votes.id)as vote_count'));
        $query->groupBy('services.id');
        $query->where('services.status',1);
        $query->orderBy('vote_sum','desc');

        if($length==null){
            //Cats
            $cat=Cat::get(['id','name']);

            //RelatedServices
            $ip=$_SERVER['REMOTE_ADDR'];
            $checkIfHasViewBeFor=View::where('ip',$ip)->count();

            if( $checkIfHasViewBeFor == 0){
                //MostViewed
                $mostViewedSideBar=Service::join('users','users.id','=','services.user_id')
                    ->leftJoin('views','services.id','=','views.service_id')
                    ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))
                    ->groupBy('services.id')
                    ->where('services.status',1)
                    ->orderBy('view_count','desc')
                    ->limit(6)
                    ->get();
            }else{
                $catView=View::join('services','views.service_id','=','services.id')
                    ->where('ip',$ip)
                    ->pluck('services.cat_id')->all();

                $mostViewedSideBar=Service::join('users','users.id','=','services.user_id')
                    ->leftJoin('views','services.id','=','views.service_id')
                    ->select('services.id','services.name' ,DB::raw('COUNT(views.id) as view_count'))
                    ->groupBy('services.id')
                    ->where('services.status',1)
                    ->whereIn('services.cat_id',$catView)
                    ->orderBy('view_count','desc')
                    ->limit(6)
                    ->get();
            }
            $sideBarSection3= Service::leftJoin('orders','services.id' , '=', 'orders.services_id')
                ->select('services.id', 'services.name', DB::raw('COUNT(orders.id) as orders_count'))
                ->groupBy('services.id')
                ->where('services.status', 1)
                ->having('orders_count','>',0)
                ->orderBy('orders_count', 'desc')
                ->limit(6)
                ->get();
            ///append to user orders
            $guest=Auth::guest();
            if(!$guest){
                $user=Auth::user();
                $orderCat=Order::join('services','orders.services_id','=','services.id')
                    ->where('user_order',$user->id)
                    ->pluck('services.cat_id')->all();


                $sideBarSection2=Service::join('users','users.id','=','services.user_id')
                    ->select('services.id','services.name')
                    ->where('services.status',1)
                    ->whereIn('services.cat_id',$orderCat)
                    ->inRandomOrder()
                    ->limit(6)
                    ->get();
            }else{
                $sideBarSection2 = null;
                $mostViewedSideBar=null;
                $sideBarSection3=null;

            }

            $query->limit(env('limit'));
            $services=$query->get();
            $array=[
                'services' => $services,
                'cat' => $cat,
                'mostViewedSideBar' => $mostViewedSideBar,
                'sideBarSection2' =>  $sideBarSection2,
                'sideBarSection3' => $sideBarSection3
            ];
            return $array;
        }else{
            $query->offset($length)->limit(env('limit'));
            $services=$query->get();
            return $services;
        }
    }
}
