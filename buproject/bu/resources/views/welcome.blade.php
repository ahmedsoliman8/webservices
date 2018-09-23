@extends('layouts.app')
@section('title')
    أهلا بك زائرنا الكريم
@endsection
@section('header')

  <link rel="stylesheet" href="{{Request::root()}}/main/css/reset.css"> <!-- CSS reset -->
  <link rel="stylesheet" href="{{Request::root()}}/main/css/style.css">
  <script src="{{Request::root()}}/main/js/modernizr.js"></script>
@endsection

@section('content')
<div class="banner text-center" style="background: url('/website/slider/{{getSetting("main_slider")}}') no-repeat center;">
  <div class="container">
    <div class="banner-info">
      <h1>
        أهلا بك فى
        {{getSetting()}}
      </h1>
      <p>
        {!! Form::open(['url'=>'search','method'=>'get']) !!}
        <div class="row">
          <div class="col-lg-3">
            {!! Form::text("bu_price_from",null,["class" => "form-control" ,'placeholder' => 'سعر العقار من']) !!}
          </div>
          <div class="col-lg-3">
            {!! Form::text("bu_price_to",null,["class" => "form-control" ,'placeholder' => 'سعر العقار إلى']) !!}
          </div>
          <div class="col-lg-3">
            {!! Form::select("bu_room",roomnumber(),null,["class" => "form-control select2" ,'placeholder' => 'عدد الغرف']) !!}
          </div>
          <div class="col-lg-3">
            {!! Form::select("bu_type",bu_type(),null,["class" => "form-control" ,'placeholder' => 'نوع العقار']) !!}
          </div>
        </div>
<br>
          <div class="row">
            <div class="col-lg-3">
              {!! Form::submit("ابحث",["class" => "btn",'style'=>'width:100%']) !!}
            </div>
            <div class="col-lg-3">
              {!! Form::select("bu_place",bu_place(),null,["class" => "form-control select2" ,'placeholder' => 'منطقة العقار']) !!}
            </div>
            <div class="col-lg-3">
              {!! Form::select("bu_rent",bu_rent(),null,["class" => "form-control" ,'placeholder' => 'نوع العملية']) !!}
            </div>
            <div class="col-lg-3">
              {!! Form::text("bu_square",null,["class" => "form-control" ,'placeholder' => 'المساحة']) !!}
            </div>
          </div>


      {!! Form::close() !!}
      </p>
      <a class="banner_btn" href="{{url('/user/create/building')}}">اضف عقارك مجانا</a> </div>
  </div>
</div>
<div class="main">
  <ul class="cd-items cd-container">
    @foreach(\App\bu::where('bu_status',1)->get() as $bu)
    <li class="cd-item effect8">
      <img src="{{checkIfImageIsexist($bu->image)}}" alt="{{$bu->bu_name}}" title="{{$bu->bu_name}}">
      <a href="#0" data-id="{{$bu->id}}" class="cd-trigger" title="{{$bu->bu_name}}">نبذة سريعة</a>
    </li>
    @endforeach
  </ul>

  <div class="cd-quick-view">
    <div class="cd-slider-wrapper">
      <ul class="cd-slider">
        <li><img src=""  class="imagebox" alt=""></li>

      </ul> <!-- cd-slider -->


    </div> <!-- cd-slider-wrapper -->

    <div class="cd-item-info">
      <h2 class="titlebox"></h2>
      <p class="disbox"></p>

      <ul class="cd-item-action">
        <li><a class="add-to-cart pricebox"></a></li>
        <li><a href="#0" class="morebox">اقرا المزيد</a></li>
      </ul> <!-- cd-item-action -->
    </div> <!-- cd-item-info -->
    <a href="#0" class="cd-close">Close</a>
  </div> <!-- cd-quick-view -->
</div>
@endsection

@section('footer')
  <script src="{{Request::root()}}/main/js/jquery-2.1.1.js"></script>
  <script src="{{Request::root()}}/main/js/velocity.min.js"></script>
  <script>
    function urlHome() {
       return  '{{Request::root()}}';
    }
    function noImageUrl() {
        return "{{getSetting('no_image')}}";
    }
  </script>
  <script src="{{Request::root()}}/main/js/main.js"></script>
@endsection