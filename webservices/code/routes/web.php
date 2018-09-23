<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin','middleware' => 'admin'], function () {
         Route::get("/","AdminController@index");
         Route::get("/services/{status?}","AdminServicesController@index");
         Route::post("/services","AdminServicesController@search");
         Route::get("/acceptservice/{service_id}/{status}","AdminServicesController@acceptService");
         Route::get("services/delete/{service_id}","AdminServicesController@delete");
         //   Route::get("/services/{service_id}/edit","AdminServicesController@edit");
         Route::resource("services","AdminServicesController",["only" => ["update","edit"]]);

    Route::get("services/getAllUserServices/{id}","AdminServicesController@getAllUserServices");

       //Orders
    Route::resource("/orders","AdminOrdersController");
    Route::post("/orders/search","AdminOrdersController@search");
    Route::get("orders/delete/{order_id}","AdminOrdersController@delete");
    Route::post("orders/changeOrderStatus","AdminOrdersController@changeOrderStatus");
    Route::get("orders/getAllOrders/{id}","AdminOrdersController@getAllOrders");
    Route::get("orders/getAllUserOrdersMade/{id}","AdminOrdersController@getAllUserOrdersMade");
    Route::get("orders/getAllMyServicesOrders/{id}","AdminOrdersController@getAllMyServicesOrders");
    //Users
    Route::resource("/users","AdminUsersController");
    Route::post("/users/search","AdminUsersController@search");
    //Comment
    Route::get("comment/delete/{comment_id}","AdminOrdersController@deleteComment");

    //profit
    Route::resource("/profit","AdminProfitController");
    Route::post("/profit/search","AdminProfitController@search");

    Route::get("/profit/user/{id}/{status}","AdminProfitController@getUserProfitStatus");

    Route::get("/TodayProfit/{status?}","AdminProfitController@getTodayProfit");

    Route::post("/ProfitByDate","AdminProfitController@ProfitByDate");

    Route::get("/AdminSendMoney/{id}","PayController@AdminSendMoney");










});


Route::group(['middleware' => ['auth']], function () {
    Route::post('/addServices','ServicesController@addServices');
    Route::get('/getMyServices/{length?}','ServicesController@getMyServices');
    /* Orders */

    Route::get('/AddOrder/{services_id}','OrdersController@AddOrder');

    Route::get('/getMySendOrders/{length?}','OrdersController@getMySendOrders');

    Route::get('/GetOrderById/{order_id}','OrdersController@GetOrderById');

    Route::get('/getMyIncomeOrders/{length?}','OrdersController@getMyIncomeOrders');

    /* Change Status */
    Route::get('/changeStatus/{order_id}/{status}','OrdersController@changeStatus');

    /* FinishOrder */
    Route::get('/finishOrder/{order_id}','OrdersController@finishOrder');

    /* Comment */

    Route::post('/addNewComment','CommentController@addNewComment');
    Route::get('/getAllComment/{order_id}','CommentController@getAllComment');

    /* Messages */
    Route::post('/sendNewMessage','MessagesController@sendNewMessage');
    Route::get('/getSendMessagesByUser','MessagesController@getSendMessagesByUser');
    Route::get('/GetMyRecievedMessages','MessagesController@GetMyRecievedMessages');
    Route::get('/GetThisMessageDetails/{message_id}','MessagesController@GetThisMessageDetails');
    Route::get('/GetUnreadMessage','MessagesController@GetUnreadMessage');

    Route::get('/GetReadMessage','MessagesController@GetReadMessage');

    /** Favs */
    Route::get('/AddFav/{service_id}','FavController@AddFav');
    Route::get('/getUserFav','FavController@getUserFav');
    Route::get('/deleteFav/{id}','FavController@deleteFav');

    /** User */
    Route::get('/getAuthUser','UserController@getAuthUser');

    /** Paypal */
    Route::post('/AddCreditNow','PayController@AddCreditNow');

    Route::get('/doneCharge','PayController@doneCharge');
    Route::get('/errorCharge','PayController@errorCharge');




    Route::get('/getAllChargeOperation','UserController@getAllChargeOperation');

    Route::get('/ShowAllPay','UserController@ShowAllPay');

    Route::get('/ShowAllProfit','UserController@ShowAllProfit');

    Route::get('/showAllBalance','UserController@showAllBalance');

    Route::post("/GetProfit","UserController@GetProfit");

    Route::get('/ShowAllOrderProfit','UserController@ShowAllOrderProfit');





    /** Notification */
    Route::get('/GetNotification','NotificationController@GetNotification');
    Route::get('/getNotUser','NotificationController@getNotUser');
    /**  Vote */
    Route::get('/addNewVote/{val}/{service_id}','VoteController@addNewVote');

});




Route::get('logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
/* Services*/
Route::get('/GetServicesById/{services_id}','ServicesController@GetServicesById');
/* Users */
Route::get('/getUserServices/{user_id}/{length?}','ServicesController@getUserServices');

/** Pages */
Route::get('/getAllServices/{length?}','ServicesController@getAllServices');
/** Cat */
Route::get('/getServicesByCatId/{cat_id}/{length?}','CatController@getServicesByCatId');
Route::get('/getAllInfo','NotificationController@getAllInfo');































