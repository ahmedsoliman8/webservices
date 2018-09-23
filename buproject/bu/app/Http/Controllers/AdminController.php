<?php

namespace App\Http\Controllers;

use App\bu;
use App\ContactUs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index(User $user,bu $bu,ContactUs $contactUs){

      $buCountActive=countAllBuAppendToStatus(1);
      $buWaiting=countAllBuAppendToStatus(0);
      $usersCount=$user::count();
      $contactusCount=$contactUs::count();
      $mapping=$bu::select('bu_laltitude','bu_langtuide','bu_name')->get();
      $chart=$bu::select(DB::raw('COUNT(*) as counting,month'))->where('year',date('Y'))->groupBy('month')->orderBy('month','asc')->get()->toArray();
        $array=[];
        if(isset($chart[0]['month'])){
            for($i=1;$i<$chart[0]['month'];$i++)
            {
                $array[]=0;
            }
        }
        $new=array_merge($array,$chart);
      $lastestUsers=$user::take('8')->orderBy('id','desc')->get();
      $lastestBu=$bu::take('10')->orderBy('id','desc')->get();
      $lastestcontactus=$contactUs::take('10')->orderBy('id','desc')->get();
        return view('admin.home.index',compact('buCountActive','buWaiting','usersCount','contactusCount','mapping','new','lastestUsers','lastestBu','lastestcontactus'));

    }

    public  function  showYearStatics(bu $bu){
        $year=date('Y');
        $chart=$bu::select(DB::raw('COUNT(*) as counting,month'))->where('year',date('Y'))->groupBy('month')->orderBy('month','asc')->get()->toArray();
        $array=[];
        if(isset($chart[0]['month'])){
            for($i=1;$i<$chart[0]['month'];$i++)
            {
                $array[]=0;
            }
        }

        $new=array_merge($array,$chart);
        return view('admin.home.statics',compact('year','new'));
    }

    public  function showThisYear(Request $request,bu $bu){
        $year=$request->year;
        $chart=$bu::select(DB::raw('COUNT(*) as counting,month'))->where('year',$year)->groupBy('month')->orderBy('month','asc')->get()->toArray();
        $array=[];
        if(isset($chart[0]['month'])){
            for($i=1;$i<$chart[0]['month'];$i++)
            {
                $array[]=0;
            }
        }
        $new=array_merge($array,$chart);
        return view('admin.home.statics',compact('year','new'));
    }
}
