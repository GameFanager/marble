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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/admin/node/edit/{id}", "Admin\NodeController@editNode");
Route::get("/admin/node/add/{id}", "Admin\NodeController@addNode");
Route::get("/admin/node/delete/{id}", "Admin\NodeController@deleteNode");
Route::post("/admin/node/save/{id}", "Admin\NodeController@saveNode");
Route::post("/admin/node/saveadded/{id}", "Admin\NodeController@saveAddedNode");

Route::get("/admin/nodeclass/list", "Admin\NodeClassController@listNodeClasses");
Route::get("/admin/nodeclass/add", "Admin\NodeClassController@addNodeClass");
Route::get("/admin/nodeclass/edit/{id}", "Admin\NodeClassController@editNodeClass");
Route::post("/admin/nodeclass/save/{id}", "Admin\NodeClassController@saveNodeClass");
Route::get("/admin/nodeclass/delete/{id}", "Admin\NodeClassController@deleteNodeClass");
Route::get("/admin/nodeclass/attributes/{id}", "Admin\NodeClassController@editAttributes");
Route::post("/admin/nodeclass/addattribute/{id}", "Admin\NodeClassController@addAttribute");
Route::get("/admin/nodeclass/deleteattribute/{id}/{attribute_id}", "Admin\NodeClassController@deleteAttribute");
Route::post("/admin/nodeclass/saveattributes/{id}", "Admin\NodeClassController@saveAttributes");

App\RouteHelper::generate();
