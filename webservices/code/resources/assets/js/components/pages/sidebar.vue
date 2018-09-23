<template>
    <div class="col-md-3 col-xs-12 pull-left">
        <ul v-if="sideBarSection3" class="list-group" style="padding: 0px">
            <li class="list-group-item active">
                <h5>
                    <i class="fa fa-caret-square-o-up"></i>
                    الأكثر مبيعا
                </h5>
            </li>
            <li v-for="section3 in sideBarSection3" class="list-group-item">
                <div class="row">
                    <div class="col-lg-12">
                        <router-link  :to="{name:'/ServiceDetails',params:{services_id: section3.id,services_name: section3.name}}">
                            <span> {{section3.name}}</span>
                        </router-link>
                    </div>

                </div>


            </li>
        </ul>
        <ul v-if="sideBarSection2" class="list-group" style="padding: 0px">
            <li class="list-group-item active">
                <h5>
                    <i class="fa fa-heart"></i>
                    اخترنالك
                </h5>
            </li>
            <li v-for="section2 in sideBarSection2" class="list-group-item">
                <div class="row">
                    <div class="col-lg-12">
                        <router-link  :to="{name:'/ServiceDetails',params:{services_id: section2.id,services_name: section2.name}}">
                            <span> {{section2.name}}</span>
                        </router-link>
                    </div>

                </div>


            </li>
        </ul>
        <ul class="list-group" style="padding: 0px">
            <li class="list-group-item active">
                <h5>
                    <i class="fa fa-floppy-o"></i>
                    الأقسام
                </h5>
            </li>
            <li v-for="c in cat" class="list-group-item">
                <div class="row">
                    <div class="col-lg-12">
                        <router-link :to="{name:'/Cat',params:{cat_id:c.id,cat_name:c.name}}">
                            <span> {{c.name}}</span>
                        </router-link>

                    </div>

                </div>


            </li>
        </ul>
        <ul class="list-group" style="padding: 0px">
        <li class="list-group-item active">
            <h5>
                <i class="fa fa-eye"></i>
                الأكثر مشاهدة
            </h5>
        </li>
        <li v-for="mvsb in mostViewedSideBar" class="list-group-item">
            <div class="row">
                <div class="col-lg-12">
                    <router-link  :to="{name:'/ServiceDetails',params:{services_id: mvsb.id,services_name: mvsb.name}}">
                        <span> {{mvsb.name}}</span>
                    </router-link>
                </div>

            </div>


        </li>
    </ul>


    </div>
</template>

<script>
    export default {
     props:['cat','mostViewedSideBar','sideBarSection2','sideBarSection3']
    }
</script>
