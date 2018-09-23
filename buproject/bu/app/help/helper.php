<?php

 function getSetting($settingname = 'sitename'){
   return \App\SiteSetting::where('namesetting',$settingname)->get()[0]->value;
 }

 function checkIfImageIsexist($imageName,$pathImage='/public/website/thumb/',$url='/website/thumb/'){
     if ($imageName != ''){
         $path=base_path().$pathImage.$imageName;
         if (file_exists($path)) {
             return Request::root() . $url. $imageName;
         }
     }
    else {
        return getSetting('no_image');
    }

 }
 function uploadImage($buRequest,$path='/public/website/buImages/',$width='500',$height='362',$deleteFileWithName){
     if($deleteFileWithName != ''){
         deleteimage(base_path().$path.$deleteFileWithName);
     }
     $fileName=$buRequest->getClientOriginalName();

     $buRequest->move(
         base_path().$path,$fileName
     );
     if($width=='500'&&$height=='362'){
         $thumbPath=base_path().'/public/website/thumb/';
         $thumbPathNew=$thumbPath.$fileName;
         \Intervention\Image\Facades\Image::make(base_path().$path.'/'.$fileName)->resize('500','362')->save($thumbPathNew);
         if($deleteFileWithName != ''){
             deleteimage($thumbPath.$deleteFileWithName);
         }
     }

     return $fileName;
 }
 function deleteimage($deleteFileWithName){
         if(file_exists($deleteFileWithName)){
             \Illuminate\Support\Facades\File::delete($deleteFileWithName);
     }
 }

 function setActive($array,$class="active"){
     if(!empty($array)){
         $seg_array=[];
         foreach ($array as $key => $url){
         if(\Illuminate\Support\Facades\Request::segment($key+1)==$url){
             $seg_array[]=$key;
         }
         }
         if(count($seg_array)==count(\Illuminate\Support\Facades\Request::segments())){
             if(isset($seg_array[0])){
                 return $class;
             }

         }
     }

 }

 function bu_type(){
     $array=[
       'شقة',
       'فيلا',
       'شالية'
     ];
     return $array;
 }
 function bu_rent(){
     $array=[
         'تمليك',
         'إيجار'

     ];
     return $array;
 }

function bu_status(){
    $array=[
        'غير مفعل',
        'مفعل'

    ];
    return $array;
}

function roomnumber(){
     $array=[];
   for ($i=2;$i<=40;$i++){
       $array[$i]=$i;
   }
    return $array;

}
function searchnameFiled(){
     return[
       'bu_price' => 'سعر العقار',
       'bu_place' => 'منطقة العقار',
       'bu_room' => 'عدد الغرف',
       'bu_type' => 'نوع العقار',
       'bu_rent' => 'نوع العملية',
       'bu_square'=> 'المساحة',
       'bu_price_from' => 'السعر من',
       'bu_price_to' => 'السعر إلى',
     ];
}

 function contact(){
     return[
       '1' => 'إعجاب',
       '2' => 'مشكلة',
       '3' => 'اقتراح',
       '4' => 'استفسار',
     ];
}

function bu_place(){
     return[
    "0"=>"القاهرة الجديدة - التجمع الخامس",
    "1"=>"6 أكتوبر",
    "2"=>"مدينة الشيخ زايد",
    "3"=>"مصر الجديدة",
    "4"=>"مدينة نصر",
    "5"=>"المعادي",
    "6"=>"الشروق وهليوبليس الجديدة",
    "7"=>"العبور",
    "9"=>"الرحاب ومدينتي",
    "10"=>"فيصل",
    "11"=>"طريق اسكندرية الصحراوي",
    "12"=>"الزمالك",
    "13"=>"المهندسين",
    "14"=>"الدقي",
    "15"=>"الهرم",
    "16"=>"حي الجيزة",
    "17"=>"المقطم",
    "18"=>"حلوان",
    "19"=>"عين شمس",
    "20"=>"مدينة بدر",
    "21"=>"العاشر من رمضان",
    "22"=>"جاردن سيتي",
    "23"=>"وسط البلد",
    "24"=>"الزيتون",
    "25"=>"حدائق القبة",
    "26"=>"حدائق الاهرام",
    "27"=>"شبرا",
    "28"=>"إمبابة",
    "29"=>"العجوزة",
    "30"=>"المنيل",
    "31"=>"العباسية",
    "32"=>"15 مايو",
    "33"=>"أحياء أخرى",
    "34"=>"المطرية",
    "35"=>"العاصمة الإدارية الجديدة",
    "36"=>"سموحة",
    "37"=>"رشدي",
    "38"=>"سان استيفانو",
    "39"=>"ميامي",
    "40"=>"كفر عبده",
    "41"=>"سيدي جابر",
    "42"=>"لوران",
    "43"=>"فيكتوريا",
    "44"=>"سيدي بشر ",
    "45"=>"الهانوفيل",
    "46"=>"برج العرب",
    "47"=>"البيطاش",
    "48"=>"كامب شيزار",
    "49"=>"السيوف ",
    "50"=>"جليم",
    "51"=>"أبوقير",
    "52"=>"المندرة",
    "53"=>"العصافرة",
    "54"=>"محرم بك",
    "55"=>"الإبراهيمية",
    "56"=>"فلمنج",
    "57"=>"ستانلي",
    "58"=>"بولكلي",
    "59"=>"زيزينيا",
    "60"=>"باكوس",
    "61"=>"جناكليس",
    "62"=>"المعمورة",
    "63"=>"سبورتنج",
    "64"=>"سابا باشا",
    "65"=>"الحضرة",
    "66"=>"الشاطبي",
    "67"=>"كينج مريوط",
    "68"=>"كليوباترا",
    "69"=>"المنشية",
    "70"=>"بحرى - الأنفوشى",
    "71"=>"المنتزه",
    "72"=>"العامرية",
    "73"=>"شاطئ النخيل - ٦ اكتوبر",
    "74"=>"أبو يوسف ",
    "75"=>"أبو تلات",
    "76"=>"أحياء أخرى",];
}

function unreadMessage(){
     return \App\ContactUs::where('view',0)->get();
}

function countunreadMessage(){
    return \App\ContactUs::where('view',0)->count();
}

function buforusercount($status,$user_id){
return \App\bu::where('bu_status',$status)->where('user_id',$user_id)->count();
}

function countAllBuAppendToStatus($status){
    return \App\bu::where('bu_status',$status)->count();

}





