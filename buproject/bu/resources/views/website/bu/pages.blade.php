<div class="col-md-3">
    @if(Auth::user())
        <div class="profile-sidebar">
            <h2 style="">خيار العضو</h2>
            <div class="profile-usermenu">
                <ul class="nav" style="padding-right: 0;margin-right: 0;">
                    <li class="{{setActive(['user','editSetting'])}}">
                        <a href="{{url('/user/editSetting')}}">
                           <i class="fa fa-edit"></i>
                            تعديل المعلومات الشخصية</a>
                    </li>
                    <li class="{{setActive(['user','buildingShow'])}}" >
                        <a href="{{url('/user/buildingShow')}}">
                            <i class="fa fa-check"></i>
                            العقارات المفعلة
                            <label class="label-default pull-left"> {{buforusercount(1,Auth::user()->id)}}</label>                          </a>
                    </li>
                    <li class="{{setActive(['user','buildingShowWaiting'])}}">
                        <a href="{{url('/user/buildingShowWaiting')}}">
                            <i class="fa fa-clock-o"></i>
                            عقارات فى انتظار التفعيل
                         <label class="label-default pull-left"> {{buforusercount(0,Auth::user()->id)}}</label>
                        </a>
                    </li>
                    <li class="{{setActive(['user','create','building'])}}">
                        <a href="{{url('/user/create/building')}}">
                            <i class="fa fa-plus"></i>
                            أضف عقار </a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
    @endif
    <div class="profile-sidebar">
        <h2 style="">خيار العقارات</h2>
        <div class="profile-usermenu">
            <ul class="nav" style="padding-right: 0;margin-right: 0;">

                <li class="{{setActive(['ShowAllBuilding'])}}">
                    <a href="{{url('/ShowAllBuilding')}}">
                        <i class="fa fa-building"></i>
                        كل العقارات </a>
                </li>
                <li class="{{setActive(['ForRent'])}}">
                    <a href="{{url('/ForRent')}}">
                        <i class="fa fa-calendar"></i>
                        إيجار </a>
                </li>
                <li class="{{setActive(['ForBuy'])}}">
                    <a href="{{url('/ForBuy')}}">
                        <i class="fa fa-building-o"></i>
                        تمليك </a>
                </li>
                <li class="{{setActive(['type','0'])}}">
                    <a href="{{url('/type/0')}}">
                        <i class="fa fa-home"></i>
                        الشقق</a>
                </li>
                <li class="{{setActive(['type','1'])}}">
                    <a href="{{url('/type/1')}}">
                        <i class="fa fa-home"></i>
                        الفلل</a>
                </li>
                <li class="{{setActive(['type','2'])}}">
                    <a href="{{url('/type/2')}}">
                        <i class="fa fa-institution"></i>
                        الشاليهات</a>
                </li>

            </ul>
        </div>
    </div>
    <br>
    <div class="profile-sidebar">
        <h2 style="">البحث المتقدم</h2>
        <div class="profile-usermenu">
            {!! Form::open(['url'=>'search','method'=>'get']) !!}
            <ul class="nav" style="padding-right: 0;margin-right: 0;">
                <li class="itemsearch">
                    {!! Form::text("bu_price_from",null,["class" => "form-control" ,'placeholder' => 'سعر العقار من']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::text("bu_price_to",null,["class" => "form-control" ,'placeholder' => 'سعر العقار إلى']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::select("bu_place",bu_place(),null,["class" => "form-control select2" ,'placeholder' => 'منطقة العقار']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::select("bu_room",roomnumber(),null,["class" => "form-control" ,'placeholder' => 'عدد الغرف']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::select("bu_type",bu_type(),null,["class" => "form-control" ,'placeholder' => 'نوع العقار']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::select("bu_rent",bu_rent(),null,["class" => "form-control" ,'placeholder' => 'نوع العملية']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::text("bu_square",null,["class" => "form-control" ,'placeholder' => 'المساحة']) !!}
                </li>
                <li class="itemsearch">
                    {!! Form::submit("ابحث",["class" => "banner_btn"]) !!}
                </li>




            </ul>
            {!! Form::close() !!}
        </div>
    </div>
</div>