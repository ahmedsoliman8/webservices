<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div class="messsages">
        <done_message :show.sync="done" placement="top-left" duration=3000 type="success" width="400px" dismissable>
            <span class="icon-ok-circled alert-icon-float-left"></span>
            <b>تم:</b>
          <p>تم تغيير حالة الخدمة بنجاح</p>
        </done_message>

        <error_message :show.sync="err" placement="top-left" duration=3000 type="danger" width="400px" dismissable >
            <span class="icon-ok-circled alert-icon-float-left"></span>
            <b>خطأ</b>
            <p>
           هناك خطأ ما برجاء الاتصال بالإدارة
            </p>
        </error_message>
    </div>
        <div class="row">
            <div class="col-lg-9 pull-right">
                <div v-if="isLoading">

                    <div class="col-xs-12">
                        <div class="content-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <div class="col-md-12">
                                        <span class="product-title pull-right">
                                            {{order.services.name}}
                                             <status :status="order.status"></status>
                                        </span>
                                        <span class="small pull-left"><i class="fa fa-clock-o"></i>{{order.created_at}} </span>
                                        <div class="clearfix"></div>
                                        <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
                                    </div>

                                    <div class="col-md-12">
                                        <img id="item-display" class="img-responsive" v-bind:src="'/images/services/'+order.services.image" alt="">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="product-desc">{{order.services.des}}</div>
                                        <hr>
                                        <div class="product-price pull-left">$ {{order.services.price}}</div>
                                        <div class="product-stock pull-right">عدد مرات الشراء({{order_count}})</div>
                                        <div class="clearfix">

                                        </div>
                                        <div >


                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>



                        <all_comment :order="order"></all_comment>



                </div>

                <div v-else>
                    <div class="text-center">
                        <b>
                            جارى التحميل
                        </b>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-left">
                <div class="clearfix">
                                      <span v-if="authUser.id == user.id">
                                       <div v-if="showController">
                                            <button class="btn btn-success pull-right" @click="changeStatus(2)">
                                           <i class="fa fa-check"></i>
                                           قبول الطلب
                                       </button>
                                          <button class="btn btn-danger pull-left" @click="changeStatus(3)">
                                           <i class="fa fa-close"></i>
                                           رفض الطلب
                                       </button>
                                       </div>
                                      </span>
                                     <span v-else>
                                         <div v-if="showControllerUserOrder">
                                                 <button class="btn btn-success pull-right" @click="finishOrder()">
                                           <i class="fa fa-check"></i>
                                           انهى الطلب
                                       </button>
                                         </div>
                                     </span>
                </div>
                <br/>
                <user_sidebar :user="user"></user_sidebar>
            <user_sidebar :user="order_user"></user_sidebar>


            </div>

        </div>
    </div>
        </div>
    </div>

</template>

<script>
    import UserSidebar from './usersidebar.vue';
    import Status from '../btns/status.vue';
    import AllComment from '../comment/allcomment.vue';
    const Alert=require('vue-strap/src/alert');
    import  HeaderNav from '../layout/header.vue';

    export default {
        components:{
            status:Status,
            user_sidebar:UserSidebar,
            all_comment:AllComment,
            done_message:Alert,
            error_message:Alert,
            header_nav:HeaderNav


        },
        data: function(){
            return{
                order:"",
                isLoading:false,
                user:"",
                order_user:"",
                order_count:"",
                authUser:"",
                err:false,
                done:false,
                showController:false,
                showControllerUserOrder:false


            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.GetOrderById();
        },
        methods:{
            GetOrderById: function () {
                this.$http.get('/GetOrderById/'+this.$route.params.order_id).then(function(res){

                    this.order=res.body['order'];
                    this.user=res.body['user'];
                    this.order_user=res.body['order_user'];
                    this.order_count=res.body['order_count'];
                    this.authUser=res.body['auth_user'];
                if(this.order.status === 4){
                        this.showController=false;
                    } else
                    if(this.order.status !== 2 && this.order.status !== 3){
                        this.showController=true;
                    }


                    if(this.order.status ===2){
                        this.showControllerUserOrder=true;
                    }


                    this.isLoading=true;
                },function(res){

                    this.$router.push({ path: '/' });

                });
            },
            changeStatus:function (status) {
                this.$http.get('/changeStatus/'+this.$route.params.order_id+'/'+status).then(function(res){

                   this.showController=false;
                   this.order.status=status;
                   this.done=true;
                    this.err=false;

                },function(res){
              this.err=true;
              this.done=false;

                });
            },
            finishOrder:function () {
                this.$http.get('/finishOrder/'+this.$route.params.order_id).then(function(res){
                    this.showControllerUserOrder=false;
                    this.done=true;
                    this.err=false;

                },function(res){
                    this.err=true;
                    this.done=false;

                });
            },
            Auth: function (val) {

                if(val === "false"){
                    this.$router.push({ path: '/loginRequire' });
                }
            }
        }


    }
</script>

