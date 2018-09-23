<template>
    <div class="bigdiv">
        <div class="messsages">
            <done_message :show.sync="done" placement="top-left" duration=3000 type="success" width="400px" dismissable>
                <span class="icon-ok-circled alert-icon-float-left"></span>
                <b>تم:</b>
                <p>
                    تم اضافة الخدمة الى المفضلة بنجاح

                </p>
            </done_message>

            <error_message :show.sync="err" placement="top-left" duration=3000 type="danger" width="400px" dismissable >
                <span class="icon-ok-circled alert-icon-float-left"></span>
                <b>خطأ</b>
                <p>
                    لا يمكنك طلب هذه الخدمة لأحد الأسباب التالية
                    <br/>
                    1-هذه الخدمة خاصة بك
                    <br/>
                    2-هذه الخدمة لديك بالفعل فى المفضلة
                    <br/>
                    3- هذه الخدمة غير موجودة
                </p>
            </error_message>
        </div>
    <button type="button" @click.prevent="AddFav()"  v-bind:disabled="disable" class="btn btn-danger">
        <i class="fa fa-heart"></i>
        أضف الى المفضلة
    </button>
</div>
</template>
<style>
    .bigdiv{
        display: inline-block;
    }
    .messsages{
        position: absolute;
        bottom:100px;
        right:20px;
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
        props:['service'],
        data: function () {
            return{
                err:false,
                done:false,
                disable:false
            }
        },
        methods:{
            AddFav: function () {
                this.disable=true;
                this.$http.get('/AddFav/'+this.service.id).then(function(res){

                    this.$parent.$parent.$emit('Add-To-Parent-Fav',res.body);
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
