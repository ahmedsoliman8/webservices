<template>
    <div >
        <header_nav></header_nav>
        <div class="container">
<span v-if="isLoading">
     <div class="row">
<div class="col-md-3 col-xs-12">
<side_bar :service="service" :mostViewed="mostViewed" :mostVoted="mostVoted" :sideBarSection2="sideBarSection2"></side_bar>
</div>

    <div class="col-md-9 col-xs-12">

            <div class="content-wrapper">
                <div class="item-container">
                    <div class="container">
                        <div class="col-md-12">
                        <span class="product-title pull-right">{{service.name}} </span>
                        <span class="small pull-left"><i class="fa fa-clock-o"></i>{{service.created_at}} </span>
                        <div class="clearfix"></div>

                         <rating :service="service"></rating>

                        <div class="pull-left">
                            <span class="label label-info">

                                <i class="fa fa-user"></i>
                                عدد المصوتين
                                {{service.vote_count}}
                            </span>
                              <span class="label label-warning">
                                    <i class="fa fa-star"></i>
                                 عدد النجوم

                                {{sum}}
                            </span>
                              <span class="label label-success">
                                  نسبة التصويت
                                {{(sum * 100) / (parseInt(service.vote_count) * 5)}} %
                            </span>
                        </div>
                             <div class="clearfix"></div>

                        </div>
                        <div class="col-md-12">
                       <img id="item-display" class="img-responsive" v-bind:src="'/images/services/'+service.image" alt="">

                        </div>


                        <div class="col-md-12">
                            <div class="product-desc">{{service.des}}</div>
                            <hr>
                            <div class="product-price">$ {{service.price}}</div>
                            <div class="product-stock">عدد مرات الشراء({{order_count}})</div>
                            <hr>
                            <div >
                               <btn_buy :service="service"></btn_buy>
                                <btn_fav :service="service"></btn_fav>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="col-md-12 product-info">
                        <ul id="myTab" class="nav nav-tabs nav_tabs" style="padding-right:0">

                            <li class="active"><a href="#service-one" data-toggle="tab">خدماتى فى نفس القسم</a></li>
                            <li><a href="#service-two" data-toggle="tab">خدمات أعضاء فى نفس القسم</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="service-one">
                                <div class="row">
                                <div v-if="myownServiceInsameCat.length>0">
                                     <div v-for="service in  myownServiceInsameCat" track-by="$index" class="col-sm-6 col-md-4 pull-right">
                                <br/>
                               <my_own_service_in_same_cat :service="service"></my_own_service_in_same_cat>
                                </div>
                                </div>

                                </div>

                                </div>
                            <div class="tab-pane fade" id="service-two">
                               <div class="row">
                                <div v-if="otherServiceInsameCat.length>0">
                                      <div v-for="service in  otherServiceInsameCat" track-by="$index" class="col-sm-6 col-md-4 pull-right">
                                <br/>
                               <other_service_in_same_cat :service="service"></other_service_in_same_cat>
                                </div>
                                </div>

                                </div>
                            </div>

                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>
</span>

<span v-else>
         <div class="text-center">
                <b>
                    جارى التحميل
                </b>
            </div>
</span>

        </div>
    </div>

</template>

<script>
    import myownServiceInsameCat from './singleservices.vue';
    import otherServiceInsameCat from '../users/singleservices.vue';
    import SideBar from  './sidebar.vue';
    import BtnBuy from '../btns/buy.vue';
    import BtnFav from '../btns/fav.vue';
    import Rating from  '../btns/rating.vue';
    import  HeaderNav from '../layout/header.vue';

    export default {
        components:{
            my_own_service_in_same_cat  : myownServiceInsameCat,
            other_service_in_same_cat   : otherServiceInsameCat,
            side_bar : SideBar,
            btn_buy : BtnBuy,
            btn_fav:BtnFav,
            rating:Rating,
            header_nav:HeaderNav



        },
        data: function(){
            return{
              service:"",
              isLoading:false,
              myownServiceInsameCat:[],
              otherServiceInsameCat:[],
                order_count:0,
                sum:0,
                mostVoted:[],
                mostViewed:[],
                sideBarSection2:[]
            }
        },
        mounted: function () {

           this.GetServicesById();
        },
        created: function () {
                this.$on('Add-New-Rate',this.AddNewRate);
        }
        ,
        methods:{
            GetServicesById: function () {
                this.$http.get('/GetServicesById/'+this.$route.params.services_id).then(function(res){
            this.service=res.body['service'];
            this.myownServiceInsameCat=res.body['myownServiceInsameCat'];
            this.otherServiceInsameCat=res.body['otherServiceInsameCat'];
            this.order_count=res.body['order_count'];
            this.sum=parseInt(res.body['sum']);
            this.mostVoted=res.body['mostVoted'];
            this.mostViewed=res.body['mostViewed'];
            this.sideBarSection2=res.body['sideBarSection2'];
            this.isLoading=true;
                },function(res){

                    this.$router.push({ path: '/' });

                });
            },
            AddNewRate:function (val) {
                this.service.vote_count+=1;
                this.sum= parseInt(this.sum) +parseInt(val);
            }

        }


    }
</script>

