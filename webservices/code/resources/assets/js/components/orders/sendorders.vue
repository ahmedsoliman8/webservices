<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">
            <div class="row">
                <h1 class="pull-right">
                    <i class="fa fa-user"></i>
                  طلبات الشراء الخاصة بالعضو
                    {{user.name}}
                </h1>
                <span class="pull-left">
        <i class="fa fa-clock-o"></i>
        {{user.	created_at}}
    </span>
                <div class="clearfix"></div>
                <div class="alert alert-warning">
        <span>
            أنت لديك الأن
            {{services.length}}
            طلب شراء على الموقع
        </span>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12 pull-right">
                    <div class="btn-group">
                        <button class="btn btn-info" @click="filter('0')">
                           جديد
                        </button>
                        <button class="btn btn-info" @click="filter('1')">
                            قديم
                        </button>
                        <button class="btn btn-info" @click="filter('4')">
                            منتهى
                        </button>
                        <button class="btn btn-info" @click="filter('3')">
                            ملغى
                        </button>
                        <button class="btn btn-info" @click="filter('2')">
                            قيد التنفيذ
                        </button>

                        <button class="btn btn-info" @click="filter('')">
                            كل الطلبات
                        </button>
                    </div>
                </div>
                <div class="col-lg-4   col-sm-12 pull-left ">
                    <input type="text" placeholder="ابحث عن اسم الخدمة" v-model="serviceSearch"    class="form-control">
                </div>
                <div class="clearfix"></div>



            </div>
            <br/>

            <div class="row">
                <div class="col-xs-2"><b>حالة الخدمة</b></div>
                <div class="col-xs-2"><b>اضيف فى</b></div>
                <div class="col-xs-2"><b>اسم مقدم الخدمة</b></div>
                <div class="col-xs-5"><b>اسم الخدمة</b></div>
                <div class="col-xs-1"><b>رقم العملية</b></div>

            </div>
            <hr/>
               <div v-if="filteredServices.length>0">
                   <div v-for="service in services" track-by="$index">
                       <orders_send :service="service" :user_to_show="service.get_user_add_service"></orders_send>
                       <hr>
                   </div>
                   <div class="col-xs-12 btn btn-info" v-if="noMore" @click="showMore()">
                       اظهر المزيد
                   </div>
                   <div class="col-xs-12 btn btn-danger" v-if="!noMore" >
                       لا يوجد المزيد من الطلبات
                   </div>
                   <div class="clearfix">
                   </div>
                   <br/>
               </div>
              <div v-else>
               <div class="alert alert-warning">
                   <b>عغوا:</b>
                   <span>ليس لديك أى طلبات شراء</span>
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

<script>
    import Services from './orders.vue';
    import  HeaderNav from '../layout/header.vue';
    export default {

    components:{
        orders_send:Services,
        header_nav:HeaderNav
    },
        data:function () {
            return{
                isLoading:false,
                services:[],
                user:"",
                filteredServices:[],
                serviceSearch:"",
                noMore:true



            }

        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function (){
            this.getMySendOrders();
        },
        methods:{
            getMySendOrders:function (length) {
                if(length !== undefined){
                    var sendLen= '/'+length;
                }else{
                    var sendLen='';
                }
                this.$http.get('/getMySendOrders'+sendLen).then(function(res){
                    if(length !== undefined){
                        if(res.body['services'].length>0){
                            this.services=this.services.concat(res.body['services']);
                            this.filteredServices=this.filteredServices.concat(res.body['services']);
                        }else{
                            this.noMore=false;
                        }
                    }else{
                        this.services=res.body['services'];
                        this.filteredServices=res.body['services'];
                        this.user=res.body['user'];
                        this.isLoading=true;
                    }



                },function(res){
       //   alert('هناك خطأ ما برجاء الاتصال باالادارة');
                });
            },
            filter: function (value) {
                this.services=this.filteredServices;
                this.services = this.services.filter(function (service) {
                    const searchRegex = new RegExp(value, 'i');
                    return (
                        searchRegex.test(service.status)
                    )
                })

            },
         showMore: function () {
            var length=this.filteredServices.length;
            this.getMySendOrders(length);
        },
            Auth: function (val) {

                if(val === "false"){
                    this.$router.push({ path: '/loginRequire' });
                }
            }

        }
    , watch:{
        serviceSearch: function(val,oldVal){
            this.services=this.filteredServices;
            this.services = this.services.filter(function (service) {
                const searchRegex = new RegExp(val, 'i');
                return (
                    searchRegex.test(service.services.name)
                )
            })
        }
    }

    }
</script>