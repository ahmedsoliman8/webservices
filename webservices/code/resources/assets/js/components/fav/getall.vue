<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">

            <div class="row">
                <message_menu></message_menu>
                <fav_list :favList="favList"></fav_list>
            </div>
        </div>
        <div v-else>
            جارى التحميل ........
        </div>
    </div>
        </div>
    </div>
</template>

<script>
    import MessageMenu from '../Messages/messagemenu.vue';
    import FavList from './favlist.vue';
    import  HeaderNav from '../layout/header.vue';


    export default {
        components: {
            message_menu:MessageMenu,
            fav_list:FavList,
            header_nav:HeaderNav


        },
        data: function () {
            return{
                favList:[],
                isLoading:false
            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted:function () {
            this.getUserFav();
        },
        methods:{
            getUserFav: function () {
                this.$http.get('/getUserFav').then(function(res){
                    this.favList=res.body;

                    this.isLoading=true;


                },function(res){

                });
            }
            ,
            Auth: function (val) {

                if(val === "false"){
                    this.$router.push({ path: '/loginRequire' });
                }
            }
        }
    }

</script>
