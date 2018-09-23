@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">كل الخدمات</h1>
                <div class="btn-group pull-left">
                    <button class="btn btn-default">الظهور على حسب</button>
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url("/admin/services/0")}}">
                                <i class="glyphicon glyphicon-time"></i>خدمات لم يتم الموافقة عليها
                            </a></li>
                        <li><a href="{{url("/admin/services/1")}}">
                                <i class="glyphicon glyphicon-ok"></i>
                                خدمات تم الموافقة عليها </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/services/id-desc")}}">
                                <i class="glyphicon glyphicon-circle-arrow-up"></i>  المضاف أخيرا
                            </a></li>
                        <li><a href="{{url("/admin/services/id-asc")}}"> <i class="glyphicon glyphicon-circle-arrow-down"></i>
                                المضاف أولا
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/services/created_at-asc")}}"> <i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأقدم
                            </a></li>
                        <li><a href="{{url("/admin/services/created_at-desc")}}"><i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأحدث</a></li>


                    </ul>
                </div>

                <div class="btn-group pull-left" style="margin-left: 10px">
                    <button class="btn btn-primary">القسم</button>
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        @foreach($cat as $c)
                        <li>
                            <a href="{{url("/admin/services/cat-".$c->id)}}">
                                <i class="glyphicon glyphicon-tag"></i>
                               {{$c->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group pull-left" style="margin-left: 10px">
                    <form action="{{url("/admin/services")}}" class="form-inline" method="post">
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
                    <div class="text-muted bootstrap-admin-box-title">الخدمات المضافة</div>
                </div>
                <div class="bootstrap-admin-panel-content text-muted">
                    <table class="table bootstrap-admin-table-with-actions">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الخدمة</th>
                            <th>اسم  صاحب الخدمة</th>
                            <th>عدد مرات البيع</th>
                            <th>أضيف فى </th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>
                                <a href="{{url("/admin/services/".$service->id."/edit")}}" >
                                {{$service->name}}
                                </a>
                            </td>
                            <td>
                                <a href="{{url("/admin/users/".$service->user->id."/edit")}}" >
                                    {{$service->user->name}}
                                </a>
                            </td>
                            <td>
                                <a href="{{url("/admin/orders/getAllOrders/".$service->id)}}">
                                    {{$service->order_count}}
                                </a>
                            </td>
                            <td>{{$service->created_at}}</td>
                            <td class="actions">

                                <a href="{{url("/admin/services/".$service->id."/edit")}}" class="btn btn-sm btn-info">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        تعديل
                                    </a>


                                <a href="{{url("/admin/services/delete/".$service->id)}}" class="btn btn-sm btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        حذف
                                    </a>

                            </td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$services->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
