<template>
     <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header pull-right">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <router-link class="navbar-brand pull-right" :to="{path:'/'}">
                خدمات ويب
            </router-link>
            <div class="form-inline search pull-right">
                <input type="text" class="form-control" placeholder="البحث"/>
                <button class="btn btn-info">
                    <i class="fa fa-search"></i>
                    ابحث</button>
            </div>


        </div>

        <div class="collapse navbar-collapse js-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown mega-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">الأقسام <span class="caret"></span></a>
                    <ul class="dropdown-menu mega-dropdown-menu col-lg-12">
                        <li class="col-sm-3 pull-right" v-for="c in cat">
                            <ul class="text-right">
                                <li>
                                    <router-link :to="{name:'/Cat',params:{cat_id:c.id,cat_name:c.name}}">
                                        {{c.name}}
                                    </router-link>

                                </li>

                            </ul>
                        </li>


                    </ul>

                </li>

            </ul>
            <ul class="nav navbar-nav navbar-left" v-if="!login">
                <!-- Authentication Links -->
                <li>
                    <a  href="/login" >
                        <i class="fa fa-user"></i>
                       تسجيل الدخول
                    </a>
                </li>
                <li>
                    <a  href="/register" >
                        <i class="fa fa-user-plus"></i>
                        عضوية جديدة
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-left" v-if="login">
                <!-- Authentication Links -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        <span class="hidden-lg hidden-md">الرسائل</span>
                        <i class="fa fa-envelope"></i>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <router-link :to="{path:'/GetMyRecievedMessages'}">
                                <i class="fa fa-mail-reply"></i>
                                الوارد
                            </router-link>

                        </li>
                        <li>
                            <router-link :to="{path:'/GetMySendMessages'}">
                                <i class="fa fa-mail-forward"></i>
                                الصادر
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{path:'/GetUnreadMessage'}">
                                <i class="fa fa-eye-slash"></i>
                                رسائل غير مقرءوة
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{path:'/GetReadMessage'}">
                                <i class="fa fa-eye"></i>
                                رسائل مقرءوة
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        <i class="fa fa-reorder"></i>  <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <router-link :to="{path:'/IncomeOrders'}">
                                <i class="fa fa-truck fa-lg"></i>
                                الطلبات الواردة
                            </router-link>

                        </li>
                        <li>
                            <router-link :to="{path:'/SendOrders'}">
                                <i class="fa fa-shopping-cart"></i>
                                طلبات المشتريات
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        <i class="fa fa-server"></i> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <router-link :to="{path:'/AddServices'}"><i class="fa fa-plus"></i>
                                اضافة خدمة</router-link>
                        </li>
                        <li>
                            <router-link :to="{path: '/MyServices'}">
                                <i class="fa fa-user"></i>
                                خدماتى
                            </router-link>


                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        <i class="fa fa-money"></i>  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <router-link :to="{path:'/AddCredit'}">
                                <i class="fa fa-plus"></i>
                                شحن الحساب
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{path:'/ShowAllCharge'}">
                                <i class="fa fa-plus"></i>
                                عمليات شحن الرصيد
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{path:'/ShowAllPay'}">
                                <i class="fa fa-minus"></i>
                                المدفوعات
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{path:'/Profit'}">
                                <i class="fa fa-briefcase"></i>
                                الأرباح
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{path:'/ProfitOrders'}">
                                <i class="fa fa-check"></i>
                                سحب الأرباح
                            </router-link>
                        </li>

                        <li>
                            <router-link :to="{path:'/Balance'}">
                                <i class="fa fa-money"></i>
                                رصيدى
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        <i class="fa fa-user"></i> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <i class="fa  fa-edit"></i>
                                تعديل بياناتى
                            </a>
                        </li>

                        <li>
                            <a href="/logout" >


                                <i class="fa fa-btn fa-sign-out"></i>
                                 تسجيل الخروج
                            </a>






                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" @click="getNotUser()" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"  >
                        <span class="fa fa-bell"></span>
                        <span class=" notNotification posNot">
                            {{note}}
                        </span>
                    </a>
                    <ul class="dropdown-menu" style="width: 250px !important;">
                     <li class="text-center" v-if="loadingNote">
                         <img v-bind:src="'images/tenor.gif'" />
                     </li>
                        <li class="text-right" v-for="n in notAll ">
                                     <not_list :n="n"></not_list>
                            <hr>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li >
                            <router-link :to="{path:'/Notification'}">
                                <i class="fa  fa-bell"></i>
                                كل التنبيهات
                            </router-link>
                        </li>

                    </ul>

                </li>
                <li>
                    <router-link :to="{path:'/GetMyFav'}">
                        <i class="fa fa-heart"></i>
                        <span class="not posNot">
                          {{fav}}
                         </span>
                        <span class="hidden-lg hidden-md">المفضلة</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{path:'/SendOrders'}">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="notOrder posNot">
                           {{orders}}
                        </span>
                        <span class="hidden-lg hidden-md">المشتريات</span>
                    </router-link>
                </li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div>
</nav>

</template>

<script>
    import NotesList from '../btns/note.vue';
    export default {

        components:{
            not_list:NotesList
        },
        data: function(){
          return{
              note:0,
              fav:0,
              orders:0,
              notAll:[],
              loadingNote:false,
              login:true,
              cat:[]
          }
        },
      mounted: function () {
            this.getAllInfo();

    },

        methods:{
          getAllInfo: function(){
           this.$http.get("/getAllInfo").then(function (res) {
               if(res.body["login"] == "errorLogin"){
                   this.login=false;

                   this.$parent.$emit("Auth",'false');
               }else{
                   this.$parent.$emit("Auth",'true');
                   this.note=res.body["note"];
                   this.fav=res.body["fav"];
                   this.orders=res.body["orders"];

               }
               this.cat=res.body["cat"];
           },function (res) {
               alert("خطأ رقم 1000");
           });
          },

            getNotUser: function () {
              this.loadingNote=true;
                this.$http.get("/getNotUser").then(function (res) {
                    this.loadingNote=false;
                    this.notAll=res.body["note"];
                    this.note=res.body["noteSum"];

                },function (res) {
                    alert("خطأ رقم 1001");
                });
            }
            
            
        }
    }
</script>
