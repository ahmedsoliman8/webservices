<template>
    <div class="sidebar-nav">
        <div class="well" style="padding: 8px 0;">
            <ul class="nav nav-list" style="padding-right: 0;">
                <li>
                    <router-link :to="{name:'/User',params:{user_id:user.id,username:user.name}}">
                        <i class="fa fa-user"></i>
                        {{user.name}}
                  </router-link>
                </li>
                <li class="divider"></li>
                 <li v-for="service in user.services">
                     <router-link :to="{name:'/ServiceDetails',params:{services_id:service.id,services_name:service.name}}">
                     <i class="icon-home"></i>{{service.name}}
                     </router-link>
                 </li>
                <li class="divider"></li>


            </ul>
        </div>
    </div>
</template>

<script>
    export default {
   props:['user']
    }
</script>
