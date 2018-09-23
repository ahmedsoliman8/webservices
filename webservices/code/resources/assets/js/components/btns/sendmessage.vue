<template>
    <router-link  class="btn btn-info" :to="{name:'/SendMessage',params:{user_id:user.id}}">
        <i class="fa fa-send"></i>
        ارسال رسالة
        {{user.name}}
    </router-link>
</template>

<script>
    export default {
        props:['user']
    }
</script>
