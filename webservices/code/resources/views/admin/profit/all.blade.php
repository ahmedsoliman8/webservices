@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">طلبات سحب الأرباح</h1>
                <div class="btn-group pull-left">
                    <button class="btn btn-default">الظهور على حسب</button>
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url("/admin/profit/0")}}">
                                <i class="glyphicon glyphicon-time"></i>طلبات لم تنفذ
                            </a></li>
                        <li><a href="{{url("/admin/profit/1")}}">
                                <i class="glyphicon glyphicon-ok"></i>
                                طلبات منفذة </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/profit/id-desc")}}">
                                <i class="glyphicon glyphicon-circle-arrow-up"></i>  المضاف أخيرا
                            </a></li>
                        <li><a href="{{url("/admin/profit/id-asc")}}"> <i class="glyphicon glyphicon-circle-arrow-down"></i>
                                المضاف أولا
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="{{url("/admin/profit/created_at-asc")}}"> <i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأقدم
                            </a></li>
                        <li><a href="{{url("/admin/profit/created_at-desc")}}"><i class="glyphicon glyphicon-calendar"></i> على حسب التاريخ الأحدث</a></li>


                    </ul>
                </div>

                <div class="btn-group pull-left" style="margin-left: 10px">
                    <form action="{{url("/admin/profit/search")}}" class="form-inline" method="post">
                       {{csrf_field()}}
                        <input type="text" name="search" class="form-control" />
                        <button type="submit" class="btn btn-info">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>

                </div>

                <div class="btn-group pull-left" style="margin-left: 10px">
                    <form action="{{url("/admin/ProfitByDate")}}" class="form-inline" method="post">
                        {{csrf_field()}}
                        <input type="date" name="search" class="form-control" />
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
                    <div class="text-muted bootstrap-admin-box-title">طلبات سحب الأرباح</div>
                </div>
                <div class="bootstrap-admin-panel-content text-muted">
                    <table class="table bootstrap-admin-table-with-actions">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم  صاحب الطلب</th>
                            <th>حالة الطلب</th>
                            <th>الربح</th>
                            <th>أضيف فى </th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profit as $p)
                        <tr>
                            <td>{{$p->id}}</td>
                            <td>
                                <a href="{{url("/admin/users/".$p->user->id."/edit")}}" >
                                {{$p->user->name}}
                                </a>
                            </td>

                            <td>
                                @if($p->status == 0)
                                    <span class="label label-warning">فى انتظار الارسال</span>
                               @else
                                    <span class="label label-success">تم الارسال</span>
                                @endif
                            </td>
                            <td>{{$p->profit_price}}</td>
                            <td>{{$p->created_at}}</td>
                            <td>
                                {{\Moment\Moment::setLocale('ar_TN')}}
                               {{(new \Moment\Moment('@'.$p->time, 'CET'))->addDays(env("profitDay"))->format('Y-m-d')}}
                            </td>
                            <td class="actions">
                                @if($p->status == 0)
                                 <a href="{{url('/admin/AdminSendMoney/'.$p->id)}}" class="btn btn-sm btn-primary">
                                     <i class="glyphicon glyphicon-pencil"></i>
                                     أرسل الربح
                                 </a>
                                @endif
                            </td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$profit->render()}}
                </div>
            </div>
        </div>
    </div>
@endsection
