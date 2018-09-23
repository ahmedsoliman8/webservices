@extends("admin.layout.layout")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 class="pull-right">{{$service->name}}</h1>
                <p class="pull-left">
                    <small>
                        <i class="glyphicon glyphicon-user"></i>
                        {{$service->vote_count}}
                        <i class="glyphicon glyphicon-star"></i>
                        {{$sum}}
                        <i class="glyphicon glyphicon-bullhorn"></i>
                        {{($sum * 100) / ($service->vote_count * 5)}} %
                        <i class="glyphicon glyphicon-eye-open"></i>
                        {{$service->view_count}}

                    </small>
                    <a href="{{url("/admin/services")}}" class="btn btn-sm btn-info">
                        كل الخدمات
                    </a>
                    <a href="{{url("/admin/services/delete/".$service->id)}}" class="btn btn-sm btn-danger">
                        <i class="glyphicon glyphicon-trash"></i>
                        حذف
                    </a>

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
                                    <a href="{{url("/admin/users/".$service->user->id."/edit")}}">{{$service->user->name}}</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">
                                طلبات الخدمة
                                ({{count($service->order)}})
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                @foreach($service->order as $order)
                                    <li>
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
            {!! Form::model($service,['url' => ['admin/services',$service->id],'method' => 'PATCH','files' => true]) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">{{$service->name}}</div>
                        </div>
                        <div class="bootstrap-admin-panel-content text-muted" >
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-lg-2 pull-right" for="name">اسم الخدمة</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" value="{{$service->name}}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="des">وصف الخدمة</label>
                                    <div class="col-lg-10">
                            <textarea rows="10" name="des" class="form-control">
                        {{$service->des}}
                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="cat_id">القسم الخاص بالخدمة</label>
                                    <div class="col-lg-10">
                                        <select  name="cat_id"  class="form-control">
                                            <option value="{{$service->cat->id}}">{{$service->cat->name}}</option>
                                            @foreach($cat as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="image">صورة الخدمة</label>
                                    <div class="col-lg-10">
                                        @if($service->image != '')
                                            <img src="{{url("images/services")}}/{{$service->image}}" class="img-responsive" />
                                        @endif
                                        <input type="file" name="image" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2  pull-right" for="price">سعر الخدمة</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="price" value="{{$service->price}}" class="form-control"/>
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
