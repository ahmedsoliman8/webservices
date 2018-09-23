@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">كل الطلبات</h1>
                <div class="btn-group pull-left">
                    <button class="btn btn-default">الظهور على حسب</button>
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url("/admin/orders/0")}}">
                                <i class="glyphicon glyphicon-eye-open"></i> طلبات جديدة
                            </a>
                        </li>
                        <li>
                            <a href="{{url("/admin/orders/1")}}">
                                <i class="glyphicon glyphicon-eye-close"></i>    طلبات قديمة
                            </a>
                        </li>
                        <li>
                            <a href="{{url("/admin/orders/3")}}">
                                <i class="glyphicon glyphicon-remove"></i> طلبات مرفوضة
                            </a>
                        </li>
                        <li>
                            <a href="{{url("/admin/orders/4")}}">
                                <i class="glyphicon glyphicon-tasks"></i> طلبات منتهية
                            </a>
                        </li>
                        <li>
                            <a href="{{url("/admin/orders/2")}}">
                                <i class="glyphicon glyphicon-time"></i>      طلبات جارى التنفيذ
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/orders/id-desc")}}">
                                <i class="glyphicon glyphicon-circle-arrow-up"></i>  المضاف أخيرا
                            </a></li>
                        <li><a href="{{url("/admin/orders/id-asc")}}"> <i class="glyphicon glyphicon-circle-arrow-down"></i>
                                المضاف أولا
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/orders/created_at-asc")}}"> <i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأقدم
                            </a></li>
                        <li><a href="{{url("/admin/orders/created_at-desc")}}"><i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأحدث</a></li>


                    </ul>
                </div>

                <div class="btn-group pull-left" style="margin-left: 10px">
                    <form action="{{url("/admin/orders/search")}}" class="form-inline" method="post">
                        {{csrf_field()}}
                        <input type="text" name="search" class="form-control" />
                        <button type="submit" class="btn btn-info">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">طلبات الخدمات</div>
                </div>
                <div class="bootstrap-admin-panel-content text-muted" >
                    <table class="table bootstrap-admin-table-with-actions">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الخدمة</th>
                            <th>اسم  صاحب الخدمة</th>
                            <th>اسم طالب الخدمة</th>
                            <th>حالة الطلب</th>
                            <th>أضيف فى </th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr>
                                <td>
                                    {{$order->id}}
                                </td>
                                <td>
                                    <a href="{{url("/admin/services/".$order->services->id."/edit")}}" >
                                    {{$order->services->name}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url("/admin/users/".$order->getUserAddService->id."/edit")}}" >
                                    {{$order->getUserAddService->name}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url("/admin/users/".$order->GetMyOrders->id."/edit")}}" >
                                    {{$order->GetMyOrders->name}}
                                    </a>
                                </td>
                                <td>
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
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td class="actions">

                                    <a href="{{url("/admin/orders/".$order->id."/edit")}}" class="btn btn-sm btn-info">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        تعديل
                                    </a>

                                    <a href="{{url("/admin/orders/delete/".$order->id)}}" class="btn btn-sm btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        حذف
                                    </a>
                                   {{--
                                    @if($service->status==0)
                                        <a href="{{url("/admin/acceptservice/".$service->id."/1")}}" class="btn btn-sm btn-success">
                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                            الموافقة على الخدمة
                                        </a>
                                    @else
                                        <a href="{{url("/admin/acceptservice/".$service->id."/0")}}" class="btn btn-sm btn-danger">
                                            <i class="glyphicon glyphicon-remove"></i>
                                            الغاء الموافقة
                                        </a>
                                    @endif
                                    --}}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$orders->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
