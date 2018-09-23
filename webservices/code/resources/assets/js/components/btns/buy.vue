<template>
    <div class="bigdiv">

<div class="messsages">
    <done_message :show.sync="done" placement="top-left" duration=3000 type="success" width="400px" dismissable>
  <span class="icon-ok-circled alert-icon-float-left"></span>
     <b>تم:</b>
                <p>
                    تم طلب الخدمة بنجاح فى انتظار رد مقدم الخدمة
                      <router-link :to="{path:'/SendOrders'}">
                     لعرض تفاصيل الخدمة
                </router-link>
                </p>
</done_message>

  <error_message :show.sync="err" placement="top-left" duration=3000 type="danger" width="400px" dismissable >
  <span class="icon-ok-circled alert-icon-float-left"></span>
     <b>خطأ</b>
                <p>
                    لا يمكنك طلب هذه الخدمة لأحد الأسباب التالية
                <br/>
                1-هذه الخدمة مضافة من طرفك
                <br/>
                2-هذه الخدمة قمت بطلبها سابقا
                <br/>
                3- هذه الخدمة غير موجودة لديكم
                </p>
</error_message>
</div>
        <button @click.prevent="AddOrder()"  v-bind:disabled="disable" class="btn btn-success">
                        <span class="glyphicon glyphicon-shopping-cart">

                        </span>
            اشترى
        </button>

    </div>
</template>
<style>
    .messsages{
        position: absolute;
        bottom:50px;
        right:20px;
        z-index: 10000;
    }
    .bigdiv{
        display: inline-block;
    }

</style>
<script>
    const Alert=require('vue-strap/src/alert');

    export default {
        components:{
          done_message:Alert,
          error_message:Alert
        },
        props:['service'],
        data: function(){
            return{
                err:false,
                done:false,
                disable:false
            }
        },
        methods:{
            AddOrder: function () {
                this.disable=true;
                this.$http.get('/AddOrder/'+this.service.id).then(function(res){

                   this.err=false;
                   this.done=true;

                },function(res){
                    this.err=true;
                    this.done=false;

                });
                this.disable=false;
            }
        }
    }
</script>