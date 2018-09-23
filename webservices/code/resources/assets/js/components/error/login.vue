<template>
    <div>
        <header_nav></header_nav>
        <div class="container">
         <div>
             <h1>خطا فى التصريح</h1>
             <div class="alert alert-danger">
                 <b>خطأ:</b>
                 <span>لا تملك التصريح للدخول الى هذه الصفحة</span>
                 <a href="/login"> <i class="fa fa-user"></i>   تسجيل الدخول </a>
                 <a href="/register"> <i class="fa fa-user-plus"></i>   تسجيل عضوية جديدة</a>
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
        }
    }
</script>
