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
Route::post('fix','LoginController@fix');
Route::get('home',['as'=>'indexHome','uses'=>'PurchaseinfoController@getsearch']);
Route::get('change/user',array('as'=>'indexChangeUser','uses'=>'LoginController@indexchangeUser'));
Route::post('user/checkuser',array('as'=>'AjaxCheckUser','uses'=>'UserController@AjaxCheckUser'));
Route::post('change/user',array('as'=>'UserChangePassword','uses'=>'UserController@UserChangePasswordEmployee'));

Route::get('dang-ky',array('as'=>'accountcreate','uses'=>'UserController@account'));
Route::post('dang-ky',array('as'=>'accountcreate','uses'=>'UserController@accountcreate'));

Route::get('login',array('as'=>'getlogin','uses'=>'LoginController@index'));
Route::post('login',array('as'=>'postlogin','uses'=>'LoginController@login'));
Route::get('signout',array('as'=>'signout','uses'=>'LoginController@signout'));

Route::get('404.php',array('as'=>'àd',function(){return view('business.404.404');}));
Route::get('permissiondenied',function(){return view('business.errors.permissiondenied');})->name('permissiondenied');
Route::get('/',array('as'=>'getsearch','uses'=>'PurchaseinfoController@getsearch'));
Route::get('gioi-thieu',['as'=>'aboutus','uses'=>'PurchaseinfoController@aboutus']);
// Route::post('/',array('as'=>'postsearch','uses'=>'PurchaseinfoController@postsearch'));
Route::post('organizationPostCompany',array('as'=>'organizationPostCompany','uses'=>'PurchaseinfoController@getAjaxCompany'));
Route::post('userPostAjax',array('as'=>'userPostAjax','uses'=>'PurchaseinfoController@getAjaxUser'));

Route::post('postCompany',array('as'=>'postAjaxCompany','uses'=>'PurchaseinfoController@postAjaxCompany'));
Route::post('postDataCompany',array('as'=>'postAjaxCompany','uses'=>'PurchaseinfoController@postAjaxDataCompany'));
Route::post('orders/create',array('as'=>'postcreateOrders','uses'=>'OrdersController@createOrders'))->middleware('buyreplace');
Route::get('orders/show',function(){if(session()->has('customer_id'))
	return redirect('/');
	else
		return redirect('orders/create');

});

Route::post('checkidentitycard',['as'=>'','uses'=>'CheckUserController@checkidentitycard']);
Route::post('checkEmployee_id',array('as'=>'AjaxcheckEmployee_id','uses'=>'CheckUserController@checkEmployee_id'));
Route::post('orders',array('as'=>'postAjaxOrder','uses'=>'OrdersController@postAjax'))->name('redirectAjax');
Route::post('ordersPostAjax',array('as'=>'ordersPostAjax','uses'=>'OrdersController@getAjax'))->name('redirectAjax');
Route::post('orders',array('as'=>'postAjaxOrder','uses'=>'OrdersController@postAjax'))->name('redirectAjax');
// Route::get('orders/upload/{user}',array('as'=>'getUploadOrders','uses'=>'OrdersController@getupload'));
Route::post('orders/upload/{user}',array('as'=>'postUploadOrders','uses'=>'OrdersController@postupload'));
Route::post('orders/show', array('as'=>'postOrdersCreate','uses'=>'PurchaseinfoController@postsearch'));

Route::get('orders/add', array('as'=>'ordershowadd','uses'=>'PurchaseinfoController@ordershowadd'));
// Route::post('orders/add', array('as'=>'orderadd','uses'=>'OrdersController@orderadd'));
Route::post('orders/postAjaxNewUserOrder',array('as'=>'postAjaxNewUserOrder','uses'=>'OrdersController@postAjaxNewUserOrder'));

