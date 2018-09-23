<template>
    <div class="notallli">
      <span v-if="n.type == 'ReciveOrder'">

                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-arrow-down"></i>
                                تم استقبال طلب شراء رقم الطلب #
                                {{n.notify_id}}
                                من العضو
                                {{n.user.name}}
                            </router-link>
                        </span>

    <span v-else-if="n.type =='CompleteOrder'">

                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
                                قام العضو
                                {{n.user.name}}
                                ب انهاء الطلب رقم
                                {{n.notify_id}}
                                برجاء مراجعة ارباحك الأن
                            </router-link>
                        </span>

    <span v-else-if=" n.type =='RejectOrder'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-close"></i>
                                قام العضو
                                {{n.user.name}}
                                برفض الطلب الخاص بك برقم
                                {{n.notify_id}}
                            </router-link>
                        </span>
    <span v-else-if="n.type =='DoneOrder'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
                                قام العضو
                                {{n.user.name}}
                                بالموافقة على تنفيذ طلبك برقم
                                {{n.notify_id}}
                            </router-link>
                        </span>
    <span v-else-if="n.type == 'ReciveMessage'">
                            <router-link :to="{name:'/GetThisMessageDetails', params:{message_id:n.notify_id,view_type:'income'}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                <i class="fa fa-envelope"></i>
                                العضو
                                {{n.user.name}}
                                قام بارسال رسالة

                            </router-link>
                        </span>

    <span v-else-if="n.type == 'AddNewComment'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                    <i class="fa fa-comment"></i>
                                قام العضو
                                {{n.user.name}}
                                بالتعليق على الطلب
                                {{n.notify_id}}

                            </router-link>
                        </span>
        <span v-else-if=" n.type =='AdminAcceptServices'">
                            <router-link :to="{name:'/ServiceDetails', params:{services_id:n.notify_id,services_name:''}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
                                قام الادارة بالموافقة على الخدمة رقم
                                {{n.notify_id}}

                            </router-link>
                        </span>
                        <span v-else-if=" n.type =='AdminRejectServices'">
                            <router-link :to="{name:'/ServiceDetails', params:{services_id:n.notify_id,services_name:''}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-close"></i>
                                قامت الادارة برفض الخدمة رقم
                                {{n.notify_id}}

                            </router-link>
                        </span>
                           <span v-else-if="n.type =='AdminMakeNew'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
                                قامت الادارة بتحويل الطلب رقم
                                #{{n.notify_id}}
                                الى طلب جديد
                            </router-link>
                        </span>
                        <span v-else-if="n.type =='AdminMakeOld'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
                               قامت الادارة بتحويل الطلب رقم
                                #{{n.notify_id}}
                                الى طلب قديم
                            </router-link>
                        </span>
                         <span v-else-if="n.type =='AdminAcceptOrder'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
                              قامت الإدارة بالموافقة على الطلب رقم
                              #{{n.notify_id}}

                            </router-link>
                        </span>
                         <span v-else-if="n.type =='AdminRejectOrder'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
               قامت الإدارة برفض الطلب رقم
                                #{{n.notify_id}}

                            </router-link>
                        </span>
                         <span v-else-if="n.type =='AdminCloseOrder'">
                            <router-link :to="{name:'/Order', params:{order_id:n.notify_id}}" v-bind:class="n.seen == 0 ? 'notActive' : ''">
                                 <i class="fa fa-check"></i>
               قامت الإدارة بانهاء الطلب رقم
                                #{{n.notify_id}}
                            </router-link>
                        </span>
    </div>
</template>

<script>
    export default {
       props:["n"]
    }
</script>
