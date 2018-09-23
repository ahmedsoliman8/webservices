<template>
    <div>
    <div v-if="this.order.status !== 3">
        <add_comment :order="order"></add_comment>
    </div>

    <hr>
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 pull-right ">
                            <h1>
                                التعليقات
                                ({{comments.length}})
                            </h1>

                        </div>
                        <div class="col-md-3   col-xs-12 pull-left" style="margin-top:22px">
                            <input type="text" placeholder="ابحث باسم العضو" v-model="commentSearch"   class="form-control">
                        </div>
                        <div class="col-md-3 col-xs-12 pull-left" style="margin-top:22px">
                            <div class="btn-group">
                                <button class="btn btn-info" @click="orderedComments('created_at')">
                                    التاريخ
                                </button>
                                <button class="btn btn-info" @click="orderedComments('id')">
                                    المضاف اخيرا
                                </button>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <hr>

                    <div v-if="comments.length>0">
                        <section v-for="(comment,index) in comments" class="comment-list">
                            <!-- First Comment -->
                            <article class="row">
                                <div class=" col-xs-2  pull-right">
                                    <figure style="padding-bottom: 20px;">
                                        <img class="img-responsive" src="https://images.vexels.com/media/users/3/129616/isolated/preview/fb517f8913bd99cd48ef00facb4a67c0-el-hombre-de-negocios-silueta-avatar-by-vexels.png" />

                                    </figure>
                                </div>
                                <div class="col-xs-10 pull-left">
                                    <div class="panel panel-default arrow ">
                                        <div class="panel-body">
                                            <header class="text-right clearfix">
                                                <div class="comment-user pull-right">
                                                    #{{index+1}}
                                                    <router-link :to="{name:'/User',params:{user_id:comment.user.id,username:comment.user.name}}">

                                                        <i class="fa fa-user "></i>
                                                        {{comment.user.name}}
                                                    </router-link>

                                                </div>
                                                <time class="comment-date pull-left" datetime="16-12-2014 01:05">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{comment.created_at}}
                                                </time>
                                            </header>
                                            <div class="comment-post">
                                                <p>
                                                 {{comment.comment}}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </article>

                        </section>
                    </div>
                    <div v-else>
                    <div class="alert alert-warning">
                        <b>عفوا:</b>
                        <p>لايوجد اى تعليقات حاليا</p>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import  AddComment from '../comment/addcomment.vue';

    export default {
        components:{
            add_comment:AddComment
        },
        props:['order'],
        data: function(){
            return{
                comments:[],
                id:true,
                commentSearch:"",
                filteredComments:[],
                created_at:true,
                showAddComment:true
            }
        },

        mounted: function () {
        this.getAllComment();

        },
        created: function() {
            this.$on('Add-New-Comment',this.AddNewComment);

        },
        methods:{
            getAllComment: function () {
                this.$http.get('/getAllComment/'+this.order.id).then(function(res){
                this.comments=res.body;
                    this.filteredComments=res.body;

                },function(res){

                });
            },
            AddNewComment:function(val){

            this.comments.push(val);
            },
            orderedComments: function (valueOrder) {
                if (valueOrder === 'id') {
                         if(this.id===false){
                             this.comments = _.orderBy(this.comments, valueOrder,'desc');
                             this.id=true;
                         }else{
                             this.comments = _.orderBy(this.comments, valueOrder,'asc');
                             this.id=false;
                         }

                } else if (valueOrder === 'created_at') {
                    if(this.created_at===false){
                        this.comments = _.orderBy(this.comments, valueOrder,'desc');
                        this.created_at=true;
                    }else{
                        this.comments = _.orderBy(this.comments, valueOrder,'asc');
                        this.created_at=false;
                    }

                }

                return this.comments;

            }
        },
        watch: {
            commentSearch: function (val, oldVal) {
                this.comments = this.filteredComments;
                this.comments = this.comments.filter(function (comment) {
                    const searchRegex = new RegExp(val, 'i');
                    return (
                        searchRegex.test(comment.user.name)
                    )
                })
            }
        }


    }
</script>
