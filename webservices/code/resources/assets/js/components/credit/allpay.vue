<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">
            <div class="row">
                <h1 class="pull-right">
                    <i class="fa fa-plus"></i>
                    عمليات المدفوعات
                    {{user.name}}
                </h1>
                <span class="pull-left" style="margin-top: 30px">
               اجمالى عمليات المدفوعات
                  {{sum}}$
              </span>
                <div class="clearfix"></div>
                <div class="alert alert-warning">
                <span>
                   اجمالى عمليات المدفوعات الخاصة بالعضو
                    {{user.name}}
               </span>
                </div>

            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>رقم العملية</th>
                    <th>الطلب </th>
                    <th>قيمةالدفع</th>
                    <th>حالة الدفع</th>
                    <th>تاريخ الدفع</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="b in buy">
                    <td>{{b.id}}</td>
                    <td>
                        <router-link :to="{name:'/Order',params:{order_id:b.order_id}}">
                            رقم الطلب #
                            {{b.order_id}}
                        </router-link>
                    </td>
                    <td>{{b.buy_price}}</td>
                    <td>
                        <span v-if="b.finish ==0"  class="label label-warning">
                         رصيد معلق
                        </span>
                        <span v-else-if="b.finish ==1" class="label label-danger">
                             رصيد مخصوم
                        </span>
                        <span v-else-if="b.finish ==2" class="label label-danger">
                                      طلب ملغى
                        </span>
                    </td>


                    <td>{{b.created_at}}</td>
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
                buy:[],
                sum:0

            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.ShowAllPay();
        },
        methods:{
            ShowAllPay:function () {
                this.$http.get('/ShowAllPay').then(function (res) {
                    this.user=res.body["user"];
                    this.buy=res.body["buy"];
                    this.sum=res.body["sum"];
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
