<template>
    <div class="thumbnail" >
        <router-link :to="{name:'/ServiceDetails',params:{services_id: service.id,services_name:service.name }}">
            <h3 >{{service.name}}</h3>
        </router-link>

        <img  v-bind:src="'/images/services/'+service.image" class="img-responsive">
        <div class="caption">
            <div class="row">
                <div class="col-md-6 col-xs-6 price text-left">
                    <h3>
                        <label>${{service.price}}</label></h3>
                </div>
                <div class="col-md-6 col-xs-6">
                     <h3>
                         <router-link :to="{name:'/User',params:{user_id:service.user_id,username:service.username}}">
                             {{service.username}}
                         </router-link>

                     </h3>
                </div>

            </div>
            <p>{{service.des |limit(100,'...')}}</p>
            <p>
                <i class="fa fa-eye"></i>
                {{service.view_count}}
            </p>

                        <span v-if="service.status == 0">
                    <span class="btn btn-warning btn-product col-lg-12">
                        <i class="fa fa-clock-o"></i>
                       فى انتظار الادارة
                    </span>
                        </span>
                    <span v-if="service.status == 1">
                    <span class="btn btn-success btn-product col-lg-12">
                        <i class="fa fa-check"></i>
                       تم الموافقة على الخدمة
                    </span>
                        </span>
                    <span v-if="service.status == 2">
                    <span class="btn btn-danger btn-product col-lg-12">
                        <i class="fa fa-close"></i>
                       تم رفض من الادارة
                    </span>
                        </span>



            <div class="clearfix"></div>

            <p> </p>
        </div>
    </div>
</template>

<script>

    export default {
      props:['service'],
        filters: {
            limit: function(text,value,suffix){
                return text.substring(0,value)+suffix;
            }
        }

    }
</script>

