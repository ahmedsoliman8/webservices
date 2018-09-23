<?php

namespace App\Http\Controllers;

use App\bu;
use App\Http\Requests\BuRequest;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class BuController extends Controller
{
    public  function  index(Request $request)
    {  $id = $request->id !== null ? '?user_id='.$request->id : null;
        return view('admin.bu.index',compact('id'));
    }

    public function create(){
        return view('admin.bu.add');
    }
    public  function store(BuRequest $buRequest,bu $bu){
        if($buRequest->file('image')){

            $fileName=uploadImage($buRequest->file('image'));

        }else{
            $fileName='';
        }

     $user=Auth::user();
      $data=[
          'bu_name' => $buRequest->bu_name,
          'bu_price' => $buRequest->bu_price,
          'bu_room' => $buRequest->bu_room,
          'bu_rent' => $buRequest->bu_rent,
          'bu_square' => $buRequest->bu_square,
          'bu_type' => $buRequest->bu_type,
          'bu_small_dis' => $buRequest->bu_small_dis,
          'bu_meta' => $buRequest->bu_meta,
          'bu_langtuide' => $buRequest->bu_langtuide,
          'bu_laltitude' => $buRequest->bu_laltitude,
          'bu_large_dis' => $buRequest->bu_large_dis,
          'bu_status' => $buRequest->bu_status,
          'user_id' => $user->id,
          'bu_place' => $buRequest->bu_place,
          'image' => $fileName,
          'month' => date('m'),
          'year' => date('Y')

      ];
      $bu->create($data);
      return Redirect('/adminpanel/bu')->withFlashMessage('تم اضافة العقار بنجاح');
    }
    public  function edit($id){
     $bu=bu::find($id);
     if($bu->user_id==0){
         $user='';
     }else{
         $user=User::where('id',$bu->user_id)->get()[0];
     }
    return view('admin.bu.edit',compact('bu','user'));
    }
    public function update($id,BuRequest $buRequest){
        $buUpdate=bu::find($id);
        $buUpdate->fill(array_except($buRequest->all(),['image']))->save();
        if($buRequest->file('image')){
            $fileName=uploadImage($buRequest->file('image'),'/public/website/buImages/','500','362',$buUpdate->image);

            $buUpdate->fill(['image'=>$fileName])->save();
        }

        return Redirect('/adminpanel/bu')->withFlashMessage('تم تعديل العقار بنجاح');
    }
    public function destory($id){
            $bu=bu::find($id)->delete();
            return Redirect('/adminpanel/bu')->withFlashMessage('تم الحذف بنجاح');

    }
    public function anyData(Request $request,bu $bu)
    {
        if($request->user_id){
            $bus = $bu->where('user_id',$request->user_id)->get();
        }else{
            $bus = $bu->all();
        }

        return Datatables::of($bus)
            ->editColumn('bu_name', function ($model) {
                return '<a href="'.url('/adminpanel/bu/' . $model->id . '/edit').'">'.$model->bu_name.'</a>';
            })
            ->editColumn('bu_type', function ($model) {
                $type=bu_type();
                return '<span class="badge badge-warning">' . $type[$model->bu_type] . '</span>';
            })

            ->editColumn('bu_status', function ($model) {
                return $model->bu_status == 0 ? '<span class="badge badge-info">' . 'غير مفعل' . '</span>' : '<span class="badge badge-warning">' . 'مفعل' . '</span>';
            })
            ->editColumn('control', function ($model) {
                $all = '<a href="' . url('/adminpanel/bu/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                $all .= '<a href="' . url('/adminpanel/bu/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>';
                 return $all;
            })
            ->rawColumns(['bu_name', 'bu_type', 'bu_status','control'])
            ->make(true);
    }
    public  function showAllEnabel(){
     $buAll=bu::where('bu_status',1)->orderBy('id','desc')->paginate(6);

     return view('website.bu.all',compact('buAll'));
    }

    public  function ForRent(){
        $buAll=bu::where('bu_status',1)->where('bu_rent',1)->orderBy('id','desc')->paginate(6);
        return view('website.bu.all',compact('buAll'));
    }
    public  function ForBuy(){
        $buAll=bu::where('bu_status',1)->where('bu_rent',0)->orderBy('id','desc')->paginate(6);
        return view('website.bu.all',compact('buAll'));
    }
    public  function showByType($type){
        if($type<count(bu_type())&&$type>=0){
            $buAll=bu::where('bu_status',1)->where('bu_type',$type)->orderBy('id','desc')->paginate(6);
            return view('website.bu.all',compact('buAll'));
        }
        else{
            return Redirect('/ShowAllBuilding');
        }

    }
    public  function  search(Request $request){
        /*  $requestAll=array_except($request->toArray(),['submit','_token']);
          $out='';
          $i=0;
          foreach ($requestAll as $key=>$req){
              if($req != ''){
                  $where= $i==0 ? "where" : "and";
                  $out .= ' '.$where.' '.$key.' = '.$req;
                  $i=2;
              }
          }
          $query= "select * from bu ".$out;
          $search='search';
          $buAll=DB::select( $query);
          return view('website.bu.all',compact('buAll','search')); */


        $requestAll=array_except($request->toArray(),['submit','_token','_token','page']);

        $query=DB::table('bu')->select('*');
        $array=[];
        $count=count($requestAll);
        $i=0;
        foreach ($requestAll as $key=>$req){
            $i++;
            if($req != ''  ){
                if($key == 'bu_price_from' && $request->bu_price_to=='')
                {

                    $query->where('bu_price','>=',$req );

                }elseif($key == 'bu_price_to'&&$request->bu_price_from==''){
                    $query->where('bu_price', '<=' , floatval($req));

                }else{
                    if($key !='bu_price_to' && $key!='bu_price_from'){
                        $query->where($key,floatval($req));
                    }

                }

                $array[$key]=$req;
            }elseif ($count==$i&&$request->bu_price_to != ''&&$request->bu_price_from != ''){
                $query->whereBetween('bu_price',[floatval($request->bu_price_from) ,floatval($request->bu_price_to)]);
                $array[$key]=$req;

            }
        }
        $buAll=$query->orderBy('id','desc')->paginate(3);
        return view('website.bu.all',compact('buAll','array'));
    }

    public  function Showsingle($id){
    $buInfo=bu::findOrFail($id);
    if($buInfo->bu_status==0){
       $messageTitle="هذا العقار ينتظر موافقة الادارة";
        $messageBody="العقار".$buInfo->bu_name."موجود لدينا ولكنه فى انتظار موافقة الادارة عليه
                    يتم نشر العقار فى مدة أقصاه 24 ساعة";
        return view('website.bu.noper',compact('buInfo','messageTitle','messageBody'));
    }
    $same_rent=bu::where('bu_rent',$buInfo->bu_rent)->orderBy(DB::raw('RAND()'))->take(3)->get();
    $same_type=bu::where('bu_type',$buInfo->bu_type)->orderBy(DB::raw('RAND()'))->take(3)->get();
    return view('website.bu.singlebu',compact('buInfo','same_rent','same_type'));
    }

    public  function getAjaxInfo(Request $request){
      return bu::find($request->id)->toJson();
    }
    public  function  userAddView(){
        return view('website.userbu.useradd');
    }



    public  function userStore(BuRequest $buRequest){
        if($buRequest->file('image')){

            $fileName=uploadImage($buRequest->file('image'),'/public/website/buImages/','500','362','');

        }else{
            $fileName='';
        }

        $user=Auth::user() ? Auth::user()->id : 0;
        $data=[
            'bu_name' => $buRequest->bu_name,
            'bu_price' => $buRequest->bu_price,
            'bu_room' => $buRequest->bu_room,
            'bu_rent' => $buRequest->bu_rent,
            'bu_square' => $buRequest->bu_square,
            'bu_type' => $buRequest->bu_type,
            'bu_small_dis' => strip_tags(str_limit($buRequest->bu_large_dis),160),
            'bu_meta' => $buRequest->bu_meta,
            'bu_langtuide' => $buRequest->bu_langtuide,
            'bu_laltitude' => $buRequest->bu_laltitude,
            'bu_large_dis' => $buRequest->bu_large_dis,
             'user_id' =>  $user,
            'bu_place' => $buRequest->bu_place,
            'image' => $fileName,
            'month' => date('m'),
            'year' => date('Y')

        ];
        bu::create($data);
        return view('website.userbu.done');
    }

    public function showUserBuilding(){
        $user=Auth::user();
        $bu=bu::where('user_id',$user->id)->where('bu_status',1)->paginate(6);
        return view('website.userbu.showuserbu',compact('bu','user'));
    }
    public  function buildingShowWaiting(){
        $user=Auth::user();
        $bu=bu::where('user_id',$user->id)->where('bu_status',0)->paginate(6);
        return view('website.userbu.showuserbu',compact('bu','user'));
    }

    public function userEditBuilding($id){
        $user=Auth::user();
        $buInfo=bu::find($id);
        if($user->id!=$buInfo->user_id)
        {
            $messageTitle="هذا العقار لم تقم باضافته";
            $messageBody="العقار".$buInfo->bu_name."لم تقم باضافته تم اضافته من خلال عضوية أخرى";
            return view('website.bu.noper',compact('buInfo','messageTitle','messageBody'));

        }elseif($buInfo->bu_status==1){
            $messageTitle="هذا العقار تم تفعيله";
            $messageBody="العقار".$buInfo->bu_name."تم تفعيله ولا يمكنك التعديل عليه حاليافى حال أردت التعديل عليه برجاء الذهاب الى اتصل بنا وارسال طلب تعديل";
            return view('website.bu.noper',compact('buInfo','messageTitle','messageBody'));
        }

        $bu=$buInfo;
       return view('website.userbu.edituserbu',compact('bu','user'));
    }

    public function userUpdateBuilding(BuRequest $request){
      $buUpdate=bu::find($request->bu_id);
        $buUpdate->fill(array_except($request->all(),['image']))->save();

        if($request->file('image')){
            $fileName=uploadImage($request->file('image'),'/public/website/buImages/','500','362',$buUpdate->image);

            $buUpdate->fill(['image'=>$fileName])->save();
        }
      return Redirect('/user/edit/building/'.$buUpdate->id)->withFlashMessage('تم التعديل على العقار بنجاح');
    }

    public function changeStatus($id,$status){
        $buUpdate=bu::find($id);
        $buUpdate->fill(['bu_status'=>$status])->save();
        return Redirect('/adminpanel/users/'.$buUpdate->user_id.'/edit')->withFlashMessage('تم التعديل على حالة العقار بنجاح');
    }

}
