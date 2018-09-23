<template>
    <div>
    <header_nav></header_nav>
    <div class="container">
  <div class="col-lg-12">
    <div v-if="isLoading">

        <h1 class="pull-right">
          <i class="fa fa-bell"></i>
          التنبيهات الخاصة بالعضو
          {{user.name}}
        </h1>
        <span class="pull-left" style="margin-top: 30px">
               اجمالى عدد التنبيهات
                  {{not.length}}
              </span>
        <div class="clearfix"></div>
        <div class="alert alert-warning">
                <span>
                   التنبيهات الخاصة بالعضو
                    {{user.name}}
               </span>
        </div>


        <div class="row">

                <message_menu></message_menu>


            <div class="col-md-10 col-xs-12 pull-left">
                <table class="table table-striped">
                    <tbody>
                    <tr v-for="n in not">
                        <td>{{n.id}}</td>
                    <td>
                        <not_list :n="n"></not_list>
                    </td>
                        <td>{{n.created_at}}</td>
                    </tr>
                    </tbody>
                </table>
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
<style>
  th{
    text-align: right;
  }
</style>
<script>
    import MessageMenu from '../Messages/messagemenu.vue';
    import  HeaderNav from '../layout/header.vue';
    import NotesList from '../btns/note.vue';
    export default {

        components: {
            message_menu: MessageMenu,
            header_nav:HeaderNav,
            not_list:NotesList

        },
        data: function () {
            return{
                isLoading:false,
                user:"",
                not:[]


            }
        },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function () {
            this.GetNotification();
        },
        methods:{
            GetNotification:function () {
                this.$http.get('/GetNotification').then(function (res) {
                    this.user=res.body["user"];
                    this.not=res.body["not"];

                    this.isLoading=true;

                }, function (res) {

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
