

@foreach(getAllNotificationObjects(\Illuminate\Support\Facades\Auth::user()->id) as $note )
<li>
    @if( $note->type == 'ReciveOrder' )
   <router-link :to="{name:'/Order', params:{order_id:{{$note->notify_id}}}}">
         تم استقبال طلب شراء رقم الطلب #
        {{$note->notify_id}}
       من العضو
       {{$note->user->name}}
   </router-link>
   @elseif($note->type =='CompleteOrder')
        <router-link :to="{name:'/Order', params:{order_id:{{$note->notify_id}}}}">
            قام العضو
            {{$note->user->name}}
            ب انهاء الطلب رقم
            {{$note->notify_id}}
            برجاء مراجعة ارباحك الأن
        </router-link>
    @elseif($note->type =='RejectOrder')
        <router-link :to="{name:'/Order', params:{order_id:{{$note->notify_id}}}}">
            قام العضو
            {{$note->user->name}}
            برفض الطلب الخاص بك برقم
            {{$note->notify_id}}
        </router-link>
    @elseif($note->type =='DoneOrder')
        <router-link :to="{name:'/Order', params:{order_id:{{$note->notify_id}}}}">
            قام العضو
            {{$note->user->name}}
            بالموافقة على تنفيذ طلبك برقم
            {{$note->notify_id}}
        </router-link>
    @elseif($note->type == 'ReciveMessage' )
        <router-link :to="{name:'/GetThisMessageDetails', params:{message_id:{{$note->notify_id}},view_type:'income'}}">
            العضو
            {{$note->user->name}}
            قام بارسال رسالة

        </router-link>
    @elseif($note->type == 'AddNewComment' )
        <router-link :to="{name:'/Order', params:{order_id:{{$note->notify_id}}}}">
            قام العضو
            {{$note->user->name}}
            بالتعليق على الطلب
            {{$note->notify_id}}

        </router-link>
    @endif


</li>
@endforeach