<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/admin/dashboard', "Admin\DashboardController@viewDashboard");

Route::get('/admin/node/edit/{id}', "Admin\NodeController@editNode");
Route::get('/admin/node/add/{id}', "Admin\NodeController@addNode");
Route::get('/admin/node/delete/{id}', "Admin\NodeController@deleteNode");
Route::post('/admin/node/save/{id}', "Admin\NodeController@saveNode");
Route::post('/admin/node/saveadded/{id}', "Admin\NodeController@saveAddedNode");
Route::post('/admin/node/sort', "Admin\NodeController@sortNodes");

Route::get('/admin/nodeclass/list', "Admin\NodeClassController@listNodeClasses");
Route::get('/admin/nodeclass/list/{id}', "Admin\NodeClassController@listNodeClasses");
Route::get('/admin/nodeclass/add', "Admin\NodeClassController@addNodeClass");
Route::get('/admin/nodeclass/edit/{id}', "Admin\NodeClassController@editNodeClass");
Route::post('/admin/nodeclass/save/{id}', "Admin\NodeClassController@saveNodeClass");
Route::get('/admin/nodeclass/delete/{id}', "Admin\NodeClassController@deleteNodeClass");

Route::get('/admin/nodeclass/attributes/{id}', "Admin\NodeClassController@editAttributes");
Route::post('/admin/nodeclass/addattribute/{id}', "Admin\NodeClassController@addAttribute");
Route::get('/admin/nodeclass/deleteattribute/{id}/{attribute_id}', "Admin\NodeClassController@deleteAttribute");
Route::post('/admin/nodeclass/saveattributes/{id}', "Admin\NodeClassController@saveAttributes");

Route::get('/admin/nodeclass/addgroup', "Admin\NodeClassController@addGroup");
Route::get('/admin/nodeclass/editgroup/{id}', "Admin\NodeClassController@editGroup");
Route::get('/admin/nodeclass/deletegroup/{id}', "Admin\NodeClassController@deleteGroup");
Route::post('/admin/nodeclass/savegroup/{id}', "Admin\NodeClassController@saveGroup");

Route::post('/admin/nodeclass/addattributegroup/{id}', "Admin\NodeClassController@addAttributeGroup");
Route::post('/admin/nodeclass/sortattributegroups/{id}', "Admin\NodeClassController@sortAttributeGroups");
Route::get('/admin/nodeclass/deleteattributegroup/{id}/{groupId}', "Admin\NodeClassController@deleteAttributeGroup");

Route::get('/admin/auth/login', "Auth\AuthController@getLogin");
Route::get('/admin/auth/logout', "Auth\AuthController@getLogout");
Route::post('/admin/auth/login', "Auth\AuthController@postLogin");

Route::get('/admin/user/list', "Admin\UserController@listUsers");
Route::get('/admin/user/add', "Admin\UserController@addUser");
Route::post('/admin/user/save/{id}', "Admin\UserController@saveUser");
Route::get('/admin/user/edit/{id}', "Admin\UserController@editUser");
Route::get('/admin/user/delete/{id}', "Admin\UserController@deleteUser");

Route::get('/admin/usergroup/list', "Admin\UserGroupController@listGroups");
Route::get('/admin/usergroup/add', "Admin\UserGroupController@addGroup");
Route::post('/admin/usergroup/save/{id}', "Admin\UserGroupController@saveGroup");
Route::get('/admin/usergroup/edit/{id}', "Admin\UserGroupController@editGroup");
Route::get('/admin/usergroup/delete/{id}', "Admin\UserGroupController@deleteGroup");

Route::get('/', 'FrontController@redirectLocale');

App\RouteHelper::generate();
