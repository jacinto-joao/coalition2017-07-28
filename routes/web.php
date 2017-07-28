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

Route::get('/home', 'Products\ProductController@index')->name('home');

Route::group(['middleware'=>'auth'], function(){
	Route::group(['namespace'=>'Products'], function(){

		Route::get('product','ProductController@create')->name('product');
		Route::post('/store','ProductController@store')->name('products.store');
		Route::get('/edit/{id}','ProductController@edit')->name('products.edit');
		Route::patch('/update/{id}','ProductController@update')->name('products.update');
		Route::get('/destroy/{id}','ProductController@delete')->name('products.delete');
		Route::get('/download/{id}','ProductController@download')->name('products.download');
});
    
});
