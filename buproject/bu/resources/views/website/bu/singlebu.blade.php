@extends('layouts.app')
@section('title')
    العقار
    {{$buInfo->bu_name}}
@endsection
@section('header')
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    {!! Html::style('cus/buall.css') !!}
    <style type="text/css" rel="stylesheet">
        hr{
            margin-top,margin-bottom:10px;
        }
        .dis{
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .itemsearch{
            margin-bottom: 20px;
        }
        .breadcrumb{
            background-color: #ffffff;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row profile">



            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">الرئيسية</a></li>
                    <li><a href="{{url('/ShowAllBuilding')}}">كل العقارات</a></li>
                    <li><a href="{{url('/singleBuilding/'.$buInfo->id)}}">{{$buInfo->bu_name}}</a></li>

                </ol>

                <div class="profile-content">
                 <h1>{{$buInfo->bu_name}}</h1>
                 <hr>
                    <div class="btn-group" role="group">

                    <a href="{{url('/search?bu_square='.$buInfo->bu_square)}}" class="btn btn-default">
                        المساحة:
                        {{$buInfo->bu_square}}
                    </a>
                     <a href="{{url('/search?bu_price='.$buInfo->bu_price)}}" class="btn btn-default">
                        السعر:
                        {{$buInfo->bu_price}}
                        </a>
                    <a href="{{url('/search?bu_place='.$buInfo->bu_place)}}" class="btn btn-default">
                        المنطقة:
                        {{bu_place()[$buInfo->bu_place]}}
                    </a>
                   <a href="{{url('/search?bu_room='.$buInfo->bu_room)}}" class="btn btn-default">
                        عدد الغرف:
                        {{$buInfo->bu_room}}
                    </a>
                   <a href="{{url('/search?bu_rent='.$buInfo->bu_rent)}}" class="btn btn-default">
                        نوع العملية:
                        {{bu_rent()[$buInfo->bu_rent]}}
                    </a>
                   <a href="{{url('/search?bu_type='.$buInfo->bu_type)}}" class="btn btn-default">
                        نوع العقار:
                        {{bu_type()[$buInfo->bu_type]}}
                    </a>

                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5aaead6fe34ef8b9"></script>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->

                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                    <hr>
                    <img src="{{checkIfImageIsexist($buInfo->image)}}" class="img-responsive"/>

                    <br>
                    <p>
                        {!! nl2br($buInfo->bu_large_dis) !!}
                    </p>



                </div>
                <br>
                <div class="profile-content">
                  <h3>عقارات أخرى قد تهمك </h3>
                  <hr>
                  @include('website.bu.shareFile',['bu' =>$same_rent])
                  @include('website.bu.shareFile',['bu' =>$same_type])
                </div>
            </div>
              @include('website.bu.pages');
        </div>
    </div>

    <br>
    <br>

@endsection

@section('footer')
    <script>
        function myMap() {
            var mapCanvas = document.getElementById("map");
            var myCenter = new google.maps.LatLng(51.508742,-0.120850);
            var mapOptions = {center: myCenter, zoom: 5};
            var map = new google.maps.Map(mapCanvas,mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter,
                animation: google.maps.Animation.BOUNCE
            });
            marker.setMap(map);
        }
    </script>
@endsection
