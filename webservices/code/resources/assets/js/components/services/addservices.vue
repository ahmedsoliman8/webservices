<template>
    <div >
        <header_nav></header_nav>
        <div class="container">
 <div class="row">
     <span v-if="messages.length >0">
         <div class="alert alert-danger">
             <b>خطأ</b>
             <ol>
              <li v-for="message in messages[0]">
         {{message[0] }}
         </li>
             </ol>
         </div>

     </span>
<div class="form-group">
    <label for="name">
        اسم الخدمة
    </label>
    <input type="text" name="name" id="name" v-model="name" class="form-control"/>
</div>
     <div class="form-group">
         <label for="file">
             صورة الخدمة
         </label>
         <input type="file" ref="image" />
         <span class="help-block">
             يجب أن تكون الصورة أكثر من 300 بكسل طول وعرض وأق من 1000 بكسل طول وعرض
         </span>
     </div>

    <div class="form-group">
        <label for="des">
            وصف الخدمة
        </label>
        <textarea name="des" rows="10" id="des" v-model="des" class="form-control"> </textarea>
    </div>
    <div class="form-group">
        <label for="cat_id">
            القسم
        </label>
        <select  v-model="cat_id" class="form-control">
        <option value="1">القسم الأول</option>
        </select>
    </div>

    <div class="form-group">
        <label for="name">
            السعر
        </label>
        <select  v-model="price" class="form-control">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" @click="AddThisServices()" value="اضف الخدمة" class="btn btn-default"/>
    </div>

 </div>
        </div>
    </div>
</template>

<script>
    import  HeaderNav from '../layout/header.vue';
    export default {
        components:{
            header_nav:HeaderNav
        },
 data: function () {
     return{
         name:"",
         des:"",
         cat_id:"",
         price:"",
         messages:[],

     }
 },
        created:function(){
            this.$on("Auth",this.Auth);
        },
        mounted: function(){

        },
        methods:{
            AddThisServices: function(){
             const formdata=new FormData();
             formdata.append('name',this.name);
             formdata.append('des',this.des);
             formdata.append('cat_id',this.cat_id);
             formdata.append('price',this.price);
             formdata.append('image',this.$refs.image.files[0]);
             this.sendData(formdata);
            },
            sendData: function(formdata){
                this.$http.post('/addServices',formdata).then(function(res){

                if(res.body == 'done'){
                    this.name='';
                    this.des='';
                    this.price='';
                    this.cat_id='';
                    this.messages=[];

                alert('تم اضافتك خدمتك بنجاح جارى انتظار الموافقة عليها من الادارة');
                }
                else if(res.body=='checkpricefile'){
                    alert('من فضلك عدم تغيير المدخلات');
                }
                else{
                    alert('خطأ غير معروف برجاء الاتصال بالادارة');
                    }

                },function(res){
                   this.messages=[];
                  this.messages.push(res.body.errors);
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

