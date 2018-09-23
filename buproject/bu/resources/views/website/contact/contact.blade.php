@extends('layouts.app')
@section('title')
    اتصل بنا
@endsection
@section('header')
    {!! Html::style('cus/buall.css') !!}
    <style>
        .input-group-addon:first-child{
            border-left: 0px;
            border-right: 1px solid #ccc;
        }
    </style>
  @endsection
@section('content')
    <br><br>
<div class="container">
    <h1>اتصل بنا</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                {!! Form::open(['url'=>'/contact','method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    الرسالة</label>
                                <textarea name="contact_message" id="message" class="form-control" rows="9" cols="25" required="required"
                                          placeholder="من فضلك ادخل رسالتك"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    الاسم</label>
                                <input type="text" name="contact_name"  class="form-control" id="name" placeholder="من فضلك ادخل اسمك" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    البريد الالكترونى</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" name="contact_email" class="form-control" id="email" value="{{\Illuminate\Support\Facades\Auth::user()?\Illuminate\Support\Facades\Auth::user()->email:''}}" placeholder="من فضلك ادخل الاميل" required="required" /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    العنوان</label>
                                <select id="subject" name="contact_type" class="form-control" required="required">
                                    @foreach( contact() as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="banner_btn pull-right" id="btnContactUs">
                                ارسل الرسالة</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <legend><i class="fa fa-outdent"></i> مكتبنا</legend>
                <address>

                  {{nl2br(getSetting('adresse'))}}
                    <br/>
                    <abbr title="Phone">
                        ت:</abbr>
                    {{nl2br(getSetting('mobile'))}}
                </address>
                <address>
                    <strong>{{getSetting('sitename')}}</strong><br>
                    <a href="mailto:#">{{getSetting('email')}}</a>
                </address>
            </form>
        </div>
    </div>
</div>
 @endsection