@extends('layouts.app')
@section('title')
    تعديل المعلومات الشخصية للعضو
    {{$user->name}}
@endsection
@section('header')
    {!! Html::style('cus/buall.css') !!}
    <style>
        .text2 input[type="text"]{
            height: 34px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">الرئيسية</a></li>
                    <li class="active"><a  href="#">  تعديل المعلومات الشخصية للعضو
                            {{$user->name}}</a></li>
                </ol>
                <div class="profile-content">
                    <h2>تعديل الاميل واسم المستخدم</h2>
                    <hr>
                    {!! Form::model($user, ['route' => ['user.editSetting', $user->id],'method'=>'PATCH'])!!}
                    @include('admin.user.form',['showformuser'=>1])
                    {!! Form::close() !!}
                    <hr>
                    {{-- change passwword --}}
                    <h2>تعديل كلمة المرور</h2>
                    <hr>

                    {!! Form::open(['url' => ['/user/changePassword'],'method'=>'Post'])!!}
                    <div class="text2{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" placeholder="ادخل كلمة المرور القديمة " name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    <div class="col-md-12">
                        <input id="newpassword" type="password" class="form-control" placeholder="ادخل كلمة المرور الجديدة" name="newpassword" required>

                        @if ($errors->has('newpassword'))
                            <span class="help-block">
                          <strong>{{ $errors->first('newpassword') }}</strong>
                      </span>
                        @endif
                    </div>
                        <div class="clearfix"></div>
                        <br/>

                        <div class="col-md-12">
                        <button type="submit" class="btn btn-warning">
                            تغير كلمة المرور
                        </button>
                    </div>
                        <div class="clearfix"></div>
                        <br/>

                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
            @include('website.bu.pages');
        </div>
    </div>

    <br>
    <br>
@endsection
