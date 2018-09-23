@extends('layouts.app')
@section('title')
    اضافة عقار جديد
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
                    <li><a href="{{url('/user/create/building')}}">اضافة عقار جديد</a></li>
                </ol>
                <div class="profile-content">
                    {!! Form::open(['url' => ['/user/create/building'],'method'=>'Post','files' => true])!!}
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
