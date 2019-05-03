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

Route::get('/',['uses' => 'mainController@main_view','name'=>'index']);

//api

//lists
Route::post('/lists/get/all',['uses' => 'listsController@get_all','no_csrf_check' => true]);
Route::post('/lists/rename/{todocode}',['uses' => 'listsController@rename_todo','no_csrf_check' => true]);
Route::post('/lists/hideopen/{todocode}',['uses' => 'listsController@hide_todo','no_csrf_check' => true]);
Route::post('/lists/delete/{todocode}',['uses' => 'listsController@delete_todo','no_csrf_check' => true]);
Route::post('/lists/create',['uses' => 'listsController@add_todo','no_csrf_check' => true]);
Route::post('/lists/getfirst',['uses' => 'listsController@get_first','no_csrf_check' => true]);
Route::post('/lists/get/{id}',['uses' => 'listsController@get_data','no_csrf_check' => true]);




//listscontent
Route::post('/task/add/content/{id}',['uses' => 'listscontentController@add_content_todo','no_csrf_check' => true]);
Route::post('/task/rename/content/{id}',['uses' => 'listscontentController@update_task_name','no_csrf_check' => true]);
Route::post('/task/hideopen/content/{id}',['uses' => 'listscontentController@hide_toggle_task','no_csrf_check' => true]);
Route::post('/task/delete/content/{id}',['uses' => 'listscontentController@delete_content_todo','no_csrf_check' => true]);

//auth
Route::post('/login',['uses' => 'Auth\LoginController@validate','no_csrf_check' => true]);
Route::post('/register',['uses' => 'Auth\RegisterController@validate','no_csrf_check' => true]);




