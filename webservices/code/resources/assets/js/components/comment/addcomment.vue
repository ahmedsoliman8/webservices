<template>
   <div class="col-xs-12">
       <div class="messsages">
           <done_message :show.sync="done" placement="top-left" duration=3000 type="success" width="400px" dismissable>
               <span class="icon-ok-circled alert-icon-float-left"></span>
               <b>تم:</b>
               <p>
           تم اضافة التعليق
               </p>
           </done_message>

           <error_message :show.sync="err" placement="top-left" duration=3000 type="danger" width="400px" dismissable >
               <span class="icon-ok-circled alert-icon-float-left"></span>
               <b>خطأ</b>
               <p>لا يمكنك اضافة التعليق الان برجاء المحاولة لاحقا</p>
           </error_message>
       </div>
       <div class="form-group">
       <textarea class="form-control" rows="3" v-model="comment"></textarea>
       </div>
       <div class="form-group">
           <input type="submit" v-bind:disabled="disable" @click.prevent="addComment()" name="submit" value="أضف تعليق" class="btn btn-info">
       </div>

       <div class="form-group alert alert-danger" v-if="disable">
            <p class="comment-required" >هذا الحقل مطلوب</p>
           <p class="min-comment" > يجب ان يكون التعليق أكثر من 20 حرف</p>

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
    const Alert=require('vue-strap/src/alert');
    export default {
        components:{
            done_message:Alert,
            error_message:Alert
        },
      props:['order'],
      data:function () {
          return{
              comment:"",
              disable:true,
              err:false,
              done:false
          }
      },
        watch:{
            comment: function (val,oldVal) {

             if(val.length>0){
                 $('.comment-required').fadeOut();

             }else {
                 $('.comment-required').fadeIn();
             }
             if(val.length>=20){
                 $('.min-comment').fadeOut();
                 this.disable=false;

             }else{
                 this.disable=true;
                 $('.min-comment').fadeIn();
             }
          }
        }
        ,
        methods:{
          addComment:function () {
             const  formData=new FormData();
             formData.append('order_id',this.order.id);
             formData.append('comment',this.comment);
              this.$http.post('/addNewComment',formData).then(function(res){


                 this.$parent.$emit('Add-New-Comment',res.body);
                  this.comment='';
                  this.err=false;
                  this.done=true;

              },function(res){

                 this.comment="";
                  this.err=true;
                  this.done=false;

              });
          }
        }
    }
</script>
