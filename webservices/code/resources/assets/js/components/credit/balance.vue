<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">
            <div class="row">
                <h1 class="pull-right">
                    <i class="fa fa-money"></i>
                    رصيد العضو
                    {{user.name}}
                </h1>

                <div class="clearfix"></div>
                <div class="alert alert-warning">
                <span>
                   ارصدة العضو
                    {{user.name}}
               </span>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="well text-center">
                            <router-link :to="{path:'/ShowAllPay'}">
                                <h3>المدفوعات</h3>
                                <p>
                                    {{userPay}}
                                    $
                                </p>
                            </router-link>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="well text-center">
                            <router-link :to="{path:'/ShowAllCharge'}">
                                <h3>شحن الحساب</h3>
                                <p>
                                    {{userCharge}}
                                    $
                                </p>
                            </router-link>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="well text-center">
                            <h3>الرصيد الحالى</h3>
                            <p>
                                {{userCharge - userPay}}
                                $
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="well text-center">
                            <router-link :to="{path:'/Profit'}">
                                <h3>أرباح للسحب</h3>
                                <p>
                                    {{userProfit }}
                                    $
                                </p>
                            </router-link>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="well text-center">
                            <router-link :to="{path:'/ProfitOrders'}">
                                <h3>أرباح منتظرة</h3>
                                <p>
                                    {{waitProfit }}
                                    $
                                </p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="well text-center">
                            <router-link :to="{path:'/ProfitOrders'}">
                                <h3>أرباح مسحوبة</h3>
                                <p>
                                    {{DoneProfit }}
                                    $
                                </p>
                            </router-link>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="well text-center">
                            <router-link :to="{path:'/ProfitOrders'}">
                                <h3>اجمالى الارباح</h3>
                                <p>
                                    {{parseInt(userProfit) + parseInt(waitProfit)+parseInt(DoneProfit) }}
                                    $
                                </p>
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
           <div class="col-lg-4">
               <div class="row">
                   <div class="form-group">
                       <label >
                           سحب الأرباح
                       </label>
                       <input type="text" name="profit" v-model="profit" class="form-control"/>
                   </div>
                   <div class="alert alert-warning">
                       <b>ملحوظة:</b>
                       <span>
                        يمكنك سحب الأرباح فقط المحققة من خلال خدماتك فقط لايمكنك سحب مبالغ قمت بشحنها
                    </span>
                   </div>

                   <div class="messsages">
                       <done_message :show.sync="done" placement="top-left" duration=3000 type="success" width="400px" dismissable>
                           <span class="icon-ok-circled alert-icon-float-left"></span>
                           <b>تم:</b>
                           <p>
                               تم ارسال طلبك الى الادارة سوف يتم ارسال تنبيه اليك فى حال ارسال المبلغ
                           </p>
                       </done_message>

                       <error_message :show.sync="err" placement="top-left" duration=3000 type="danger" width="400px" dismissable >
                           <span class="icon-ok-circled alert-icon-float-left"></span>
                           <b>خطأ</b>
                           <p>
                               لا يمكنك سحب الرصيد لأسباب التالية
                               <br/>
                               1-يجب أن يكون رصيدك أكبر من 10 دولار
                               <br/>
                               2-رصيدك الحالى لايسمح باجراء السحب

                           </p>
                       </error_message>

                   </div>
                   <div class="form-group">
                       <input type="submit" @click.prevent="GetProfit()" name="submit" value="اسحب الربح" class="btn btn-info"/>
                   </div>
               </div>
           </div>



        </div>
        <div v-else>
            <div class="text-center">
                <b>
                    جارى التحميل
                </b>
            </div>
        </div>
    </div>
        </div>
    </div>
</template>
<style>
    .messsages{
        position: absolute;
        bottom:300px;
        right:0px;
        z-index: 10000;
    }


</style>
<style>
    th{
        text-align: right;
    }
</style>
<script>
    import  HeaderNav from '../layout/header.vue';
    const Alert=require('vue-strap/src/alert');
    export default {
        components:{
            header_nav:HeaderNav,
            done_message:Alert,
            error_message:Alert
        },
        data: function () {
            return{
                isLoading:false,
                user:"",
                userProfit:0,
                userPay:0,
                userCharge:0,
                profit:0,
                done:false,
                err:false,
                waitProfit:0,
               DoneProfit:0



            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.showAllBalance();
        },
        methods:{
            showAllBalance:function () {
                this.$http.get('/showAllBalance').then(function (res) {
                    this.user=res.body["user"];
                    this.userProfit=res.body["userProfit"];
                    this.userPay=res.body["userPay"];
                    this.userCharge=res.body["userCharge"];
                    this.profit=res.body["userProfit"];
                    this.waitProfit=res.body["waitProfit"];
                    this.DoneProfit=res.body["DoneProfit"];

                    this.isLoading=true;

                }, function (res) {

                });
            },
            Auth: function (val) {

                if(val === "false"){
                    this.$router.push({ path: '/loginRequire' });
                }
            },
            GetProfit: function () {
                this.done=false;
                this.err=false;
                var formdata= new FormData();
                formdata.append("profit",this.profit);
                this.$http.post('/GetProfit',formdata).then(function (res) {
                    this.userProfit=parseInt(this.userProfit) - parseInt(res.body);
                    this.profit=parseInt( this.profit) - parseInt(res.body);
                    this.waitProfit=parseInt(this.waitProfit)+parseInt(res.body);
                    this.done=true;
                    this.err=false;


                }, function (res) {
                    this.done=false;
                    this.err=true;
                });
            }
        }
    }
</script>
