<?php

namespace App\Http\Controllers;



use App\bu;
use App\Http\Requests\AddUserRequestAdmin;
use App\Http\Requests\UserUpdatePassword;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index(){

      return view('admin.user.index');
    }

    public function create(){
            $pagename='create';
      return view('admin.user.add',compact('pagename'));
    }

  public function store(AddUserRequestAdmin $request)
    {
      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password)
     ]);

            return redirect('/adminpanel/users')->withFlashMessage('تمت اضافة العضو بنجاح');
    }

    public function edit($id){
      $user=User::find($id);
      $buWaiting=bu::where('user_id',$id)->where('bu_status','0')->paginate(5);
      $buEnable=bu::where('user_id',$id)->where('bu_status','1')->paginate(5);
      return view('admin.user.edit',compact('user','buWaiting','buEnable'));
    }

    public function update($id,Request $request){
      $userUpdated=User::find($id);
      $userUpdated->fill($request->all())->save();

    return Redirect('/adminpanel/users')->withFlashMessage('تمت التعديل على العضو بنجاح');
    }

  public function  updatePassword(Request $request){
    $userUpdated=User::find($request->user_id);
    $password=bcrypt($request->password);
    $userUpdated->fill(['password'=>$password])->save();
    return Redirect('/adminpanel/users')->withFlashMessage('تم تغيير كلمة المرور بنجاح');


  }

  public function destory($id){
    if($id != 1){
   $user=User::find($id)->delete();
   bu::where('user_id',$id)->delete();
   return Redirect('/adminpanel/users')->withFlashMessage('تم الحذف بنجاح');
}
return Redirect('/adminpanel/users')->withFlashMessage('لا يمكن حذف العضوية رقم 1');
  }
  public function anyData(User $user)
    {

      $users = $user->all();

        return Datatables::of($users)

            ->editColumn('name', function ($model) {
                return '<a href="'.url('/adminpanel/users/' . $model->id . '/edit').'">'.$model->name.'</a>';
            })
            ->editColumn('admin', function ($model) {
                return $model->admin == 0 ? '<span class="badge badge-info">' . 'عضو' . '</span>' : '<span class="badge badge-warning">' . 'مدير الموقع' . '</span>';
            })


            ->editColumn('mybu', function ($model) {
                return '<a href="'.url('/adminpanel/bu/' . $model->id).'"> <span class="btn btn-info btn-circle"><i class="fa fa-link"></i> </span>  </a>';
            })

            ->editColumn('control', function ($model) {
                $all = '<a href="' . url('/adminpanel/users/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                if($model->id != 1){
                    $all .= '<a href="' . url('/adminpanel/users/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>';
                }
                return $all;
            })
             ->rawColumns(['name', 'admin', 'mybu','control'])
            ->make(true);

    }

    public function userEditInfo(){
        $user=Auth::user();
        return view('website.profile.edit',compact('user'));
    }

    public  function  userUpdateProfile(UserUpdateRequest $userUpdateRequest){
     $user=Auth::user();
        if($user->email!=$userUpdateRequest->email){
            $checkemail=User::where('email',$userUpdateRequest->email)->count();
            if($checkemail==0){
                $user->fill($userUpdateRequest->all())->save();

            }
            else{
                return Redirect('/user/editSetting')->withFlashMessage('عذرا الاميل موجود مسبقا لدينا برجاء استخدام اميل اخر');

            }


        }else{
            $user->fill(['name'=>$userUpdateRequest->name])->save();
        }

     return Redirect('/user/editSetting')->withFlashMessage('تم التعديل على المعلومات بنجاح');

    }

    public  function changePassword(UserUpdatePassword $userUpdatePassword ){
        $user=Auth::user();
        if(Hash::check($userUpdatePassword->password,$user->password)){
           // return Redirect('/user/editSetting')->withFlashMessage('كلمة المرور القديمة صحيحة');
            $hash=Hash::make($userUpdatePassword->newpassword);
            $user->fill(['password'=> $hash])->save();
            return Redirect('/user/editSetting')->withFlashMessage('تم تغيير كلمة المرور بنجاح');
        }else{
            return Redirect('/user/editSetting')->withFlashMessage('كلمة المرور القديمة غير مطابقة للمسجل لدينا');
        }
    }


}
