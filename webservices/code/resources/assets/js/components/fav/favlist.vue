<template>
    <div class="col-xs-12 col-md-10 pull-left">
        <div>
            <ol class="breadcrumb">
                <li> <router-link :to="{name:'/GetMyFav'}">المفضلة</router-link></li>
                <li class="active">
                    عدد الخدمات المفضلة
                    ({{favList.length}})
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12 pull-right">
                <div class="btn-group">
                    <button class="btn btn-info" @click="orderedFav('created_at')">
                        على حسب التاريخ
                    </button>
                </div>
            </div>
            <div class="col-lg-4   col-sm-12 pull-left ">
                <input type="text" placeholder="ابحث بعنوان الخدمة"  v-model="favSearch"  class="form-control">
            </div>
            <div class="clearfix"></div>
        </div>
        <br/>

        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th>اسم صاحب الخدمة </th>
                <th>اسم الخدمة</th>
                <th>أضيف فى</th>
                <th>احذف</th>
            </tr>
            </thead>
            <tbody v-if="favList.length > 0">
            <tr v-for="(fav,index) in  favListNew">
                <td>
                    <router-link :to="{name:'/User',params:{user_id:fav.get_own_user_service.id,username:fav.get_own_user_service.name}}">
                        {{fav.get_own_user_service.name}}
                    </router-link>

                </td>
                <td>
                    <router-link :to="{name:'/ServiceDetails',params:{services_id:fav.services.id,services_name:fav.services.name}}">
                    {{fav.services.name}}
                    </router-link>
                </td>
                <td>{{fav.created_at}}</td>
                <td>
                    <a @click.prevent="deleteFav(fav.id,index)" class="btn btn-danger" >
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            </tbody>
            <tbody v-else>
            <tr>
                <td colspan="4">لا يوجود خدمات مفضلة</td>
            </tr>
            </tbody>
        </table>
    </div>

</template>
<style>
    th{
        text-align: right;
    }
</style>

<script>
    export default {
        props: {favList: {type: Array}},
        data: function () {
            return {
                created_at: false,
                favListNew: this.favList,
                favSearch: "",


            }

        },
        methods: {
            orderedFav: function (valueOrder) {
                if (valueOrder === 'created_at') {
                    if (this.created_at === true) {
                        this.favListNew = _.orderBy(this.favListNew, valueOrder, 'desc');
                        this.created_at = false;
                    } else {

                        this.favListNew = _.orderBy(this.favListNew, valueOrder, 'asc');
                        this.created_at = true;
                    }
                }

            },
            deleteFav: function (id,index) {

                this.$http.get('/deleteFav/'+id).then(function(res){
                    this.favListNew.splice(index,1);
                },function(res){

                });
                
            }
        },
        watch: {
            favSearch: function (val, oldVal) {
                this.favListNew = this.favList;
                this.favListNew = this.favListNew.filter(function (fav) {
                    const searchRegex = new RegExp(val, 'i');
                    return (
                        searchRegex.test(fav.services.name)
                    )
                })
            }
        }
    }
</script>
