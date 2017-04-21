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

Route::get('/','indexController@index');//主頁導向
Route::get('/result','resultController@index');
Route::post('/score','resultController@score');
Route::get('/index','indexController@index');
Route::get('/popular','indexController@popular');
Route::get('/appraise','indexController@appraise');
Route::get('/random','indexController@random');
Route::get('/category','categoryController@index');
Route::get('/contact','contactController@index');
Route::post('/mail','contactController@contact');






?>

