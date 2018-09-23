@extends('layouts.app')
@section('title')
    تعديل العقار
    {{$bu->bu_name}}
@endsection
@section('header')
    {!! Html::style('cus/buall.css') !!}
    {{Html::style('cus/css/select2.css')}}
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
                    <li><a href="{{url('/user/buildingShowWaiting')}}">عقارات فى انتظار التفعيل</a></li>
                    <li><a href="{{url('/user/edit/building/'.$bu->id)}}">تعديل العقار
                            {{$bu->bu_name}}
                        </a></li>
                </ol>
                <div class="profile-content">
                    {!! Form::model($bu,['url' => ['/user/update/building'],'method'=>'patch','files' => true])!!}
                    <input type="hidden" name="bu_id" value="{{$bu->id}}"/>
                    @include('admin.bu.form',['user' => 1])
                    {!! Form::close() !!}

                </div>
            </div>
            @include('website.bu.pages');
        </div>
    </div>
    <br>
    <br>

@endsection
