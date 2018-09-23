@extends('layouts.app')
@section('title')
    عقارات اليوزر
    {{$user->name}}
@endsection
@section('header')
    {!! Html::style('cus/buall.css') !!}

@endsection
@section('content')
    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">الرئيسية</a></li>
                    <li><a href="{{url('/ShowAllBuilding')}}">كل العقارات</a></li>
                    <li class="active"><a href="#">عقارات اليوزر
                            {{$user->name}}</a></li>
                </ol>

                <div class="profile-content">
                    @include('website.bu.shareFile',['bu' => $bu])
                    <div class="text-center">
                        {{-- @if(!isset($search))@endif --}}
                        {{ $bu->appends(Request::except('page'))->render()}}


                    </div>

                </div>
            </div>
            @include('website.bu.pages');
        </div>
    </div>

    <br>
    <br>

@endsection
