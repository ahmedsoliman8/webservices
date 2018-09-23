<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">
            <div class="row">
                <h1 class="pull-right">
                    <i class="fa fa-plus"></i>
                    اضافة رصيد
                    {{user.name}}
                </h1>
              <span class="pull-left" style="margin-top: 30px">
               اجمالى عمليات الشحن
                  {{sum}}$
              </span>
                <div class="clearfix"></div>
                <div class="alert alert-warning">
                <span>
                   عمليات الشحن الخاصة بالعضو
                    {{user.name}}
               </span>
                </div>

            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>رقم العملية</th>
                    <th>طريقة الشحن</th>
                    <th>حالة الشحن</th>
                    <th>قيمة الشحن</th>
                    <th>تاريخ الشحن</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="p in pay">
                        <td>{{p.id}}</td>
                        <td>{{p.payment_method}}</td>
                        <td>{{p.state}}</td>
                        <td>{{p.price}}</td>
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
                pay:[],
                sum:0

            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.getAllChargeOperation();
        },
        methods:{
            getAllChargeOperation:function () {
                this.$http.get('/getAllChargeOperation').then(function (res) {
                   this.user=res.body["user"];
                   this.pay=res.body["pay"];
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
