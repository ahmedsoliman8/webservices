<template>
    <div >
        <header_nav ></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">
            <div class="row">
                <div class="col-md-9 col-xs-12 pull-right">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 pull-right">
                            <div class="btn-group">
                                <button class="btn btn-info" @click.prevent="orderedServices('id')">
                                    المضاف أخيرا
                                </button>
                                <button class="btn btn-info" @click.prevent="orderedServices('vote_sum')">
                                    الأعلى تقيما
                                </button>
                                <button class="btn btn-info" @click.prevent="orderedServices('price')">
                                    على حسب السعر
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4   col-sm-12 pull-left ">
                            <input type="text" placeholder="ابحث عن اسم الخدمة" v-model="serviceSearch"   class="form-control">
                        </div>


                    </div>
                    <br/>
                    <div class="row">
                        <div v-if="filteredServices.length > 0">
                            <div v-for="service in services"   class="col-xs-6 col-md-4 pull-right">
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
                        </div>
                        <div v-else>
                            <div class="alert alert-warning">
                                لايوجود خدمات حتى الأن
                            </div>
                        </div>
                    </div>
                </div>

                <main_side_bar :cat="cat" :mostViewedSideBar="mostViewedSideBar" :sideBarSection2="sideBarSection2" :sideBarSection3="sideBarSection3"></main_side_bar>

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
    import MainSideBar from './sidebar.vue';
    import  HeaderNav from '../layout/header.vue';
    export default {
        components: {
            single_service: SingleServices,
            main_side_bar:MainSideBar,
            header_nav:HeaderNav

        },
        data: function () {
            return {
                services: [],
                filteredServices:[],
                serviceSearch:"",
                isLoading:false,
                id:false,
                price:false,
                cat:[],
                mostViewedSideBar:[],
                sideBarSection2:[],
                noMore:true,
                sideBarSection3:[],
                fav:0



            }
        },
        created : function(){
            this.$on('Add-To-Parent-Fav',this.AddToParentFav);
        },
        mounted: function () {
            this.getAllServices();
        },
        methods: {
            AddToParentFav: function(val){

            },
            getAllServices: function (length) {
                if(length !== undefined){
                    var sendLen= '/'+length;
                }else{
                    var sendLen='';
                }
                this.$http.get('/getAllServices'+sendLen).then(function (res) {
                    if(length !== undefined){
                        if(res.body.length>0){
                            this.services=this.services.concat(res.body);
                            this.filteredServices=this.filteredServices.concat(res.body);
                        }else{
                            this.noMore=false;
                        }

                    }else{
                        this.services = res.body['services'];
                        this.filteredServices=res.body['services'];
                        this.cat=res.body['cat'];
                        this.mostViewedSideBar=res.body['mostViewedSideBar'];
                        this.sideBarSection2=res.body['sideBarSection2'];
                        this.sideBarSection3=res.body['sideBarSection3'];
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
                } else if(valueOrder === 'vote_sum'){
                    this.services=this.filteredServices;
                }
                else if(valueOrder === 'price'){
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
                this.getAllServices(length);
            }
        },
        watch:{
            serviceSearch: function(val,oldVal){
                this.services=this.filteredServices;
                this.services = this.services.filter(function (user) {
                    const searchRegex = new RegExp(val, 'i');
                    return (
                        searchRegex.test(user.price) ||
                        searchRegex.test(user.name)
                    )
                })
            }
        }
    }
</script>

