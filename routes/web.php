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
Route::get('/login',['uses' => 'mainController@login_view','name'=>'login']);
Route::get('/register',['uses' => 'mainController@register_view','name'=>'register']);


//api
Route::post('/lists/all',['uses' => 'listsController@get_all','no_csrf_check' => true]);
Route::post('/lists/create',['uses' => 'listsController@add_todo','no_csrf_check' => true]);
Route::post('/lists/getfirst',['uses' => 'listsController@get_first','no_csrf_check' => true]);
Route::post('/lists/{id}',['uses' => 'listsController@get_data','no_csrf_check' => true]);





