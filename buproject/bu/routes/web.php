<?php

Route::group(['middleware' => ['web','admin']],function(){
//Datatable Ajax
Route::get('/adminpanel/users/data',['as' => 'adminpanel.users.data','uses'=>'UsersController@anyData']);
Route::get('/adminpanel/bu/data',['as' => 'adminpanel.bu.data','uses'=>'BuController@anyData']);

Route::get('/adminpanel/contact/data',['as' => 'adminpanel.contact.data','uses'=>'ContactController@anyData']);

//user
Route::get('/adminpanel','AdminController@index');
Route::resource('/adminpanel/users','UsersController');
Route::get('//adminpanel/users/{id}/delete','UsersController@destory');
Route::post('/adminpanel/user/changePassword','UsersController@updatePassword');



//SettingSite
Route::get('/adminpanel/sitesetting','SiteSettingController@index');
Route::post('/adminpanel/sitesetting','SiteSettingController@store');

//users
 Route::resource('/adminpanel/bu','BuController',['except' => ['index','show']]);
 Route::get('/adminpanel/bu/{id?}','BuController@index');
 Route::get('/adminpanel/changeStatus/{id}/{status}','BuController@changeStatus');
 Route::get('/adminpanel/bu/{id}/delete','BuController@destory');




    //Message
    Route::resource('/adminpanel/contact','ContactController');
    Route::get('/adminpanel/contact/{id}/delete','ContactController@destory');

    //Statics
     Route::get('/adminpanel/buYear/statics','AdminController@showYearStatics');
    Route::post('/adminpanel/buYear/statics','AdminController@showThisYear');






});






Route::get('/user/create/building','BuController@userAddView');
Route::post('/user/create/building','BuController@userStore');

Route::get('/', function () {
    return view('welcome');
});
/* admin route */








/* user route */
Auth::routes();

Route::get('/ShowAllBuilding','BuController@showAllEnabel');
Route::get('/ForRent','BuController@ForRent');
Route::get('/ForBuy','BuController@ForBuy');
Route::get('/type/{type}','BuController@showByType');
Route::get('search','BuController@search');
Route::get('/singleBuilding/{id}','BuController@Showsingle');
Route::get('/ajax/bu/information','BuController@getAjaxInfo');
Route::get('/contact','HomeController@contact');
Route::post('/contact','ContactController@store');

Route::get('/user/buildingShow','BuController@showUserBuilding')->middleware('auth');
Route::get('/user/buildingShowWaiting','BuController@buildingShowWaiting')->middleware('auth');
Route::get('/user/editSetting','UsersController@userEditInfo')->middleware('auth');
Route::patch('/user/editSetting',['as'=>'user.editSetting','uses'=>'UsersController@userUpdateProfile'])->middleware('auth');

Route::post('/user/changePassword','UsersController@changePassword')->middleware('auth');

Route::get('/user/edit/building/{id}','BuController@userEditBuilding')->middleware('auth');

Route::patch('/user/update/building','BuController@userUpdateBuilding')->middleware('auth');



Route::get('/home', 'HomeController@index')->name('home');
