<template>

    <div class="thumbnail" >
        <router-link :to="{name:'/ServiceDetails',params:{services_id:service.id,services_name:service.name }}">
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
                         <router-link :to="{name:'/User',params:{user_id:service.user.id,username:service.user.name}}">
                             {{service.user.name}}
                         </router-link>

                     </h3>
                </div>
            </div>
            <div v-if="service.vote.length > 0 ">

                <div class="pull-left product-rating">

                            <span class="label label-info">
                                <i class="fa fa-user"></i>
                                {{service.vote.length}}
                            </span>
                    <span class="label label-warning">
                                    <i class="fa fa-star"></i>
                                {{sum}}
                            </span>
                    <span class="label label-success">
                                {{(sum * 100) / (parseInt(service.vote.length) * 5)}} %
                            </span>
                </div>
            </div>
            <div class="clearfix"></div>
            <btn_buy :service="service"></btn_buy>
            <btn_fav :service="service"></btn_fav>



        </div>
    </div>

</template>

<script>

    import BtnBuy from '../btns/buy.vue';
    import BtnFav from '../btns/fav.vue';
    import Rating from  '../btns/rating.vue';

    export default {
        components:{
            btn_buy : BtnBuy,
            btn_fav:BtnFav,
            rating:Rating
        },
      props:['service'],
      data: function(){
            return{
             sum:0
            }

      },
        mounted: function(){
           this.sumVote();
        },
        filters: {
            limit: function(text,value,suffix){
                return text.substring(0,value)+suffix;
            }
        },
        methods:{
            sumVote: function () {

             if(this.service.vote.length>0){
                 var i;
                 for( i=0;i<this.service.vote.length;i++){
                     this.sum=this.sum+parseInt(this.service.vote[i].vote);
                 }
             }


            }
        }

    }
</script>

