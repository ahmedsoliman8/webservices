@extends('admin.layouts.layout')

@section('title')
تعديل العضو
{{$user->name}}
@endsection

@section('header')
<style>
    .nav-tabs>li{
        float: right;

    }
</style>
@endsection
@section('content')
<section class="content-header">
       <h1>
         تعديل العضو
         {{$user->name}}
       </h1>
       <ol class="breadcrumb">
         <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i>الرئيسية</a></li>
         <li><a href="{{url('/adminpanel/users')}}">التحكم فى الأعضاء</a></li>
         <li class="active"><a href="{{url('/adminpanel/users/'.$user->id.'edit')}}">تعديل العضو
         {{$user->name}}</a></li>

       </ol>
     </section>

     <!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li ><a href="#activity" data-toggle="tab" aria-expanded="true">عقارات غير مفعلة</a></li>
                <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="false">عقارات مفعلة</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="activity">
                    <table class="table table-bordered">
                        <tr>
                            <td>اسم العقار</td>
                            <td>أضيف فى</td>
                            <td>نوع العقار</td>
                            <td>سعر العقار</td>
                            <td>مكان العقار</td>
                            <td>مساحة العقار</td>
                            <td>نوع العملية</td>
                            <td>تغيير حالة العقار</td>
                        </tr>
                        @foreach($buWaiting as $waiting)
                            <tr>
                                <td><a href="{{url('/adminpanel/bu/'.$waiting->id.'/edit')}}">{{$waiting->bu_name}}</a></td>
                                <td>{{$waiting->created_at}}</td>
                                <td>{{bu_type()[$waiting->bu_type]}}</td>
                                <td>{{$waiting->bu_price}}</td>
                                <td>{{bu_place()[$waiting->bu_place]}}</td>
                                <td>{{$waiting->bu_square}}</td>
                                <td>{{bu_rent()[$waiting->bu_rent]}}</td>
                                <td><a href="{{url('/adminpanel/changeStatus/'.$waiting->id.'/1')}}">تفعيل العقار</a> </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{-- @if(!isset($search))@endif --}}
                        {{ $buWaiting->appends(Request::except('page'))->render()}}
                    </div>
                </div>
                <div class="tab-pane active" id="timeline">
                    <table class="table table-bordered">
                        <tr>
                            <td>اسم العقار</td>
                            <td>أضيف فى</td>
                            <td>نوع العقار</td>
                            <td>سعر العقار</td>
                            <td>مكان العقار</td>
                            <td>مساحة العقار</td>
                            <td>إلغاء التفعيل</td>
                        </tr>
                        @foreach($buEnable as $enable)
                            <tr>
                                <td><a href="{{url('/adminpanel/bu/'.$enable->id.'/edit')}}">{{$enable->bu_name}}</a></td>
                                <td>{{$enable->created_at}}</td>
                                <td>{{bu_type()[$enable->bu_type]}}</td>
                                <td>{{$enable->bu_price}}</td>
                                <td>{{bu_place()[$enable->bu_place]}}</td>
                                <td>{{$enable->bu_square}}</td>
                                <td>{{bu_rent()[$enable->bu_rent]}}</td>
                                <td><a href="{{url('/adminpanel/changeStatus/'.$enable->id.'/0')}}">إلغاء التفعيل</a> </td>

                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{-- @if(!isset($search))@endif --}}
                        {{ $buEnable->appends(Request::except('page'))->render()}}
                    </div>


                </div>


            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">تعديل العضو {{$user->name}}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            {!! Form::model($user, ['url' => ['adminpanel/users', $user->id],'method'=>'PATCH'])!!}
                            @include('admin.user.form')
                            {!! Form::close() !!}



                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">تغيير كلمة المرور الخاصة بالعضو {{$user->name}}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            {!! Form::open(['url' => ['adminpanel/user/changePassword'],'method'=>'Post'])!!}
                            <input type="hidden" value="{{$user->id}}" name="user_id"/>
                            <div class="text2{{ $errors->has('password') ? ' has-error' : '' }}">


                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" placeholder="كلمة السر" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                                    @endif
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning">
                                        تغير الباسورد
                                    </button>


                                    @if($user->id!=1)
                                        <a href="{{url('/adminpanel/users/' . $user->id . '/delete') }}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i>حذف العضو</a>
                                    @endif
                                </div>

                            </div>

                            {!! Form::close() !!}



                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
</section>

@endsection


@section('footer')

@endsection
