<template>
    <div class="col-xs-12 col-md-10 pull-left">

        <div v-if="type=='send'" >
            <ol class="breadcrumb">
                <li> <router-link :to="{name:'/GetMySendMessages'}">الصادر </router-link></li>
                <li class="active">{{messagesList.length}}</li>
            </ol>
        </div>
        <div v-else-if="type=='income'">
            <ol class="breadcrumb">
                <li>  <router-link :to="{name:'/GetMyRecievedMessages'}">الوارد</router-link></li>
                <li class="active">{{messagesList.length}}</li>
            </ol>
        </div>
        <div v-else-if="type=='new'">
            <ol class="breadcrumb">
                <li>  <router-link :to="{name:'/GetUnreadMessage'}">رسائل غير مقرءوة</router-link></li>
                <li class="active">{{messagesList.length}}</li>
            </ol>
        </div>
        <div v-else>
            <ol class="breadcrumb">
                <li>  <router-link :to="{name:'/GetReadMessage'}">رسائل  مقرءوة</router-link></li>
                <li class="active">{{messagesList.length}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12 pull-right">
                <div class="btn-group">
                    <button class="btn btn-info" @click="orderedMessages('created_at')">
                        على حسب التاريخ
                    </button>
                </div>
            </div>
            <div class="col-lg-4   col-sm-12 pull-left ">
                <input type="text" placeholder="ابحث بعنوان الرسالة"  v-model="messageSearch"  class="form-control">
            </div>
            <div class="clearfix"></div>
        </div>
        <br/>

       <table class="table table-striped table-responsive">
           <thead>
           <tr>
               <th>
                   <span v-if="type=='send'">
                       اسم المرسل إليه
                   </span>
                   <span v-else>
                       اسم المرسل
                   </span>
               </th>
               <th>عنوان الرسالة</th>
               <th>أرسلت فى</th>
               <th>الحالة</th>
               <th>مشاهدة</th>
           </tr>
           </thead>
           <tbody v-if="messagesList.length > 0">
           <tr v-for="message in  messagesListNew">
               <td>    <span v-if="message.get_recieved_user">
                      <router-link :to="{name:'/User',params:{user_id:message.get_recieved_user.id,username:message.get_recieved_user.name}}">
                         {{message.get_recieved_user.name}}
                      </router-link>

                </span>
                   <span v-else>
                    <router-link :to="{name:'/User',params:{user_id:message.get_send_user.id,username:message.get_send_user.name}}">
                           {{message.get_send_user.name}}
                    </router-link>

                </span>
               </td>
               <td>
                   {{message.title}}
               </td>
               <td>{{message.created_at}}</td>
               <td>
                   <span v-if="message.seen==1" class="label label-success">
                  <i class="fa fa-eye"></i>
                   </span>
                   <span v-else class="label label-danger">
                  <i class="fa fa-eye"></i>
                   </span>
               </td>
               <td>
                   <router-link :to="{name:'/GetThisMessageDetails',params:{message_id:message.id,view_type:type}}" class="btn btn-info">
                      مشاهدة
                   </router-link>

                   <span v-if="type=='income' || type=='new' || type=='read'">
                    <router-link :to="{name:'/SendMessage',params:{user_id:message.get_send_user.id}}" class="btn btn-warning">
                     <i class="fa fa-send"></i>
                   </router-link>
                   </span>
                   <span v-else>
                        <router-link :to="{name:'/SendMessage',params:{user_id:message.get_recieved_user.id}}" class="btn btn-warning">
                     <i class="fa fa-send"></i>
                   </router-link>
                   </span>

               </td>
           </tr>
           </tbody>
           <tbody v-else>
           <tr>
               <td colspan="6">لا يوجود اى رسائل حتى الان</td>
           </tr>
           </tbody>
       </table>


    </div>

</template>
<style>
    th{
        text-align: right;
    }
</style>

<script>
    export default {
        props: {messagesList: {type: Array}, type: {type: String}},
        data: function () {
            return {
                created_at: false,
                messagesListNew: this.messagesList,
                messageSearch: "",
                seen:false

            }

        },
        methods: {
            orderedMessages: function (valueOrder) {
                if (valueOrder === 'created_at') {
                    if (this.created_at === true) {
                        this.messagesListNew = _.orderBy(this.messagesListNew, valueOrder, 'desc');
                        this.created_at = false;
                    } else {

                        this.messagesListNew = _.orderBy(this.messagesListNew, valueOrder, 'asc');
                        this.created_at = true;
                    }
                }

            }
        },
        watch: {
            messageSearch: function (val, oldVal) {
                this.messagesListNew = this.messagesList;
                this.messagesListNew = this.messagesListNew.filter(function (message) {
                    const searchRegex = new RegExp(val, 'i');
                    return (
                        searchRegex.test(message.title)
                    )
                })
            }
        }
    }
</script>
