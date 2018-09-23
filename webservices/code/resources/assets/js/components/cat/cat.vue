<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="row">
        <div v-if="isLoading">
            <div class="col-md-9 col-xs-12 pull-right">
                <div class="row">
                    <h1 >
                        <i class="fa fa-floppy-o"></i>
                        {{cat.name}}
                    </h1>


                    <div class="alert alert-warning">
                 <span>
                 {{cat.des}}
                 </span>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12 pull-right">
                        <div class="btn-group">
                            <button class="btn btn-info" @click="orderedServices('price')">
                                على حسب السعر
                            </button>
                            <button class="btn btn-info" @click="orderedServices('id')">
                                المضاف أخيرا
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4   col-xs-12 pull-left ">
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
                        لا يوجد خدمات فى هذا القسم حاليا
                    </div>
                </div>
            </div>

            <side_bar :mostViewedSideBar="mostViewedSideBar" :sideBarSection3="sideBarSection3" :cat="cats" :sideBarSection2="sideBarSection2" ></side_bar>

            <div class="clearfix">

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
    import SideBar from '../pages/sidebar.vue';
    import  HeaderNav from '../layout/header.vue';

    export default {
        components: {
            single_service: SingleServices,
            side_bar:SideBar,
            header_nav:HeaderNav
        },
        data: function () {
            return {
                services: [],
                filteredServices:[],
                serviceSearch:"",
                isLoading:false,
                cat:"",
                id:false,
                price:false,
                noMore:true,
                $mostViewedSideBar:[],
                $sideBarSection2:[],
                cats:[],
                sideBarSection3:[]
            }
        },
        mounted: function () {
            this.getServicesByCatId();

        },
        methods: {
            getServicesByCatId: function (length) {
                if(length !== undefined){
                   var sendLen= '/'+length;
                }else{
                    var sendLen='';
                }
                this.$http.get('/getServicesByCatId/'+this.$route.params.cat_id+sendLen).then(function (res) {
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
                        this.cats=res.body['cats'];
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
                this.getServicesByCatId(length);
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

