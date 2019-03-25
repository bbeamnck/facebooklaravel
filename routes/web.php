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
    return view('layouts.master');
});

Route::get('/product','ProductController@index');

Route::post('/product/search','ProductController@search');
Route::get('/product/search','ProductController@search');
Route::get('/product/edit/{id?}','ProductController@edit');
Route::post('/product/update','ProductController@update');
Route::post('/product/insert','ProductController@insert');
Route::get('/product/remove/{id}','ProductController@remove');
Route::get('/home','HomeController@index')->name('home');
Route::get('/cart/view','CartController@viewCart');
Route::get('/cart/add/{id}','CartController@addToCart');
Route::get('/cart/delete/{id}','CartController@deleteCart');
Route::get('/cart/update/{id}/{qty?}','CartController@updateCart');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout' ,'HomeController@logout');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');