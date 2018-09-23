<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
    <div class="col-lg-12">
        <div v-if="isLoading">

            <div class="row">
                <message_menu></message_menu>
                <message_list :messagesList="messagesList" :type="'new'"></message_list>
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
    import MessageMenu from './messagemenu.vue';
    import MessageList from './messageslist.vue';
    import  HeaderNav from '../layout/header.vue';

    export default {
        components: {
            message_menu: MessageMenu,
            message_list:MessageList,
            header_nav:HeaderNav

        },
        data: function () {
            return{
                messagesList:[],
                isLoading:false
            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted:function () {
            this.GetMyRecievedMessages();
        },
        methods:{
            GetMyRecievedMessages: function () {
                this.$http.get('/GetUnreadMessage').then(function(res){
                    this.messagesList=res.body;

                    this.isLoading=true;


                },function(res){

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
