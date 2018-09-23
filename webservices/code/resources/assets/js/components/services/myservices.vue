<template>
    <div >
        <header_nav></header_nav>
        <div class="container">
    <div class="row">
        <div v-if="isLoading">
<div class="row">
    <h1 class="pull-right">
        <i class="fa fa-user"></i>
        الخدمات الخاصة بالعضو
        {{user.name}}
    </h1>
    <span class="pull-left">
        <i class="fa fa-clock-o"></i>
        {{user.created_at}}
    </span>
    <div class="clearfix"></div>
    <div class="alert alert-warning">
        <span>
            أنت لديك الأن
            {{services.length}}
            على الموقع
        </span>
    </div>

</div>

<div class="row">
    <div class="col-lg-6 col-sm-12 pull-right">
        <div class="btn-group">
            <button class="btn btn-info" @click="orderedServices('price')">
                على حسب السعر
            </button>
            <button class="btn btn-info" @click="orderedServices('status')">
                فى انتظار الادارة
            </button>
            <button class="btn btn-info" @click="orderedServices('id')">
                المضاف أخيرا
            </button>
        </div>
    </div>
        <div class="col-lg-4   col-sm-12 pull-left ">
            <input type="text" placeholder="ابحث عن اسم الخدمة" v-model="serviceSearch"   class="form-control">
        </div>
        <div class="clearfix"></div>



</div>
<br/>

        <div v-if="filteredServices.length > 0">
    <div v-for="service in services"  track-by="$index" class="col-sm-6 col-md-4 pull-right">

        <single_service :service="service"></single_service>
    </div>
            <div class="col-xs-12 btn btn-info" v-if="noMore" @click="showMore()">
                اظهر المزيد
            </div>
            <div class="col-xs-12 btn btn-danger" v-if="!noMore" >
                لا يوجد المزيد من الخدمات
            </div>
            <div class="clearfix">

            </div>
            <br/>
    </div >
        <div v-else>
        <div class="alert alert-warning">
            ليس لديك أى خدمات حاليا برجاء اضافة خدمة جديدة
             <router-link :to="{path:'/AddServices'}"><i class="fa fa-plus"></i>
                                                اضافة خدمة</router-link>
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
    import SingleServices from './singleservices.vue';
    import  HeaderNav from '../layout/header.vue';
    export default {
        components: {
            single_service: SingleServices,
            header_nav:HeaderNav
        },
        data: function () {
            return {
                services: [],
                filteredServices:[],
                serviceSearch:"",
                user:"",
                isLoading:false,
                noMore:true,
                id:false,
                price:false




            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.getMyServices();

        },
        methods: {
            getMyServices: function (length) {
                if(length !== undefined){
                    var sendLen= '/'+length;
                }else{
                    var sendLen='';
                }
                this.$http.get('/getMyServices'+sendLen).then(function (res) {
                    if(length !== undefined){
                        if(res.body['services'].length>0){
                            this.services=this.services.concat(res.body['services']);
                            this.filteredServices=this.filteredServices.concat(res.body['services']);
                        }else{
                            this.noMore=false;
                        }

                    }else{
                        this.isLoading=true;
                        this.services = res.body['services'];
                        this.filteredServices=res.body['services'];
                        this.user=res.body['user'];
                    }

                }, function (res) {
                    alert('خطأ غير معروف برجاء الاتصال بالادارة');
                });
            },
            showMore:function(){
               var length=this.filteredServices.length;
               this.getMyServices(length);
            },
            orderedServices: function (valueOrder) {
                if (valueOrder === 'id') {
                    if(this.id===false){
                        this.services = _.orderBy(this.services, valueOrder,'desc');
                        this.id=true;
                    }else{
                        this.services = _.orderBy(this.services, valueOrder,'asc');
                        this.id=false;
                    }

                } else if (valueOrder === 'price') {
                    if(this.price===false){
                        this.services = _.orderBy(this.services, valueOrder,'desc');
                        this.price=true;
                    }else{
                        this.services = _.orderBy(this.services, valueOrder,'asc');
                        this.price=false;
                    }

                }

            },
          Auth: function (val) {

                if(val === "false"){
                    this.$router.push({ path: '/loginRequire' });
                }
            }
        },
        watch:{
            serviceSearch: function(val,oldVal){
                this.services=this.filteredServices;
                this.services = this.services.filter(function (user) {
                    const searchRegex = new RegExp(val, 'i');
                    return (
                        searchRegex.test(user.name) ||
                        searchRegex.test(user.price)
                    )
                })
            }




        }

    }
</script>

