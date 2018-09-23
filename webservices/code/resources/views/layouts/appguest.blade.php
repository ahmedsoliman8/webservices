<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
{!! Html::style('css/style.css')  !!}
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app" style="direction: rtl;text-align: right">

   <nav class="navbar navbar-default navbar-static-top">
             <div class="container">
             <div class="navbar-header pull-right">
                 <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button>
                     <a class="navbar-brand pull-right" href="{{url("/")}}#">
                         خدمات ويب
                     </a>
                 <div class="form-inline search pull-right">
                     <input type="text" class="form-control" placeholder="البحث"/>
                     <button class="btn btn-info">
                         <i class="fa fa-search"></i>
                         ابحث</button>
                 </div>


             </div>

             <div class="collapse navbar-collapse js-navbar-collapse">
                 <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown mega-dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">الأقسام <span class="caret"></span></a>
                         <ul class="dropdown-menu mega-dropdown-menu">
                            @foreach(\App\Cat::get(['name','id']) as $cat)
                                 <li class="col-sm-3 pull-right">
                                     <ul>

                                             <li>
                                                <a href="{{url('/')}}#/Cat/{{$cat->id}}/{{$cat->name}}">
                                                    {{$cat->name}}
                                                </a>

                                             </li>

                                     </ul>
                                 </li>
                             @endforeach

                         </ul>
                     </li>

                 </ul>
                 <ul class="nav navbar-nav navbar-left">

                     <!-- Authentication Links -->
                     @guest
                         <li><a href="{{ route('login') }}"> <i class="fa fa-user"></i>
                                 تسجيل الدخول
                             </a></li>
                         <li><a href="{{ route('register') }}"> <i class="fa fa-user-plus"></i>
                                 تسجيل عضوية جديدة</a></li>
                     @endguest


                 </ul>
             </div><!-- /.nav-collapse -->
             </div>
         </nav>


    @yield('content')
</div>

<!-- Scripts -->
{!! Html::script('js/app.js') !!}
</body>
</html>
