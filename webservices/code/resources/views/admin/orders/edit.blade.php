@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">
                    اسم الخدمة المطلوبة
                    {{$order->services->name}}
                    رقم الطلب
                    #
                    {{$order->id}}
                </h1>
                <p class="pull-left">
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
                    <a href="{{url("/admin/orders")}}" class="btn btn-sm btn-info">
                        كل الطلبات
                    </a>
                    <a href="{{url("/admin/orders/delete/".$order->id)}}" class="btn btn-sm btn-danger">
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
                            <div class="text-muted bootstrap-admin-box-title">معلومات عن العضو صاحب الخدمة</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">

                            <ul>
                                <li>
                                    <a href="{{url("/admin/users/".$order->getUserAddService->id."/edit")}}">{{$order->getUserAddService->name}}</a>
                                </li>
                                <li>
                                    اجمالى عمليات الشحن:
                                    {{ $allCharage=\App\Pay::where('user_id',$order->getUserAddService->id)->sum('price')}} $
                                </li>
                                <li>
                                    +
                                    اجمالى الأرباح:
                                    {{$thisprofit=\App\Buy::where('rev_id',$order->getUserAddService->id)->where('finish',1)->sum('buy_price')}} $
                                    <hr>
                                </li>
                                <li>
                                    -
                                    اجمالى عمليات المدفوعات والرصيد المعلق:
                                    {{$thispay=\App\Buy::where('user_id',$order->getUserAddService->id)->where('finish','!=',2)->sum('buy_price')}} $
                                </li>

                                <li>
                                    <hr>
                                    الرصيد الحالى:
                                    {{  ($thisprofit+$allCharage) -  $thispay }} $
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">معلومات عن العضو طالب الخدمة</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <li>

                                    <a href="{{url("/admin/users/".$order->GetMyOrders->id."/edit")}}">{{$order->GetMyOrders->name}}</a>
                                </li>
                                <li>
                                    اجمالى عمليات الشحن:
                                    {{$charage=\App\Pay::where('user_id',$order->GetMyOrders->id)->sum('price')}} $
                                </li>
                                <li>
                                    +
                                    اجمالى الأرباح:
                                    {{$profit=\App\Buy::where('rev_id',$order->GetMyOrders->id)->where('finish',1)->sum('buy_price')}} $
                                    <hr>
                                </li>
                                <li>
                                    -
                                    اجمالى عمليات المدفوعات والرصيد المعلق:
                                    {{$pay=\App\Buy::where('user_id',$order->GetMyOrders->id)->where('finish','!=',2)->sum('buy_price')}} $
                                </li>

                                <li>
                                    <hr>
                                    الرصيد الحالى:
                                    {{  ($profit+$charage) -  $pay }} $
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title"> {{$order->services->name}}</div>
                        </div>
                        <div class="bootstrap-admin-panel-content text-muted" >
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-2 pull-right" for="name">اسم الخدمة</label>
                                        <div class="col-lg-10">
                                            {{$order->services->name}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2  pull-right" for="price">سعر الخدمة</label>
                                        <div class="col-lg-10">
                                            {{$order->services->price}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2  pull-right" for="price">حالة الخدمة</label>
                                        <div class="col-lg-10">

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

                                        </div>
                                    </div>

                                    <form action="{{url("/admin/orders/changeOrderStatus")}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="order_id" value="{{$order->id}}"/>
                                        <input type="hidden" name="rev_id" value="{{ $order->getUserAddService->id}}"/>
                                        <input type="hidden" name="user_id" value="{{ $order->GetMyOrders->id}}"/>

                                        <div class="form-group row">
                                            <label class="col-lg-2  pull-right" for="price">تغيير حالة الخدمة</label>
                                            <div class="col-lg-10">
                                                <select name="status" class="form-control">
                                                    <option value="0">طلب جديد</option>
                                                    <option value="1">طلب قديم</option>
                                                    <option value="2">قيد التنفيذ</option>
                                                    <option value="3">طلب مرفوض</option>
                                                    <option value="4">طلب منتهى</option>
                                                </select>
                                                <br/>
                                                <div class="alert alert-warning">
                                                    <b>محلوظة هامة: </b>
                                                    <span>
                                                        تغيير حالة الطلب سوف تؤدى الى تغيير فى الارباح والدفوعات الخاصة بالعضويين المعنيين بالطلب بالرجاء الانتباه فى حالة تغيير حالة الطلب
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-lg-2" ></label>
                                            <div class="col-lg-10">
                                                <input type="submit" name="submit" value="تغيير حالة الطلب" class="btn btn-info"/>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-lg-12">
                                    <h1>
                                        التعليقات
                                        {{count($order->comment)}}
                                    </h1>
                                    @if(count($order->comment) > 0)
                                        <div >
                                            @foreach( $order->comment as $index => $comment )
                                                <section  class="comment-list text-right">
                                                    <!-- First Comment -->
                                                    <article class="row">

                                                        <div class="col-xs-12 pull-left">
                                                            <div class="panel panel-default arrow ">
                                                                <div class="panel-body">
                                                                    <header class="text-right clearfix">
                                                                        <div class="comment-user pull-right">
                                                                            #{{$index+1}}
                                                                            <router-link :to="{name:'/User',params:{user_id:comment.user.id,username:comment.user.name}}">

                                                                                <i class="fa fa-user "></i>
                                                                                {{$comment->user_id}}
                                                                            </router-link>

                                                                        </div>
                                                                        <time class="comment-date pull-left" datetime="16-12-2014 01:05">
                                                                            <i class="fa fa-clock-o"></i>
                                                                            {{$comment->created_at}}
                                                                        </time>
                                                                    </header>
                                                                    <div class="comment-post">
                                                                        <p>
                                                                            {{$comment->comment}}
                                                                        </p>
                                                                        <a href="{{url("/admin/comment/delete/".$comment->id)}}" class="btn btn-sm btn-danger">
                                                                            <i class="glyphicon glyphicon-trash"></i>
                                                                            حذف
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>

                                                </section>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
