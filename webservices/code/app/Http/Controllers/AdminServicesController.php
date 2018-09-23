<?php

namespace App\Http\Controllers;

use App\Cat;

use App\Service;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdminServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware("admin");
    }

    public  function index($status=null){
          $limit=env("limit");
          $array=[
              "id-desc","id-asc","created_at-desc","created_at-asc"
          ];
        if($status != null){
            $explode=explode("-",$status);
             if(in_array($status,$array) || $explode[0] == "cat" ){
                 if($explode[0] == "cat"){
                     $services=Service::where("cat_id",$explode[1])->withCount("order")->with("user")->orderBy("id","desc")->paginate( $limit);
                 }else{
                     $services=Service::orderBy( $explode[0],$explode[1])->withCount("order")->with("user")->paginate( $limit);
                 }
             }
           else{
                $services=Service::where("status",$status)->withCount("order")->with("user")->paginate( $limit);
            }

        }else{
            $services=Service::with("user")->withCount("order")->paginate( $limit);
        }
      $cat=Cat::orderBy("id","desc")->get(["id","name"]);
        return view("admin.services.all",compact("services","cat"));
    }

public  function getAllUserServices($id){
    $limit=env("limit");
    $services=Service::where("user_id",$id)->with("user")->withCount("order")->paginate( $limit);
    $cat=Cat::orderBy("id","desc")->get(["id","name"]);
    return view("admin.services.all",compact("services","cat"));
}

    public  function search(Request  $request){
        $limit=env("limit");
     $search=strip_tags($request->search);
        $services=Service::Where("user_id",  $search)
            ->orwhere("name","LIKE","%".$search."%")
            ->withCount("order")
            ->with("user")
            ->orderBy("id","desc")
            ->paginate( $limit);

        $cat=Cat::orderBy("id","desc")->get(["id","name"]);
        return view("admin.services.all",compact("services","cat"));


    }

    public function acceptService($service_id,$status){
        $service=Service::findOrfail($service_id);
        if($service){
            if($status==1){
                makeNewNotification($service->user_id,Auth::user()->id,"AdminAcceptServices",$service->id);
            }else{
                makeNewNotification($service->user_id,Auth::user()->id,"AdminRejectServices",$service->id);
            }

            $service->status=$status;
            $service->save();
        }
        return redirect()->back();
    }

    public  function delete($service_id){
       Service::findOrfail($service_id)->delete();
        return Redirect("/admin/services");
    }

    public function  edit($id){
        $service=Service::where("id",$id)->with("user","cat","order")->withCount("view","vote")->get()[0];
        $sum=Vote::where("services_id",$service->id)->sum("vote");
        $cat=Cat::orderBy("id","asc")->where("id","!=",$service->cat_id)->get(["id","name"]);
        return view("admin.services.edit",compact("service","cat","sum"));
    }


    public  function update($id,Request $request){
      $service=Service::findOrfail($id);
      $user=User::findOrfail($service->user_id);
      $service->name=$request->name;
      $service->des=$request->des;
      $service->cat_id=$request->cat_id;
      $service->price=$request->price;

      if($request->file('image')){
       $image=$this->UploadImages($user->name,$request,'');
         $service->image=$image;
      }
      $service->save();
     return Redirect('/admin/services/'.$id.'/edit');

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
}
