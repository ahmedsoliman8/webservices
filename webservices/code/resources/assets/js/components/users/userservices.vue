<template>
    <div >
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
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
            العضو {{user.name}}
            لديه
            {{services.length}}
            خدمة
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

                        <single_service :service="service" ></single_service>
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
                        العضو
                        {{user.name}}
                        ليس لديه اى خدمات حاليا

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
    import SingleServices from '../pages/singleservices.vue';
    import  HeaderNav from '../layout/header.vue';
    export default {
        components: {
            single_service: SingleServices,
            header_nav:HeaderNav
        },
        data: function () {
            return {
                services: [],
                user: "",
                filteredServices:[],
                serviceSearch:"",
                id:false,
                price:false,
                noMore:true,
                isLoading:false

            }
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
                this.$http.get('/getUserServices/'+this.$route.params.user_id+sendLen).then(function (res) {
                    if(length !== undefined) {
                        if (res.body['services'].length > 0) {
                            this.services = this.services.concat(res.body['services']);
                            this.filteredServices = this.filteredServices.concat(res.body['services']);
                        } else {
                            this.noMore = false;
                        }
                    }else{
                        this.services = res.body['services'];
                        this.filteredServices=res.body['services'];
                        this.user = res.body['user'];
                        this.isLoading=true;
                    }




                }, function (res) {
                    alert('خطأ غير معروف برجاء الاتصال بالادارة');
                });
            },
            orderedServices: function (valueOrder) {

                if (valueOrder === 'id') {
                    if(this.id===false){
                        this.services = _.orderBy(this.services, valueOrder,'desc');
                        this.id=true;
                    }
                    else{
                        this.services = _.orderBy(this.services, valueOrder,'asc');
                        this.id=false;
                    }

                } else if (valueOrder === 'price') {
                    if(this.price===false){
                        this.services = _.orderBy(this.services, valueOrder,'desc');
                        this.price=true;
                    }
                    else{
                        this.services = _.orderBy(this.services, valueOrder,'asc');
                        this.price=false;
                    }
                }



            },
            showMore: function () {

                var length=this.filteredServices.length;
                this.getMyServices(length);
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

