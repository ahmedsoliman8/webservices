<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
        <div v-if="isLoading">
            <div class="row">

            </div>
            <hr />
            <div class="row">
                <message_menu></message_menu>
                <div class="col-sm-9 col-md-10 pull-left">
                    <ol class="breadcrumb">
                        <li v-if="view_type == 'send'"> <router-link :to="{name:'/GetMySendMessages'}">الصادر </router-link></li>
                        <li v-else-if="view_type == 'income'"> <router-link :to="{name:'/GetMyRecievedMessages'}">الوارد</router-link></li>
                        <li v-else> <router-link :to="{name:'/GetUnreadMessage'}">رسائل غير مقرءوة</router-link></li>
                        <li class="active">{{message.title}}</li>
                    </ol>

                    <hr/>
                    <h2>تفاصيل الرسالة</h2>

                    <table class="table   table-striped">
                        <tbody>
                        <tr>
                            <th>عنوان الرسالة</th>
                            <td>{{message.title}}</td>
                        </tr>
                        <tr>
                            <th>نص الرسالة</th>
                            <td>{{message.message}}</td>
                        </tr>
                        <tr>
                            <th>أرسلت فى </th>
                            <td>{{message.created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div v-if="view_type == 'send'">
                        <h2>معلومات عن المرسل إليه</h2>
                        <table class="table   table-striped">
                            <tbody>
                            <tr>
                                <th>الاسم</th>
                                <td>
                                    <router-link :to="{name:'/User',params:{user_id:message.get_recieved_user.id,username:message.get_recieved_user.name}}">
                                    {{message.get_recieved_user.name}}
                                    </router-link>
                                </td>
                            </tr>
                            <tr>
                                <th>أرسلت فى </th>
                                <td>{{message.created_at}}</td>
                            </tr>

                            </tbody>
                        </table>
                        <send_message :user="message.get_recieved_user"></send_message>
                    </div>
                    <div v-else>
                        <h2> معلومات عن المرسل </h2>
                        <table class="table   table-striped">
                            <tbody>
                            <tr>
                                <th>الاسم</th>
                                <td>
                                    <router-link :to="{name:'/User',params:{user_id:message.get_send_user.id,username:message.get_send_user.name}}">
                                        {{message.get_send_user.name}}
                                    </router-link>

                                </td>
                            </tr>
                            <tr>
                                <th>أرسلت فى </th>
                                <td>{{message.created_at}}</td>
                            </tr>


                            </tbody>
                        </table>
                        <send_message :user="message.get_send_user"></send_message>
                    </div>


                </div>



            </div>
        </div>
        <div v-else>
            جارى التحميل ........
        </div>
    </div>
    </div>
</template>

<script>
    import MessageMenu from './messagemenu.vue';
    import SendMessage from '../btns/sendmessage';
    import  HeaderNav from '../layout/header.vue';

    export default {
        components: {
            message_menu: MessageMenu,
            send_message:SendMessage,
            header_nav:HeaderNav


        },
        data: function () {
            return{
               message:"",
                isLoading:false,
                view_type:""
            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted:function () {
            this.view_type=this.$route.params.view_type;

            this.GetThisMessageDetails();
        },
        methods:{
            GetThisMessageDetails: function () {
                this.$http.get('/GetThisMessageDetails/'+this.$route.params.message_id).then(function(res){
                    this.message=res.body;
                    this.isLoading=true;
                },function(res){

                });
            }
        },
        Auth: function (val) {

            if(val === "false"){
                this.$router.push({ path: '/loginRequire' });
            }
        }
    }

</script>
