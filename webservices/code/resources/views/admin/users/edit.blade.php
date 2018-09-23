@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">{{$user->name}}</h1>
           <p class="pull-left">
                    <small>
                        <i class="glyphicon glyphicon-user"></i>

                        <i class="glyphicon glyphicon-star"></i>

                        <i class="glyphicon glyphicon-bullhorn"></i>

                        <i class="glyphicon glyphicon-eye-open"></i>


                    </small>
                    <a href="{{url("/admin/users")}}" class="btn btn-sm btn-info">
                        كل الأعضاء
                    </a>
                    <a href="{{url("/admin/users/delete/".$user->id)}}" class="btn btn-sm btn-danger">
                        <i class="glyphicon glyphicon-trash"></i>
                        حذف
                    </a>

                </p>

                <div class="clearfix"></div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">

             <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">خدمات العضو</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                @foreach($services as $service )
                                <li>
                                    <a href="{{url("/admin/services/".$service->id."/edit")}}">{{$service->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             <div class="text-muted bootstrap-admin-box-title">
                                 طلبات خاصة بخدمات العضو
                                 ({{count($orders)}})
                             </div>
                         </div>
                         <div class="bootstrap-admin-panel-content">
                             <ul style="list-style-type:none">
                                 @foreach($orders as $order)
                                     <li >
                                         <a class="pull-right" href="{{url("/admin/orders/".$order->id."/edit")}}">
                                             #{{$order->id}}
                                         </a>

                                         <span class="pull-left small">
                                         <i class="glyphicon glyphicon-calendar"></i>
                                             {{$order->created_at}}
                                         </span>
                                         <span class="pull-left">
                            @if($order->status == 0)
                                                 <span class="label label-info"> طلب جديد</span>
                                             @elseif($order->status == 1)
                                                 <span class="label label-info"> طلب قديم</span>
                                             @elseif($order->status == 2)
                                                 <span class="label label-warning"> طلب قيد التنفيذ</span>
                                             @elseif($order->status == 3)
                                                 <span class="label label-danger">طلب ملغى</span>
                                             @else($order->status == 4)
                                                 <span class="label label-success"> طلب منتهى</span>
                                             @endif
                                          </span>
                                         <div class="clearfix"></div>
                                     </li>

                                 @endforeach

                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-12">
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             <div class="text-muted bootstrap-admin-box-title">
                                 طلبات خاصة  بالعضو
                                 ({{count($ordersUser)}})
                             </div>
                         </div>
                         <div class="bootstrap-admin-panel-content">
                             <ul style="list-style-type:none">
                                 @foreach($ordersUser as $order)
                                     <li >
                                         <a class="pull-right" href="{{url("/admin/orders/".$order->id."/edit")}}">
                                             #{{$order->id}}
                                         </a>

                                         <span class="pull-left small">
                                         <i class="glyphicon glyphicon-calendar"></i>
                                             {{$order->created_at}}
                                         </span>
                                         <span class="pull-left">
                                         @if($order->status == 0)
                                                 <span class="label label-info"> طلب جديد</span>
                                             @elseif($order->status == 1)
                                                 <span class="label label-info"> طلب قديم</span>
                                             @elseif($order->status == 2)
                                                 <span class="label label-warning"> طلب قيد التنفيذ</span>
                                             @elseif($order->status == 3)
                                                 <span class="label label-danger">طلب ملغى</span>
                                             @else($order->status == 4)
                                                 <span class="label label-success"> طلب منتهى</span>
                                             @endif
                                          </span>
                                         <div class="clearfix"></div>
                                     </li>

                                 @endforeach

                             </ul>
                         </div>
                     </div>
                 </div>
            </div>


        </div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">معلومات عن رصيد العضو</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">

                            <div class="row" >
                                <div class="col-lg-4">
                                    <div class="well text-center">
                                        <h4>الدفع:</h4>
                                        {{$thispay=\App\Buy::where('user_id',$user->id)->where('finish','!=',2)->sum('buy_price')}} $
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="well text-center">
                                        <h4>الشحن:</h4>
                                        {{ $allCharage=\App\Pay::where('user_id',$user->id)->sum('price')}} $
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="well text-center">
                                        <h4>الرصيد:</h4>
                                        {{  $allCharage -  $thispay }} $
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="well text-center">
                                        <h4>أرباح للسحب:</h4>
                                        {{$p}} $
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="well text-center">
                                        <a href="{{url('/admin/profit/user/'.$user->id.'/0')}}">
                                            <h4>أرباح منتظرة:</h4>
                                            {{$getWaitProfit}} $
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="well text-center">
                                        <a href="{{url('/admin/profit/user/'.$user->id.'/1')}}">
                                        <h4>أرباح أرسلت:</h4>
                                        {{$getDoneProfit}} $
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="well text-center">
                                     <h4>اجمالى أرباح:</h4>
                                     {{intval($p)+intval($getWaitProfit)+intval($getDoneProfit)}}   $
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::model($user,['url' => ['admin/users',$user->id],'method' => 'PATCH','files' => true]) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">تعديل</div>
                        </div>
                        <div class="bootstrap-admin-panel-content text-muted" >
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-lg-2 pull-right" for="name">اسم العضو</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" value="{{$user->name}}"  class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="admin">الصلاحيات</label>
                                    <div class="col-lg-10">
                                        <select  name="admin"  class="form-control">
                                            @if($user->admin==0)
                                                <option value="0">عضو</option>
                                                <option value="1">مدير</option>
                                            @else
                                                <option value="1">مدير</option>
                                                <option value="0">عضو</option>
                                           @endif

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="email">الاميل</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="email" value="{{$user->email}}"  class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="image">رمزية العضو</label>
                                    <div class="col-lg-10">
                                        @if($user->image != '')
                                            <img src="{{url("images/users")}}/{{$user->image}}" class="img-responsive" />
                                        @endif
                                        <input type="file" name="image" />
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-2" ></label>
                                    <div class="col-lg-10">
                                        <input type="submit" name="submit" value="حفظ" class="btn btn-info"/>
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
