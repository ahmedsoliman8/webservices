<template>
   <div>
      <header_nav></header_nav>
      <div class="container">


         <div class="row">
            <message_menu></message_menu>
            <div class="col-sm-9 col-md-10 pull-left">
               <div class="messsages">
                  <done_message :show.sync="done" placement="top-left" duration="3000" type="success" width="400px" dismissable>
                     <span class="icon-ok-circled alert-icon-float-left"></span>
                     <b>تم:</b>
                     <p>
                        تم ارسال رسالة
                     </p>
                  </done_message>

                  <error_message :show.sync="err" placement="top-left" duration="3000" type="danger" width="400px" dismissable >
                     <span class="icon-ok-circled alert-icon-float-left"></span>
                     <b>خطأ</b>
                     <p>لا يمكنك ارسال رسالة الان برجاء المحاولة لاحقا</p>
                  </error_message>
               </div>
               <div class="form-group">
                  <label>نص الرسالة</label>
                  <input type="text" class="form-control" v-model="title"/>
               </div>
               <div class="form-group alert alert-danger" v-if="showTitle">
                  <p class="title-required" >هذا الحقل مطلوب</p>
                  <p class="min-title" > يجب ان يكون عنوان الرسالة أكثر من 10 حرف</p>

               </div>

               <div class="form-group">
                  <label>عنوان الرسالة</label>
                  <textarea class="form-control" rows="3" v-model="message"></textarea>
               </div>
               <div class="form-group alert alert-danger" v-if="showMessage">
                  <p class="message-required" >هذا الحقل مطلوب</p>
                  <p class="min-message" > يجب ان يكون الرسالة أكثر من 20 حرف</p>

               </div>
               <div class="form-group">
                  <input type="submit" v-bind:disabled="disable" @click.prevent="addMessage()" name="submit" value="أرسل رسالة" class="btn btn-info">
               </div>



            </div>
         </div>




   </div>
   </div>
</template>
<style>
   .messsages{
      position: absolute;
      top:130px;
      right:10px;
      z-index: 10000;
   }
</style>
<script>
    import MessageMenu from './messagemenu.vue';
    const Alert=require('vue-strap/src/alert');
    import  HeaderNav from '../layout/header.vue';
    export default {
      components:{
          message_menu:MessageMenu,
          done_message:Alert,
          error_message:Alert,
          header_nav:HeaderNav
      },
      data: function(){
        return{
            message:"",
            title:"",
            showMessage:true,
            showTitle:true,
            err:false,
            done:false,

        }
      },
        created:function(){
            this.$on("Auth",this.Auth);
        },

        watch:{
            message: function (val,oldVal) {

                if(val.length>0){
                    $('.message-required').fadeOut();

                }else {
                    $('.message-required').fadeIn();
                }
                if(val.length>=20){
                    $('.min-message').fadeOut();
                    this.showMessage=false;

                }else{
                    this.showMessage=true;
                    $('.min-message').fadeIn();
                }
            },
            title: function (val,oldVal) {

                if(val.length>0){
                    $('.title-required').fadeOut();

                }else {
                    $('.title-required').fadeIn();
                }
                if(val.length>=10){
                    $('.min-title').fadeOut();
                    this.showTitle=false;

                }else{
                    this.showTitle=true;
                    $('.min-title').fadeIn();
                }
            }
        },
        computed:{
            disable:function () {
                if(this.showMessage==false&&this.showTitle==false){
                 return false;
                }
                else {
                return true;
                }
            }
        },
        methods:{
            addMessage: function () {
                const  formData=new FormData();
                formData.append('user_id',this.$route.params.user_id);
                formData.append('message',this.message);
                formData.append('title',this.title);
                this.$http.post('/sendNewMessage',formData).then(function(res){
                this.title="";
                this.message="";
                this.err=false;
                this.done=true;

                },function(res){
                    this.title="";
                    this.message="";
                    this.err=true;
                    this.done=false;

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
