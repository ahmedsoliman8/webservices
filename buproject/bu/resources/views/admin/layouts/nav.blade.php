
<li ><a href="{{url('/adminpanel')}}"><i class="fa fa-home"></i><span>رئيسية التحكم</span></a></li>
<li ><a href="{{url('/adminpanel/sitesetting')}}"><i class="fa fa-gears"></i> <span>إعدادات رئيسية</span></a></li>

{{-- users--}}
<li class="treeview">
  <a href="#">
    <i class="fa fa-users"></i>
    <span >التحكم فى الأعضاء</span>
    <i class="fa fa-angle-left pull-left"></i>

  </a>

  <ul class="treeview-menu">
    <li class="active"><a href="{{url('/adminpanel/users/create')}}"><i class="fa fa-circle-o"></i> <span>أضف عضو</span></a></li>
    <li><a href="{{url('/adminpanel/users')}}"><i class="fa fa-circle-o"></i> <span>كل الأعضاء</span></a></li>
  </ul>
</li>


{{-- bu--}}
<li class="treeview">
  <a href="#">
    <i class="fa fa-building ">

    </i> <span >التحكم فى العقارات</span>
    <i class="fa fa-angle-left pull-left"></i>

  </a>

  <ul class="treeview-menu">
    <li class="active"><a href="{{url('/adminpanel/bu/create')}}"><i class="fa fa-circle-o"></i> <span>أضف عقار</span></a></li>
    <li><a href="{{url('/adminpanel/bu')}}"><i class="fa fa-circle-o"></i><span>كل العقارات</span> </a></li>
  </ul>
</li>

{{-- Contact--}}
<li><a href="{{url('/adminpanel/contact')}}"><i class="fa fa-envelope-o"></i><span>الرسائل</span></a></li>

{{-- Contact--}}
<li><a href="{{url('/adminpanel/buYear/statics')}}"><i class="fa fa-bar-chart"></i><span>احصائيات اضافة العقار</span> </a></li>

