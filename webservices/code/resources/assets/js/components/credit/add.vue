<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
        <div v-if="isLoading">

            <div class="row">
                <h1 class="pull-right">
                    <i class="fa fa-plus"></i>
                   اضافة رصيد
                    {{user.name}}
                </h1>

                <div class="clearfix"></div>
                <div class="alert alert-warning">
                <span>
                   أنت الأن تقوم باضافة رصيد إلى العضو
                    {{user.name}}
               </span>
                </div>

            </div>
            <div>
                <form action="/AddCreditNow" method="post">
                        <input type="hidden" name="_token" v-model="_token" class="form-control"/>
                    <div class="form-group">
                        <label>الرصيد</label>
                        <select  name="price"   v-model="price" class="form-control">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                            <option value="60">60</option>
                            <option value="70">70</option>
                            <option value="80">80</option>
                            <option value="90">90</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" v-bind:disabled="disable"  value="اشحن الأن"  name="submit" class="btn btn-default" />
                    </div>
                </form>
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
</template>
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
                 email:"",
                 price:"10",
                 disable:false,
                 _token:''
             }
         },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.getAuthUser();
        },
        methods:{
            getAuthUser:function () {
                this.$http.get('/getAuthUser').then(function (res) {
                this.user=res.body;
                this.email=res.body.email;
                this._token=document.head.querySelector('meta[name="csrf-token"]').content;
                this.isLoading=true;

                }, function (res) {

                });
            },
            AddCreditNow:function () {
                this.isLoading=false;
             this.disable=true;
             const formData=new FormData();
             formData.append('price',this.price);
                this.$http.post('/AddCreditNow',formData).then(function (res) {

                    this.$router.push({ path: '/ShowAllCharge' });

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