Route::get('success',array('as'=>'success',function(){return view('business.orders.success');}));
Route::group(['middleware'=>['authen']],function(){
	Route::group(['prefix'=>'admin'],function(){
		
		Route::post('ajax/uploadImage', 'OrdersController@uploadImage');
		Route::post('ajax/deleteImage', 'OrdersController@deleteImage');
		Route::get('notificationUser','NotificationController@notifyUser');
		Route::get('notification', ['as'=>'notification','uses'=>'NotificationController@show']);
		Route::get('readNotification', ['as'=>'realNotification','uses'=>'NotificationController@update']);
		Route::post('/pusher/auth',  ['as'=>'PusherAuth','uses'=>'PusherController@pusherAuth']);
		Route::get('print_orders/{id}', ['as'=>'print_orders','uses'=>'OrdersController@printOrders']);
		Route::get('printAutoPay/{id}', ['as'=>'printAutoPay','uses'=>'OrdersController@printAutoPay']);
		Route::get('exportOrders', ['as'=>'exportOrders','uses'=>'OrdersController@exportOrders']);
		Route::get('changepassword/{id}',array('as'=>'changepassword', 'uses'=>'ChangePasswordController@index'));
		Route::post('changepassword/{id}',array('as'=>'updatepassword', 'uses'=>'ChangePasswordController@update'));
		Route::get('profile',array('as'=>'profile','uses'=>'UserController@getProfile'));
		Route::get('profile/changepassword',array('as'=>'changepasswordprofile', 'uses'=>'ChangePasswordController@indexProfile'));
		Route::post('profile/changepassword/{user}',array('as'=>'updatepasswordprofile', 'uses'=>'ChangePasswordController@updateProfile'));

 //Route::group(['middleware'=>['checkgroup']],function(){
		Route::group(['prefix' => 'checkuser'], function() {
			Route::get('list',['as'=>'listcheckuser','uses'=>'CheckUserController@list']);
			Route::get('show/{id}',['as'=>'showcheckuser','uses'=>'CheckUserController@show']);
			Route::post('update',['as'=>'updatecheckuser','uses'=>'CheckUserController@update']);
			Route::post('accuracy',['as'=>'accuracycheckuser','uses'=> 'CheckUserController@postAccuracy']);
			Route::post('approval',['as'=>'approvalcheckuser','uses'=> 'CheckUserController@postApproval']);
		});
		Route::get('orders',['as'=>'orders','uses'=>'OrdersController@getOderAdmin']);
		Route::get('/',array('as'=>'dashboard','uses'=>'DashboardController@dashboard'));
		Route::get('groupuser',array('as'=>'indexgroupuser','uses'=>'GroupUserController@index'));
		Route::get('groupuser/create',array('as'=>'groupcreate','uses'=>'GroupUserController@getcreate'));
		Route::post('groupuser/create',array('as'=>'groupcreate','uses'=>'GroupUserController@postcreate'));
		Route::get('groupuser/show/{groupuser}',array('as'=>'groupshow','uses'=>'GroupUserController@show'));
		Route::post('groupuser/show/{groupuser}',array('as'=>'groupshow','uses'=>'GroupUserController@update'));
		Route::get('groupuser/{id}',array('as'=>'destroygroup','uses'=>'GroupUserController@destroy'));

		Route::get('userinfo',array('as'=>'indexuserinfo','uses'=>'UserInfoController@index'));
		Route::post('userinfo',array('as'=>'exceluserinfo','uses'=>'UserInfoController@postcreateExcel'));
		Route::get('userinfo/create',array('as'=>'userinfocreate','uses'=>'UserInfoController@getcreate'));
		Route::post('userinfo/create',array('as'=>'userinfocreate','uses'=>'UserInfoController@postcreate'));
		Route::get('userinfo/show/{userinfo}',array('as'=>'userinfoshow','uses'=>'UserInfoController@show'));
		Route::post('userinfo/show/{userinfo}',array('as'=>'userinfoshow','uses'=>'UserInfoController@update'));
		Route::get('userinfo/{id}',array('as'=>'destroyuserinfo','uses'=>'UserInfoController@destroy'));
		Route::get('user/register',array('as'=>'userregister','uses'=>'UserController@accountregister'));
		Route::get('user',array('as'=>'indexuser','uses'=>'UserController@index'));
		Route::get('user/create',array('as'=>'usercreate','uses'=>'UserController@getcreate'));
		Route::post('user/create',array('as'=>'usercreate','uses'=>'UserController@postcreate'));
		Route::get('user/show',array('as'=>'usershow','uses'=>'UserController@show'));
		Route::post('user/show',array('as'=>'usershow','uses'=>'UserController@update'));
		Route::get('user/ajaxGetChangePassword',array('as'=>'ajaxChangePassword','uses'=>'UserController@ajaxGetChangePassword'));
		Route::post('user/ajaxPostChangePassword',array('as'=>'ajaxChangePassword','uses'=>'UserController@ajaxPostChangePassword'));


		Route::get('menu',array('as'=>'indexmenu','uses'=>'MenuController@index'));
		Route::get('menu/create',array('as'=>'menucreate','uses'=>'MenuController@getcreate'));
		Route::post('menu/create',array('as'=>'menucreate','uses'=>'MenuController@postcreate'));
		Route::get('menu/show/{menu}',array('as'=>'menushow','uses'=>'MenuController@show'));
		Route::post('menu/show/{menu}',array('as'=>'menushow','uses'=>'MenuController@update'));
		Route::get('menu/{id}',array('as'=>'destroymenu','uses'=>'MenuController@destroy'));

		Route::get('groupmenu',array('as'=>'menugroup','uses'=>'GroupMenuController@index'));
		Route::post('groupmenu',array('as'=>'menugroup','uses'=>'GroupMenuController@update'));

		Route::get('assess',array('as'=>'indexassess','uses'=>'AssessController@index2'));
		Route::get('assess/show/{id}',array('as'=>'asseessShow','uses'=>'AssessController@editAssess'));
		Route::post('assess/show/{id}',array('as'=>'assessShow','uses'=>'AssessController@saveAssess'));
		Route::get('assess/del/{id}',array('as'=>'assessDel','uses'=>'AssessController@DelAssess'));
		Route::get('assess/register',array('as'=>'register','uses'=>'AssessController@getRegister'));
		Route::post('assess/register',array('as'=>'register','uses'=>'AssessController@InsertAss'));

		Route::get('processstatus',array('as'=>'indexprocess','uses'=>'ProcessStatusController@index'));
		Route::get('processstatus/create',array('as'=>'processcreate','uses'=>'ProcessStatusController@getcreate'));
		Route::post('processstatus/create',array('as'=>'processcreate','uses'=>'ProcessStatusController@postcreate'));
		Route::get('processstatus/show/{processstatus}',array('as'=>'processshow','uses'=>'ProcessStatusController@show'));
		Route::post('processstatus/show/{processstatus}',array('as'=>'processshow','uses'=>'ProcessStatusController@update'));
		Route::get('processstatus/{id}',array('as'=>'processdestroy','uses'=>'ProcessStatusController@destroy'));

		Route::get('order_info/{id}',array('as'=>'indexordersadmin','uses'=>'OrdersController@orderInfo'));
		Route::post('posteditorder',['as'=>'ajaxOrderInfor','uses'=>'OrdersController@ajaxPostEditOrder']);
		Route::post('postaccuracyorder',['as'=>'PostAccuracyOrders','uses'=>'OrdersController@postAccuracyOrder']);
		Route::post('postupdateorder',['as'=>'postupdateorder','uses'=>'OrdersController@postUpdateOrder']);
		Route::post('postsaleorder',['as'=>'postsaleorder','uses'=>'OrdersController@postSaleOrder']);
		Route::post('postApprovalOrder',['as'=>'postApprovalOrder','uses'=>'OrdersController@postApprovalOrder']);

		Route::get('store',array('as'=>'indexStore','uses'=>'StoreController@index'));
		Route::get('store/excel',array('as'=>'indexUploadExcel','uses'=>'StoreController@indexExcelStore'));
		Route::get('orderinfor/userinfo/{id}',['as'=>'exportExcelInfoUser','uses'=>'OrdersController@exportExcelUserinfoApproval']);
		Route::post('store/excel',array('as'=>'postExcelStore','uses'=>'StoreController@uploadExcelStore'));
		Route::get('store/show/{store}',array('as'=>'storeshow','uses'=>'StoreController@show'));
		Route::post('store/show/{store}',array('as'=>'storeshow','uses'=>'StoreController@update'));
		Route::get('store/create',array('as'=>'storecreate','uses'=>'StoreController@getcreate'));
		Route::get('getStoreInfor',array('as'=>'getStoreInfor','uses'=>'StoreController@getStoreInfor'));
		Route::post('store/create',array('as'=>'storecreate','uses'=>'StoreController@postcreate'));
		Route::post('store/{id}',array('as'=>'destroystore','uses'=>'StoreController@destroy'));

		Route::get('interest',['as'=>'interest','uses'=>'StoreController@interest']);
		Route::get('interest/{name}',['as'=>'updateinterest','uses'=>'StoreController@showinterest']);
		Route::post('interest/{name}',['as'=>'updateinterest','uses'=>'StoreController@udpateinterest']);


		Route::get('uploadfile',array('as'=>'indexUploadFile','uses'=>'OrdersController@indexUploadFile'));

		Route::group(['prefix' => 'ajax'], function() {
			Route::post('postEditOrderUser', ['as'=>'ajaxUserInfor','uses'=>'OrdersController@ajaxPostEditOrderUser']);
			Route::get('getuserorder', ['as'=>'ajaxEditOrder','uses'=>'OrdersController@ajaxGetUserOders']);
			Route::get('getuserinfor', ['as'=>'ajaxUserInfor','uses'=>'OrdersController@ajaxGetUserInfor']);
			Route::post('editorder', ['as'=>'ajaxEditOrder','uses'=>'OrdersController@ajaxEditOrder']);
			Route::post('postDeleteOrder', ['as'=>'ajaxDeleteOrder','uses'=>'OrdersController@ajaxDeleteOrder']);
			Route::get('getorderinfor',['as'=>'ajaxOrderInfor','uses'=>'OrdersController@ajaxGetOrderInfor']);
			Route::post('postDeleteUser',['as'=>'ajaxPosDeleteUser','uses'=>'UserController@ajaxPostDeleteUser']);
			Route::post('postDeleteGroupUser',['as'=>'ajaxDeleteGroupUser','uses'=>'GroupUserController@ajaxDeleteGroupUser']);
			Route::post('postDeleteStore',['as'=>'ajaxDeleteStore','uses'=>'StoreController@ajaxDeleteStore']);
			Route::post('postDeleteAssess',['as'=>'ajaxDeleteAssess','uses'=>'AssessController@ajaxDeleteAssess']);
			Route::get('checkUsername', ['as'=>'checkUsername','uses'=>'UserController@checkUsername']);
			Route::get('checkEmail', ['as'=>'checkEmail','uses'=>'UserController@checkEmail']);
			Route::get('getusernew',['as'=>'CheckStatusUser','uses'=>'UserController@checkStatus']);
			Route::post('editnewuser',['as'=>'ajaxPostStatus','uses'=>'UserController@ajaxPostStatus']);
			Route::post('postretailOrders',['as'=>'ajaxPostRetailOrders','uses'=>'OrdersController@ajaxPostRetailOrders']);
		});
		Route::group(['prefix'=>'/organization/create'],function(){
			Route::get('/company',array('as'=>'getCreateCompany','uses'=>'OrganizationController@create_company'));
			Route::post('/company',array('as'=>'postInsOrgCompany','uses'=>'OrganizationController@InsertCom'));
			
		});
		Route::group(['prefix'=>'/organization/list'],function(){
			Route::get('/company',array('as'=>'getListCompany','uses'=>'OrganizationController@list_company'));
			Route::post('/company',array('as'=>'getExcelCompany','uses'=>'OrganizationController@insert_company_excel'));
			Route::get('/company/excel/{type}',array('as'=>'getCreateFileExcelCom','uses'=>'OrganizationController@create_company_excel'));
		});
		Route::group(['prefix'=>'/organization/del'],function(){
			Route::get('/company/{id}',array('as'=>'getDelCompany','uses'=>'OrganizationController@del_company'));
		});
		Route::group(['prefix'=>'/organization/show'],function(){
			Route::get('/company/{id}',array('as'=>'getShowCompany','uses'=>'OrganizationController@get_company'));
			Route::post('/company/{id}',array('as'=>'postShowCompany','uses'=>'OrganizationController@edit_company'));
		});
		Route::get('accountant',['as'=>'indexaccountant', 'uses'=>'UserController@indexaccountant']);
		Route::get('accountant/create',['as'=>'createaccountant','uses'=>'UserController@getcountant']);
		Route::post('accountant/create',['as'=>'createaccountant','uses'=>'UserController@postcountant']);
		Route::get('accountant/update/{id}',['as'=>'updatecountant','uses'=>'UserController@updatecountant']);
		Route::post('accountant/update/{id}',['as'=>'updatecountant','uses'=>'UserController@postupdatecountant']);
		Route::post('accountant/{id}',['as'=>'destroyaccountant','uses'=>'UserController@destroyaccountant']);
	});
	// });

});
