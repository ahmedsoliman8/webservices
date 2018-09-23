<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\AddNewComment;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   public  function addNewComment(AddNewComment $request){
          $user=Auth::user();
          $order=Order::findOrfail($request->order_id);

          if($order){

              if($user->id == $order->user_id || $user->id == $order->user_order){
                  $comment=new Comment();
                  $comment->user_id=$user->id;
                  $comment->comment= strip_tags($request->comment);
                  $comment->order_id=intval($order->id);
                  if($comment->save()){
                      if($user->id == $order->user_id){
                          // comment by user who add the service
                          makeNewNotification($order->user_order,$user->id,"AddNewComment",$order->id);
                      }else{
                          makeNewNotification($order->user_id,$user->id,"AddNewComment",$order->id);
                      }

                      return Comment::where('id',$comment->id)->with('user')->get()[0];
                  }
                  abort(403);
              }
              abort(403);

          }
       abort(403);
       return false;
   }

   public  function getAllComment($order_id){
     return Comment::where('order_id',$order_id)->with('user')->orderBy('id','desc')->get();
   }
}
