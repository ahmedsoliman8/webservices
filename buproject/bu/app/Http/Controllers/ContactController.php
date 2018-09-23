<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class ContactController extends Controller
{
public  function index(){
return view('admin.contact.index');
}
public  function store(ContactRequest $request){
   ContactUs::create($request->all());
   return Redirect('/contact')->withFlashMessage('تم ارسال رسالتك الينا بنجاح');
  }

    public function edit($id){
       $contact=ContactUs::find($id);
       $contact->fill(['view'=>1])->save();
        return view('admin.contact.edit',compact('contact'));
    }
    public function update($id,Request $request){
        $contactUpdated=ContactUs::find($id);
        $contactUpdated->fill($request->all())->save();

        return Redirect('/adminpanel/contact')->withFlashMessage('تمت التعديل على الرسالة بنجاح');
    }

    public function destory($id){

            $contact=ContactUs::find($id)->delete();

            return Redirect('/adminpanel/contact')->withFlashMessage('تم الحذف بنجاح');
        }

    public function anyData(ContactUs $contactUs)
    {

        $contact = $contactUs->all();

        return Datatables::of($contact)

            ->editColumn('contact_name', function ($model) {
                return '<a href="'.url('/adminpanel/contact/' . $model->id . '/edit').'">'.$model->contact_name.'</a>';
            })
            ->editColumn('contact_type', function ($model) {
                return '<span class="badge badge-warning">' . contact()[$model->contact_type] . '</span>';
            })
            ->editColumn('view', function ($model) {
                return $model->view == 0 ? '<span class="badge badge-info">' . 'رسالة جديدة' . '</span>' : '<span class="badge badge-warning">' . 'رسالة قديمة' . '</span>';
            })

            ->editColumn('control', function ($model) {
                $all = '<a href="' . url('/adminpanel/contact/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';

                    $all .= '<a href="' . url('/adminpanel/contact/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>';

                return $all;
            })
            ->rawColumns(['contact_name', 'contact_type', 'view','control'])
            ->make(true);

    }


}
