<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('website/css/bootstrap.min.css') !!}
    {!! Html::style('website/css/flexslider.css') !!}
    {!! Html::style('website/css/font-awesome.min.css') !!}
    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('website/css/style.css') !!}
    {!! Html::script('website/js/jquery.min.js') !!}
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    {{-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>--}}
    <title>
      {{getSetting()}}
        |
        @yield('title')
    </title>
    {!! Html::style('cus/css/select2.css')!!}
    {!!Html::style('cus/fonts.css')!!}



    @yield('header')
</head>

<body style="direction:rtl">

  <div class="header">
  <div class="container"> <a class="navbar-brand" href="{{url('/')}}"><i class="fa fa-paper-plane"></i> ONE</a>
    <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="{{Request::root()}}/website/images/nav_icon.png" alt="" /> </a>
      <ul class="nav" id="nav">
        <li class="{{setActive(['home'],'current')}}"><a href="{{url('/home')}}">الرئيسية</a></li>
        <li {{setActive(['ShowAllBuilding'],'current')}} ><a href="{{url('/ShowAllBuilding')}}">كل العقارات</a></li>
          <li class="dropdown {{setActive(['search'],'current')}}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                 إيجار <span class="caret"></span>
              </a>

              <ul class="dropdown-menu">
                  @foreach(bu_type() as $keyType => $type)
                  <li style="width: 100%"><a href="{{url('/search?bu_rent=1&bu_type='.$keyType)}}">{{$type}}</a></li>
                  @endforeach

              </ul>
          </li>
          <li class="dropdown {{setActive(['search'],'current')}}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                 تمليك <span class="caret"></span>
              </a>

              <ul class="dropdown-menu">
                  @foreach(bu_type() as $keyType => $type)
                      <li style="width: 100%"><a href="{{url('/search?bu_rent=0&bu_type='.$keyType)}}">{{$type}}</a></li>
                  @endforeach
              </ul>
          </li>
        <li class="{{setActive(['search'],'current')}}"><a href="{{url('/contact')}}">اتصل بنا</a></li>
        @guest
            <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
            <li><a href="{{ route('register') }}">عضوية جديدة</a></li>
        @else
            <li class="dropdown {{setActive(['search'],'current')}}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{setActive(['user','editSetting'])}}">
                        <a href="{{url('/user/editSetting')}}">
                            <i class="fa fa-edit"></i>
                            تعديل المعلومات الشخصية</a>
                    </li>
                    <li class="{{setActive(['user','buildingShow'])}}" >
                        <a href="{{url('/user/buildingShow')}}">
                            <i class="fa fa-check"></i>
                            العقارات المفعلة </a>
                    </li>
                    <li class="{{setActive(['user','buildingShowWaiting'])}}">
                        <a href="{{url('/user/buildingShowWaiting')}}">
                            <i class="fa fa-clock-o"></i>
                            عقارات فى انتظار التفعيل </a>
                    </li>
                    <li class="{{setActive(['user','create','building'])}}">
                        <a href="{{url('/user/create/building')}}">
                            <i class="fa fa-plus"></i>
                            أضف عقار </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endguest
        <div class="clear"></div>
      </ul>

    </div>
  </div>
</div>


@include('layouts.message')
        @yield('content')
  <div class="footer">
  <div class="footer_bottom">
    <div class="follow-us">
       <a class="fa fa-facebook social-icon" href="{{getSetting('facebook')}}"></a>
       <a class="fa fa-twitter social-icon" href="{{getSetting('twitter')}}"></a>
        <a class="fa fa-youtube social-icon" href="{{getSetting('youtube')}}"></a>
     </div>
    <div class="copy">
      <p>{{getSetting('footer')}}&copy;{{date('Y')}}<a href="#" rel="nofollow">AhmedMahmoud</a></p>
    </div>
  </div>
</div>

        {!! Html::script('website/js/responsive-nav.js') !!}
        {!! Html::script('website/js/bootstrap.min.js') !!}
        {!! Html::script('website/js/jquery.flexslider.js') !!}
        {{Html::script('cus/js/select2.js')}}
        <script type="text/javascript">
        $(".select2").select2({
          dir: "rtl"
         });
        </script>

        @yield('footer')

</body>
</html>
