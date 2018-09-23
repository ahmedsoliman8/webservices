<template>
<div>
    <router-link :to="{name:'/User',params:{user_id: service.user.id,username: service.user.name}}">
        <i class="fa fa-user"></i>
        {{service.user.name}}
    </router-link>
    <br/>

    <send_message :user="service.user"></send_message>
    <br/>
    <ul v-if="sideBarSection2" class="list-group" style="padding:0px">
        <li class="list-group-item active">
            <h5>
                <i class="fa fa-heart"></i>
                اخترنالك
            </h5>
        </li>
        <li v-for="section2 in sideBarSection2" class="list-group-item">
            <div class="row">
                <div class="col-lg-12">
                    <router-link  :to="{name:'/ServiceDetails',params:{services_id: section2.id,services_name: section2.name}}">
                        <span> {{section2.name}}</span>
                    </router-link>
                </div>
            </div>
        </li>
    </ul>



    <ul class="list-group" style="padding: 0px">
        <li class="list-group-item active"> <h5>
            <i class="fa fa-star"></i>
            الأكثر تقيما
        </h5></li>
        <li v-for="vote in mostVoted" class="list-group-item">
            <div class="row">
                <div class="col-lg-12">
                    <router-link  :to="{name:'/ServiceDetails',params:{services_id: vote.id,services_name: vote.name}}">
                        <span class="pull-right"> {{vote.name}}</span>
                        <span class="label label-info pull-left"><i class="fa fa-star"></i>{{vote.vote_sum}}</span>
                    </router-link>
                </div>

            </div>


        </li>
    </ul>


    <ul class="list-group" style="padding: 0px">
        <li class="list-group-item active">
            <h5>
                <i class="fa fa-eye"></i>
                الأكثر مشاهدة
            </h5>
        </li>
        <li v-for="view in mostViewed" class="list-group-item">
            <div class="row">
            <div class="col-lg-12">
                <router-link  :to="{name:'/ServiceDetails',params:{services_id: view.id,services_name: view.name}}">
                    <span class="pull-right"> {{view.name}}</span>
                    <span class="label label-warning pull-left"><i class="fa fa-eye"></i>{{view.view_count}}</span>
                </router-link>
            </div>
           </div>


        </li>
    </ul>

</div>
</template>

<script>
    import SendMessage from '../btns/sendmessage';
    export default {
      components:{
          send_message:SendMessage
      },
      props:['service','mostVoted','mostViewed','sideBarSection2']
    }
</script>