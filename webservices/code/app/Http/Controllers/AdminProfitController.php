<?php

namespace App\Http\Controllers;

use App\Profit;
use Illuminate\Http\Request;

class AdminProfitController extends Controller
{
    public function __construct()
    {
        $this->middleware("admin");
    }
    public  function index(){
        $limit=env("limit");
        $profit=Profit::with("user")->paginate( $limit);
        return view("admin.profit.all",compact("profit"));
    }
    public function show($status){

        $limit=env("limit");
        $explode=explode("-",$status);

        $array=[
            "id",'created_at'
        ];
        //dd($explode);
        if(in_array($explode[0],$array)){
            $profit=Profit::orderBy($explode[0],$explode[1])->with("user")->paginate( $limit);
        }else{
            $profit=Profit::where("status",$explode[0])->with("user")->paginate( $limit);
        }
        return view("admin.profit.all",compact("profit"));

    }
    public function search(Request $request){
        $limit=env("limit");
        $search=strip_tags($request->search);
        $profit=Profit::where("id",$search)
            ->with("user")
            ->paginate( $limit);

        return view("admin.profit.all",compact("profit"));
    }

    public  function  getUserProfitStatus($id,$status){
        $limit=env("limit");
        $profit=Profit::where("user_id",$id)->where("status",$status)->with("user")->paginate( $limit);
        return view("admin.profit.all",compact("profit"));
    }

   public  function getTodayProfit($status=null){
       $limit=env("limit");
       $date=(new \Moment\Moment('@'.time(), 'CET'))->subtractDays(env("profitDay"))->format('Y-m-d');
       if($status==null){
           $profit=Profit::where('created_at','>',$date.' 00:00:00')->where('created_at','<',$date.' 23:59:59')->paginate($limit);
       }else{
           $profit=Profit::where('created_at','>',$date.' 00:00:00')->where('created_at','<',$date.' 23:59:59')->where("status",$status)->paginate($limit);
       }


        return view("admin.profit.all",compact("profit"));
   }


   public  function ProfitByDate(Request $request){
       $limit=env("limit");
       $date= str_replace('/','-',$request->search);
       $date=(new \Moment\Moment($date, 'CET'))->subtractDays(env("profitDay"))->format('Y-m-d');

       $profit=Profit::where('created_at','>',$date.' 00:00:00')->where('created_at','<',$date.' 23:59:59')->paginate($limit);
       return view("admin.profit.all",compact("profit"));

   }
}
