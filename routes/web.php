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
Route::get('/','indexController@index' );//主頁導向
Route::get('/result','resultController@index');
Route::get('/index','indexController@index');
Route::get('/category','categoryController@index');
// orderby




?>

