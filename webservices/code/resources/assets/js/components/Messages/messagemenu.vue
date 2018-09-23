<template>
    <div class="col-xs-12 col-md-2 pull-right">

        <ul class="nav nav-pills nav-stacked" style="padding: 0">
            <li class="active">
                <router-link :to="{name:'/GetMyRecievedMessages'}">
                    <i class="fa fa-mail-forward"></i>
                    الوارد
                </router-link>
            </li>
            <li>
                <router-link :to="{name:'/GetMySendMessages'}"><i class="fa fa-mail-reply"> </i>الصادر </router-link>
            </li>
            <li>
                <router-link :to="{name:'/GetUnreadMessage'}">
                    <i class="fa fa-eye-slash"></i>
                    رسائل غير مقرءوة  </router-link>
            </li>
            <li>
                <router-link :to="{name:'/GetReadMessage'}"><i class="fa fa-eye"> </i>رسائل مقرءوة </router-link>
            </li>
            <li>
                <router-link :to="{name:'/GetMyFav'}">
                    <i class="fa fa-heart"></i>
                    المفضلة
                </router-link>
            </li>
            <li>
                <router-link :to="{path:'/Notification'}">
                    <i class="fa fa-bell"></i>
                    التنبيهات
                </router-link>
            </li>


        </ul>
    </div>
</template>

<script>


</script>
