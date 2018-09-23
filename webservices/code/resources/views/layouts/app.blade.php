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

       {{--  <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                <div class="navbar-header pull-right">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <router-link class="navbar-brand pull-right" :to="{path:'/'}">
                            خدمات ويب
                        </router-link>
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
                               @foreach(\App\Cat::get(['name','id'])->chunk(8) as $cat)
                                    <li class="col-sm-3 pull-right">
                                        <ul>
                                   @foreach($cat as $c)
                                                <li>
                                                   <router-link :to="{name:'/Cat',params:{cat_id:{{$c->id}},cat_name:'{{$c->name}}'}}">
                                                       {{$c->name}}
                                                   </router-link>

                                                </li>
                                  @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav navbar-left">

                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                            <li><a href="{{ route('register') }}">تسجيل عضوية جديدة</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <span class="hidden-lg hidden-md">الرسائل</span>
                                    <i class="fa fa-envelope"></i>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <router-link :to="{path:'/GetMyRecievedMessages'}">
                                            <i class="fa fa-mail-reply"></i>
                                            الوارد
                                        </router-link>

                                    </li>
                                    <li>
                                        <router-link :to="{path:'/GetMySendMessages'}">
                                            <i class="fa fa-mail-forward"></i>
                                            الصادر
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{path:'/GetUnreadMessage'}">
                                            <i class="fa fa-eye-slash"></i>
                                            رسائل غير مقرءوة
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{path:'/GetReadMessage'}">
                                           <i class="fa fa-eye"></i>
                                            رسائل مقرءوة
                                        </router-link>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                   <i class="fa fa-reorder"></i>  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <router-link :to="{path:'/IncomeOrders'}">
                                            <i class="fa fa-truck fa-lg"></i>
                                            الطلبات الواردة
                                        </router-link>

                                    </li>
                                    <li>
                                        <router-link :to="{path:'/SendOrders'}">
                                            <i class="fa fa-shopping-cart"></i>
                                            طلبات المشتريات
                                        </router-link>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <i class="fa fa-server"></i> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <router-link :to="{path:'/AddServices'}"><i class="fa fa-plus"></i>
                                            اضافة خدمة</router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{path: '/MyServices'}">
                                            <i class="fa fa-user"></i>
                                            خدماتى
                                        </router-link>


                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <i class="fa fa-money"></i>  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                            <li>
                                <router-link :to="{path:'/AddCredit'}">
                                    <i class="fa fa-plus"></i>
                                    شحن الحساب
                                </router-link>
                            </li>
                             <li>
                              <router-link :to="{path:'/ShowAllCharge'}">
                                 <i class="fa fa-plus"></i>
                                  عمليات شحن الرصيد
                                   </router-link>
                               </li>
                                    <li>
                                        <router-link :to="{path:'/ShowAllPay'}">
                                            <i class="fa fa-minus"></i>
                                            المدفوعات
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{path:'/Profit'}">
                                            <i class="fa fa-briefcase"></i>
                                            الأرباح
                                        </router-link>
                                    </li>
                            <li>
                                <router-link :to="{path:'/Balance'}">
                                    <i class="fa fa-money"></i>
                                    رصيدى
                                </router-link>
                            </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                   <i class="fa fa-user"></i> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa  fa-edit"></i>
                                            تعديل بياناتى
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                            <i class="fa fa-btn fa-sign-out"></i>
                                            تسجيل الخروج
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">
                                    <i class="fa fa-bell"></i>
                                    <span class="notNotification posNot">
                                        {{getAllNotification(\Illuminate\Support\Facades\Auth::user()->id)}}
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                   @include("layouts.note")
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <router-link :to="{path:'/Notification'}">
                                            <i class="fa  fa-bell"></i>
                                            كل التنبيهات
                                        </router-link>
                                    </li>

                                </ul>

                            </li>
                            <li>
                                <router-link :to="{path:'/GetMyFav'}">
                                    <i class="fa fa-heart"></i>
                                    <span class="not posNot">
                                        {{ getFavNumber( \Illuminate\Support\Facades\Auth::user()->id)}}
                                    </span>
                                    <span class="hidden-lg hidden-md">المفضلة</span>
                                </router-link>
                            </li>

                            <li>
                                <router-link :to="{path:'/IncomeOrders'}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="notOrder posNot">
                                        {{ getAllPayOrders( \Illuminate\Support\Facades\Auth::user()->id)}}
                                    </span>
                                    <span class="hidden-lg hidden-md">المشتريات</span>
                                </router-link>
                            </li>


                        @endguest


                    </ul>
                </div><!-- /.nav-collapse -->
                </div>
            </nav> --}}



        @yield('content')
    </div>

    <!-- Scripts -->
    {!! Html::script('js/app.js') !!}
</body>
</html>
