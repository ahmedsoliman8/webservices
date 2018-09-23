<template>

         <span v-if="status == 0">
               <span class="label label-info"> طلب جديد</span>
               </span>
        <span v-else-if="status == 1">
               <span class="label label-info"> طلب قديم</span>
               </span>
        <span v-else-if="status === 2">
               <span class="label label-warning"> طلب قيد التنفيذ</span>
               </span>
        <span v-else-if="status == 3">
               <span class="label label-danger">طلب ملغى</span>
               </span>
        <span v-else="status == 4">
               <span class="label label-success"> طلب منتهى</span>
               </span>


</template>

<script>
    export default {

        props:['status']

    }
</script>
