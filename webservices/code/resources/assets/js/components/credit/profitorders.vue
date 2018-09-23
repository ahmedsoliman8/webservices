<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
            <div class="col-lg-12">
                <div v-if="isLoading">
                    <div class="row">
                        <h1 class="pull-right">
                            <i class="fa fa-plus"></i>
                            الأرباح المسحوبة
                            {{user.name}}
                        </h1>
              <span class="pull-left" style="margin-top: 30px">
                           <span class="label label-warning" style="margin-left: 10px">
                      ارباح فى انتظار الادارة
                     {{sumWaiting}}$
                           </span>
                  <span class="label label-success">
                     ارباح تم ارسالها
                    {{sumDone}}$
                  </span>
              </span>
                        <div class="clearfix"></div>
                        <div class="alert alert-warning">
                <span>
                   اجمالى ارباح العضو
                    {{parseInt(sumWaiting)+parseInt(sumDone)}}
               </span>
                        </div>

                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>رقم العملية</th>
                            <th>السعر </th>
                            <th>حالة السحب</th>
                            <th>التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="p in profit">
                            <td>{{p.id}}</td>
                            <td>{{p.profit_price}}$</td>
                            <td>
                              <span v-if="p.status ==0"  class="label label-warning">
                            فى انتظار ارسال الادارة
                           </span>
                           <span v-else-if="p.status ==1" class="label label-success">
                             تم الارسال بنجاح
                           </span>
                            </td>
                            <td>{{p.created_at}}</td>
                        </tr>
                        </tbody>
                    </table>

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
    th{
        text-align: right;
    }
</style>
<script>
    import  HeaderNav from '../layout/header.vue';
    export default {
        components:{
            header_nav:HeaderNav
        },

        data: function () {
            return{
                isLoading:false,
                user:"",
                profit:[],
                sumWaiting:0,
                sumDone:0

            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.ShowAllOrderProfit();
        },
        methods:{
            ShowAllOrderProfit:function () {
                this.$http.get('/ShowAllOrderProfit').then(function (res) {
                    this.user=res.body["user"];
                    this.profit=res.body["profit"];
                    this.sumWaiting=res.body["sumWaiting"];
                    this.sumDone=res.body["sumDone"];
                    this.isLoading=true;

                }, function (res) {

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
