<template>
       <div class="row">
           <div class="col-xs-2 ">
           <status :status="service.status"></status>
           </div>
           <div class="col-xs-2">{{service.created_at}}</div>
           <div class="col-xs-2">
               <router-link :to="{name:'/User',params:{user_id:user_to_show.id,username:user_to_show.name}}">
                   {{user_to_show.name}}
               </router-link>
           </div>
           <div class="col-xs-5"><b>

               <router-link :to="{name:'/Order',params:{order_id:service.id}}">
                   {{service.services.name}}
               </router-link>
           </b></div>
           <div class="col-xs-1">{{service.id}}</div>
       </div>
</template>

<script>
    import Status from '../btns/status.vue';
    export default {
     components:{
         status:Status
     },
    props:['service','user_to_show']
    }
</script>
