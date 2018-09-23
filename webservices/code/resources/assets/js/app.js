
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

 window.Vue = require('vue');
window.VueRouter=require('vue-router').default;
Vue.use(VueRouter);
window.VueResource=require('vue-resource');
Vue.use(VueResource);
Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/** Services**/
const AddServices=require('./components/services/addservices.vue');
const MyServices=require('./components/services/myservices.vue');
const ServiceDetails=require('./components/services/service_details.vue');

/** Users **/
const UserServices=require('./components/users/userservices.vue');
/** Orders **/
const IncomeOrders=require('./components/orders/incomeorders.vue');
const SendOrders=require('./components/orders/sendorders.vue');

const SingleOrder=require('./components/orders/singleorder.vue');

/**  Messages**/
const SendMessage=require('./components/Messages/send.vue');
const  GetMySendMessagesNow=require('./components/Messages/sendmessage.vue');
const GetMyRecievedMessagesNow=require('./components/Messages/incomemessage.vue');
const GetThisMessageDetailsByID=require('./components/Messages/messagesdetails.vue');
const  GetUnreadMessageAll=require('./components/Messages/newmessage.vue');

const  GetReadMessageAll=require('./components/Messages/readmessage.vue');
/**  Fav**/
const  GetMyFavAll=require('./components/fav/getall.vue');

/**  Main**/

const mainPage=require('./components/pages/mainpage.vue');

/** Cat **/
const Cat=require('./components/cat/cat.vue');

/** Credit **/
const AddNewCredit = require('./components/credit/add.vue');

const AllCharge=require('./components/credit/allcharge.vue');

const  AllPay=require('./components/credit/allpay.vue');

const AllProfit=require('./components/credit/allprofit.vue');

const BalanceAll=require('./components/credit/balance.vue');

const AllNotification=require('./components/notification/all.vue');

const LoginRequired=require('./components/error/login.vue');
const ProfitOrdersAll=require('./components/credit/profitorders.vue');

const router= new VueRouter({
   routes:[
       {
           path: '/',
           component:mainPage
       },
       {
           path: '/AddServices',
           component:AddServices,


       },
       {
           path: '/MyServices',
           component:MyServices
       },
       {
           path: '/IncomeOrders',
           component:IncomeOrders
       },
       {
           path: '/SendOrders',
           component:SendOrders
       },
       {
           path: '/ServiceDetails/:services_id/:services_name',
           name:'/ServiceDetails',
           component:ServiceDetails

       },
       {
           path: '/User/:user_id/:username',
           name:'/User',
           component:UserServices

       },
       {
           path: '/Order/:order_id',
           name: '/Order',
           component:SingleOrder
       }
       ,
       {
           path: '/SendMessage/:user_id',
           name: '/SendMessage',
           component:SendMessage
       },
       {
           path:'/GetMySendMessages',
           name:'/GetMySendMessages',
           component:GetMySendMessagesNow
       },
       {
           path:'/GetMyRecievedMessages',
           name:'/GetMyRecievedMessages',
           component:GetMyRecievedMessagesNow
       },
       {
           path:'/GetThisMessageDetails/:message_id/:view_type',
           name:'/GetThisMessageDetails',
           component:GetThisMessageDetailsByID
       },
       {
           path:'/GetUnreadMessage',
           name:'/GetUnreadMessage',
           component:GetUnreadMessageAll
       },
       {
           path:'/GetReadMessage',
           name:'/GetReadMessage',
           component:GetReadMessageAll
       },
       {
           path:'/GetMyFav',
           name:'/GetMyFav',
           component:GetMyFavAll
       },
       {
           path:'/Cat/:cat_id/:cat_name',
           name:'/Cat',
           component:Cat
       },
       {
           path:'/AddCredit',
           component:AddNewCredit
       },
       {
           path:'/ShowAllCharge',
           component:AllCharge
       },
       {
           path:'/ShowAllPay',
           component:AllPay
       },
       {
           path:'/Profit',
           component:AllProfit
       },
       {
           path:'/Balance',
           component:BalanceAll
       },
       {
           path:'/Notification',
           component:AllNotification
       },
       {
           path:'/loginRequire',
           component:LoginRequired
       },
       {
       path:'/ProfitOrders',
       component:ProfitOrdersAll
       }













   ]

});

const app = new Vue({ router }).$mount('#app');













