<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SiteSetting;
class SiteSettingController extends Controller
{
    public function index(SiteSetting $sitesetting){
      $sitesetting=$sitesetting->all();
      return view('admin.sitesetting.index',compact('sitesetting'));
    }

    public function store(Request $request){
     foreach (array_except($request->toArray(), ['_token','submit']) as $key=>$req ) {
       $siteSettingUpdate=SiteSetting::where('namesetting',$key)->first();
       if($siteSettingUpdate->type !=3){
           $siteSettingUpdate->fill(['value'=>$req])->save();
       }
       else{

           $fileName=uploadImage($req,'/public/website/slider/','1600','500',$siteSettingUpdate->value);

               $siteSettingUpdate->fill(['value'=>$fileName])->save();
       }
     }
     return Redirect('/adminpanel/sitesetting')->withFlashMessage('تم التعديل على الإعدادات بنجاح');
    }
}
