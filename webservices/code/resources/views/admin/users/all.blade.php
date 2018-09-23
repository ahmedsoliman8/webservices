@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">كل الأعضاء</h1>
                <div class="btn-group pull-left">
                    <button class="btn btn-default">الظهور على حسب</button>
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url("/admin/users/1")}}">
                                <i class="glyphicon glyphicon-time"></i>المديرين
                            </a></li>
                        <li><a href="{{url("/admin/users/0")}}">
                                <i class="glyphicon glyphicon-ok"></i>
                                الأعضاء </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/users/id-desc")}}">
                                <i class="glyphicon glyphicon-circle-arrow-up"></i>  المضاف أخيرا
                            </a></li>
                        <li><a href="{{url("/admin/users/id-asc")}}"> <i class="glyphicon glyphicon-circle-arrow-down"></i>
                                المضاف أولا
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/users/created_at-asc")}}"> <i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأقدم
                            </a></li>
                        <li><a href="{{url("/admin/users/created_at-desc")}}"><i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأحدث</a></li>


                    </ul>
                </div>


                <div class="btn-group pull-left" style="margin-left: 10px">
                    <form action="{{url("/admin/users/search")}}" class="form-inline" method="post">
                        {{csrf_field()}}
                        <input type="text" name="search" class="form-control" placeholder="اسم العضو أو رقم العضوية" />
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
                    <div class="text-muted bootstrap-admin-box-title">الأعضاء</div>
                </div>
                <div class="bootstrap-admin-panel-content text-muted">
                    <table class="table bootstrap-admin-table-with-actions">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم العضو</th>
                            <th>الايميل</th>
                            <th>الصلاحيات</th>
                            <th>عدد الخدمات</th>
                            <th>طلبات العضو</th>
                            <th>طلبات أخرين للعضو</th>
                            <th>أضيف فى</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    <a href="{{url("/admin/users/".$user->id."/edit")}}" >
                                        {{$user->name}}
                                    </a>
                                </td>
                                <td>

                                        {{$user->email}}

                                </td>
                                <td>
                                    @if($user->admin ==0)
                                        <span>عضو</span>
                                     @else
                                       <span>مدير</span>
                                     @endif
                                </td>
                                <td>
                                    <a href="{{url("/admin/services/getAllUserServices/".$user->id)}}" >
                                    {{$user->services_count}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{"/admin/orders/getAllUserOrdersMade/".$user->id}}">
                                        {{$user->orders_i_made_count}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{"/admin/orders/getAllMyServicesOrders/".$user->id}}">
                                    {{$user->get_my_service_order_count}}
                                    </a>
                                </td>
                                <td>{{$user->created_at}}</td>
                                <td class="actions">

                                    <a href="{{url("/admin/users/".$user->id."/edit")}}" class="btn btn-sm btn-info">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        تعديل
                                    </a>


                                    <a href="{{url("/admin/services/delete/".$user->id)}}" class="btn btn-sm btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        حذف
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
