<template>
    <div class="product-rating pull-right">
    <div class="rating" v-if="rating">
        <input type="radio" id="star5" name="rating" value="5" @click.prevent="AddRate(5)" /><label for="star5" title="Rocks!">5 stars</label>
        <input type="radio" id="star4" name="rating" value="4" @click.prevent="AddRate(4)" /><label for="star4" title="Pretty good">4 stars</label>
        <input type="radio" id="star3" name="rating" value="3"  @click.prevent="AddRate(3)"/><label for="star3" title="Meh">3 stars</label>
        <input type="radio" id="star2" name="rating" value="2" @click.prevent="AddRate(2)" /><label for="star2" title="Kinda bad">2 stars</label>
        <input type="radio" id="star1" name="rating" value="1" @click.prevent="AddRate(1)"/><label for="star1" title="Sucks big time">1 star</label>
    </div>
    <div class="rating" v-if="!rating">
        <label v-for="n in ratingValue" class="fa fa-user RatingStyleActive"></label>
    </div>
        <div class="rating" v-if="err">
            <div class="alert alert-danger" style="font-size: 14px;">
                <b>خطأ</b>
                <span>لايمكنك اضافة تقييم لهذه الخدمة</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    props:['service'],
    data: function(){
      return{
          rating:true,
          ratingValue:"",
          err:false
      }
    },
     mounted: function () {
        /*
         const  service_id=this.service.id;
         const RateEle=$('#example');
         RateEle.barrating({
                 theme: 'fontawesome-stars',
                 onSelect:function(value, text, event){
                 event.preventDefault();
                     RateEle.barrating('readonly', true);
               const request=$.ajax({
                   url:'addNewVote/'+value+'/'+service_id,
                   method:"Get",

               });
               request.done(function (msg) {

               });
               request.fail(function (jqXHR, textStatus) {
                   alert("لا يمكنك اضافة تقيم للخدمة");
                   $('.product-rating').css('display','none');
                 });



                 }
             });
   */
     },
        methods:{
            AddRate:function (val) {
                this.$http.get('/addNewVote/'+val+'/'+this.service.id).then(function(res){
                    this.rating=false;
                    this.ratingValue=val;
                    this.$parent.$emit('Add-New-Rate',val);
                },function(res){
                    this.rating=false;
                      this.err=true;

                });
            }
        }
    }
</script>
